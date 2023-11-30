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
{
    $sens = $order =='DESC'?'before':'after';
    $args = array (
        'post_type' => 'photo', 
        'posts_per_page' => 1, 
        'orderby' => 'date', 
        'order' => $order, 
        'date_query' => [
            $sens => get_the_date('Y-m-d H:i:s')
       ],
    ); 
    $query = new WP_Query($args);
    if($query->have_posts()){
    $response = [];

        while ($query->have_posts()){
        $query->the_post(); 
        $thumbnail=get_post_thumbnail_id();
        $response['img']=wp_get_attachment_image_src($thumbnail, 'thumbnail');
        $response['url']=get_permalink();
        }
    } else {
        $response = false; 
    }
    wp_reset_postdata();
    return $response;
}

/**requête WP_Query pour les photos apparentées */
function motaphoto_request_photoBlock($current_post_id) 
{
    $current_post_categories = wp_get_post_terms($current_post_id, 'categorie');
    $category_slugs = array(); // Initialise un tableau pour stocker les slugs des catégories
    
    // Récupère les slugs des catégories associées au post actuel
    foreach ($current_post_categories as $category) {
        $category_slugs[] = $category->slug;
    }    
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

    $query = new WP_Query($args);
    $response = array();

    if($query->have_posts()){
        while ($query->have_posts()){
            $query->the_post(); 
            $thumbnail = get_post_thumbnail_id();
            $image = wp_get_attachment_image_src($thumbnail, 'large');
            $url = get_permalink();
            $id = get_the_id();

            $item = array(
                'img' => $image,
                'url' => $url,
                'id' => $id,
            );
            $response[] = $item;
        }
    } else {
        $response = false; 
        $id = false;
    }
    wp_reset_postdata();
    return $response;
}

/**requête WP_Query pour le catalogue photo */
function motaphoto_request_photoCatalogue() 
{
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
           
            $item = array(
                'img' => $image,
                'url' => $url,
            );
            $response[] = $item;
        }
    } else {
        $response = false; 
    }
    wp_reset_postdata();
    return $response;
}

function motaphoto_loadingAllPhotos(){
    $args = [
        'post_type' => 'photo', 
        'orderby' => 'date',
        'order' => 'DESC',
        'offset' => 12,
    ]; 

    $query = new WP_Query($args); 
    $photos = [];

    if ($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();
            $thumbnail_id = get_post_thumbnail_id();
            $image = wp_get_attachment_image_src($thumbnail_id, 'large');
            $url = get_permalink();
            $photo_html = '<div class="photo-item">';
            $photo_html .= '<a href="' . esc_url($url) . '">';
            $photo_html .= '<div class="overlay-catalogue">';
            $photo_html .= '<i class="fa-regular fa-eye"></i>';
            $photo_html .= '</a>';
            $photo_html .= '<i class="fa-solid fa-expand"></i>';
            $photo_html .= '</div>';
            $photo_html .= '<img class="image-catalogue" src="' . esc_url($image[0]) . '" alt="Photo" />';
            $photo_html .= '</div>';

            $photos[]=$photo_html; 
        }
    }

    wp_reset_postdata();

    wp_send_json($photos);
}

/**actions requêtes */
add_action('wp_ajax_loadingAllPhotos', 'motaphoto_loadingAllPhotos'); 
add_action('wp_ajax_nopriv_loadingAllPhotos', 'motaphoto_loadingAllPhotos'); 