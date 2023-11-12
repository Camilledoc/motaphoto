<?php
/**
** activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
 wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/motaphoto.css', array(), time() );
 wp_enqueue_script( 'script-js', get_stylesheet_directory_uri() . '/assets/js/script.js', array(), time() );
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

/**requête WP_Query pour affichage single-photo */
function motaphoto_request_photo(){
    $query = new WP_Query([
        'post_type' => 'photo', 
        'posts_per_page' => 1
    ]);

    if($query->have_posts()) {
        wp_send_json($query);
    } else {
        wp_send_json(false);
    }

    wp_die();
}

/**actions requêtes */
add_action('wp_ajax_request_photo', 'motaphoto_request_photo');