<?php

defined( 'ABSPATH' ) || exit;

/**
 * Remove login language filter
 */
add_filter( 'login_display_language_dropdown', '__return_false' );

/**
 * Changes the logo title (hover text)
 */
function binarymods_login_logo_url_title() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'binarymods_login_logo_url_title' );

/**
 * Changes the logo URL to the website's homepage
 */
function binarymods_login_logo_url() {
    return get_bloginfo( 'wpurl' );
}
add_filter( 'login_headerurl', 'binarymods_login_logo_url' );

/**
 * Add custom styles
 */
function binarymods_custom_styles() {
    $dir = plugin_dir_path( __DIR__ ) . 'assets/binarymods-custom-styles.css';
    $url = plugins_url( 'assets/binarymods-custom-styles.css', dirname( __FILE__ ) );
    wp_enqueue_style( 'binarymods-custom-styles', $url, array(), filemtime( $dir ), 'all' );
}
add_action( 'wp_enqueue_scripts', 'binarymods_custom_styles', PHP_INT_MAX );
