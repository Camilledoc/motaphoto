<?php
/**
** activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
 wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/motaphoto.css', array(), time() );
 wp_enqueue_script( 'script-js', get_stylesheet_directory_uri() . '/assets/js/script.js', array('jquery'), time(), true );
}

/** menu principal */
function register_my_menu() {
    register_nav_menu('main-menu', 'Menu principal');
    register_nav_menu('footer', 'Pied de page');
}
add_action( 'after_setup_theme', 'register_my_menu' );

/** activation fonctionnalités WP */
add_theme_support('title-tag');
add_theme_support('custom-logo');
add_theme_support('post-thumbnails');

/**requête WP_Query pour navigation single-photo */
function motaphoto_request_photoMiniature($order) {
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
       // $id = get_the_id();
    } else {
     //   $id = false;
        $response = false; 
    }
    wp_reset_postdata();
    return $response;
}

/**actions requêtes */
add_action('wp_ajax_request_photo', 'motaphoto_request_photoMiniature');