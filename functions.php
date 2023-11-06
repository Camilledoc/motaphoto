<?php
/**
** activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
 wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/motaphoto.css', array(), time() );

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