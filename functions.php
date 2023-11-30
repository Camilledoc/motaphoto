<?php
/**
** activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() 
{
    wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/motaphoto.css', array(), time() );
    wp_enqueue_script( 'script-js', get_stylesheet_directory_uri() . '/assets/js/script.js', array('jquery'), time(), true );
    wp_localize_script('script-js', 'motaphoto_js', array('ajax_url' => admin_url('admin-ajax.php')));
}

/** menu principal */
function register_my_menu() 
{
    register_nav_menu('main-menu', 'Menu principal');
    register_nav_menu('footer', 'Pied de page');
}
add_action( 'after_setup_theme', 'register_my_menu' );

/** activation fonctionnalités WP */
add_theme_support('title-tag');
add_theme_support('custom-logo');
add_theme_support('post-thumbnails');

/**requête WP_Query pour navigation single-photo */
function motaphoto_request_photoMiniature($order)      
// Cette fonction prend un paramètre $order qui détermine l'ordre de tri des photos.
{
    // Un tableau $args est créé pour configurer les paramètres de la requête WP_Query. Il indique de récupérer un seul post de type 'photo', trié par date dans l'ordre spécifié par $order. De plus, il utilise la date actuelle avec 'before' ou 'after' selon la valeur de $sens.
    $sens = $order =='DESC'?'before':'after';
    // La variable $sens est définie en fonction de la valeur de $order. Si $order est égal à 'DESC', $sens est 'before', sinon c'est 'after'.
    $args = array (
        'post_type' => 'photo', 
        'posts_per_page' => 1, 
        'orderby' => 'date', 
        'order' => $order, 
        'date_query' => [
            $sens => get_the_date('Y-m-d H:i:s')
       ],
    ); 

     // Une nouvelle instance de WP_Query est créée avec les arguments définis précédemment.
    $query = new WP_Query($args);

    // Vérifie si la requête a des posts.
    if($query->have_posts()){
        // Initialise un tableau $response pour stocker les données des posts.
        $response = [];

        // Boucle while qui itère à travers les posts obtenus par la requête.
        while ($query->have_posts()){
        $query->the_post(); 
        $thumbnail=get_post_thumbnail_id(); // Récupère l'ID de l'image miniature (thumbnail) du post actuel.
        $response['img']=wp_get_attachment_image_src($thumbnail, 'thumbnail'); // Stocke l'URL de l'image miniature dans le tableau $response sous la clé 'img'.
        $response['url']=get_permalink(); // Stocke l'URL du post dans le tableau $response sous la clé 'url'.
        }
    } else {
        // Si la requête ne renvoie pas de post, $response est définie sur false.
        $response = false; 
    }
    // Réinitialise les données du post pour restaurer la requête originale.
    wp_reset_postdata(); 
    // Retourne le tableau $response contenant les données de l'image et de l'URL du post, ou false s'il n'y a pas de post.
    return $response;
}

/**requête WP_Query pour les photos apparentées */
function motaphoto_request_photoBlock($current_post_id)
    // Cette fonction prend un ID de post actuel en tant que paramètre. 
{
        // Récupère les termes de la taxonomie 'categorie' associés au post actuel.
    $current_post_categories = wp_get_post_terms($current_post_id, 'categorie');
    $category_slugs = array(); // Initialise un tableau pour stocker les slugs des catégories
    
    // Récupère les slugs des catégories associées au post actuel
  // Boucle à travers les catégories pour extraire et stocker les slugs dans le tableau $category_slugs.
    foreach ($current_post_categories as $category) {
        $category_slugs[] = $category->slug;
    }    

     // Crée un ensemble d'arguments pour la requête WP_Query afin de récupérer deux posts de type 'photo'.
    // Les posts doivent être triés aléatoirement ('orderby' => 'rand'), ne pas inclure le post actuel et appartenir aux mêmes catégories que le post actuel.
    $args = array (
        'post_type' => 'photo', 
        'posts_per_page' => 2, 
        'orderby' => 'rand',
        'post__not_in' => array($current_post_id),
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $category_slugs,
                'operator' => 'IN',
            ),
        ),
    ); 
    // Initialise une nouvelle requête WP_Query avec les arguments définis précédemment.
    $query = new WP_Query($args);
    $response = array(); // Initialise un tableau pour stocker la réponse.

     // Vérifie si la requête a des posts.
    if($query->have_posts()){

        // Boucle à travers les posts obtenus par la requête.
        while ($query->have_posts()){
            $query->the_post(); 
            $thumbnail = get_post_thumbnail_id();  // Récupère l'ID de l'image miniature (thumbnail) du post actuel.
            $image = wp_get_attachment_image_src($thumbnail, 'large'); // Récupère l'URL de l'image à taille large.
            $url = get_permalink();    // Récupère l'URL du post.
            $id = get_the_id();   // Récupère l'ID du post.

            // Crée un tableau associatif pour stocker les données de l'image, de l'URL et de l'ID du post.
            $item = array(
                'img' => $image,
                'url' => $url,
                'id' => $id,
            );
             // Ajoute le tableau $item à la réponse.
            $response[] = $item;
        }
    } else {
        // Si la requête ne renvoie pas de post, $response est définie sur false.
        $response = false; 
          // De même, l'ID est défini sur false.
        $id = false;
    }
    wp_reset_postdata();
    return $response;
}

