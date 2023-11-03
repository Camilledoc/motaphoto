<?php
/**
** activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
 wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/motaphoto.css', array(), time() );

}

/**page administration du thème */
function motaphoto_add_admin_pages(){
    add_menu_page(__('Paramètres du thème MotaPhoto', 'motaphoto'), __('MotaPhoto', 'motaphoto'), 'manage_options', 'motaphoto-settings', 'motaphoto_theme_settings', 'dashicons-admin-settings', 60);
}

function motaphoto_theme_settings() {
    echo '<h1>' .get_admin_page_title(). '</h1>';
}

add_action('admin_menu', 'motaphoto_add_admin_pages', 10);

/** menu principal */
function register_my_menu() {
    register_nav_menu('main-menu', 'Menu principal');
}
add_action( 'after_setup_theme', 'register_my_menu' );