/**requête WP_Query pour affichage photo hero*/
function motaphoto_request_photoHero() 
{
    // Définit les paramètres pour la requête WP_Query afin de récupérer des posts de type 'photo'.
    $args = array (
        'post_type' => 'photo', 
        'posts_per_page' => 1, 
        'orderby' => 'rand',
    ); 

    $query = new WP_Query($args);
    $response = array();

    if($query->have_posts()){
        while ($query->have_posts()){
            $query->the_post(); 
            $thumbnail_id = get_post_thumbnail_id();
            $image = wp_get_attachment_image_src($thumbnail_id, 'full');
           
            // Crée un tableau associatif pour stocker les données de l'image et de l'URL du post.
            $item = array(
                'img' => $image,
            );
            // Ajoute le tableau $item à la réponse.
            $response[] = $item;
        }
    } else {
        $response = false; 
    }
    wp_reset_postdata();
    return $response;
}

/**requête WP_Query pour le catalogue photo */
function motaphoto_request_photoCatalogue() 
{
    // Définit les paramètres pour la requête WP_Query afin de récupérer des posts de type 'photo'.
    $args = array (
        'post_type' => 'photo', 
        'posts_per_page' => 12, 
        'orderby' => 'date',
        'order' => 'DESC',
        /*'tax_query' => array(
            'relation' => 'AND', 
            array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => 'categorie',
            ),
            array(
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => 'format',
            ),
        ),*/
    ); 

    $query = new WP_Query($args);
    $response = array();

    if($query->have_posts()){
        while ($query->have_posts()){
            $query->the_post(); 
            $thumbnail_id = get_post_thumbnail_id();
            $image = wp_get_attachment_image_src($thumbnail_id, 'large');
            $url = get_permalink(); 
           
                        // Crée un tableau associatif pour stocker les données de l'image et de l'URL du post.
            $item = array(
                'img' => $image,
                'url' => $url,
            );
                        // Ajoute le tableau $item à la réponse.
            $response[] = $item;
        }
    } else {
        $response = false; 
    }
    wp_reset_postdata();
    return $response;
}

/* function pour charger toutes les photos  */
function motaphoto_loadingAllPhotos(){
        // Définit les paramètres pour la requête WP_Query afin de récupérer plus de posts de type 'photo'.
    $args = [
        'post_type' => 'photo', 
        'orderby' => 'date',
        'order' => 'DESC',
        'offset' => 12,
    ]; 

        // Initialise une nouvelle requête WP_Query avec les arguments définis précédemment.
    $query = new WP_Query($args); 
    // Initialise un tableau pour stocker les données des photos.
    $photos = [];

    // Vérifie si la requête a des posts.
    if ($query->have_posts()){
         // Boucle à travers les posts obtenus par la requête.
        while($query->have_posts()){
            $query->the_post();
            $thumbnail_id = get_post_thumbnail_id(); // Récupère l'ID de l'image miniature (thumbnail) du post actuel.
            $image = wp_get_attachment_image_src($thumbnail_id, 'large'); // Récupère l'URL de l'image à taille large.
            $url = get_permalink(); // Récupère l'URL du post.
             // Crée une structure HTML pour chaque photo.
            $photo_html = '<div class="photo-item">';
            $photo_html .= '<a href="' . esc_url($url) . '">';
            $photo_html .= '<div class="overlay-catalogue">';
            $photo_html .= '<i class="fa-regular fa-eye"></i>';
            $photo_html .= '</a>';
            $photo_html .= '<i class="fa-solid fa-expand"></i>';
            $photo_html .= '</div>';
            $photo_html .= '<img class="image-catalogue" src="' . esc_url($image[0]) . '" alt="Photo" />';
            $photo_html .= '</div>';

            // Ajoute le code HTML de la photo au tableau $photos.
            $photos[]=$photo_html; 
        }
    }
    
    // Réinitialise les données du post pour restaurer la requête originale.
    wp_reset_postdata();

    // Envoie la réponse sous forme de données JSON (le code HTML des photos).
    wp_send_json($photos);
}

/**actions requêtes */
add_action('wp_ajax_loadingAllPhotos', 'motaphoto_loadingAllPhotos'); 
add_action('wp_ajax_nopriv_loadingAllPhotos', 'motaphoto_loadingAllPhotos'); 