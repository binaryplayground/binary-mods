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

/**
 * Custom EDD labels
 */
function binarymods_set_download_labels($labels) {
    $labels = array(
        'name' => _x('Products', 'post type general name', 'easy-digital-downloads'),
        'singular_name' => _x('Product', 'post type singular name', 'easy-digital-downloads'),
        'add_new' => __('Add New', 'easy-digital-downloads'),
        'add_new_item' => __('Add New Product', 'easy-digital-downloads'),
        'edit_item' => __('Edit Product', 'easy-digital-downloads'),
        'new_item' => __('New Product', 'easy-digital-downloads'),
        'all_items' => __('All Products', 'easy-digital-downloads'),
        'view_item' => __('View Product', 'easy-digital-downloads'),
        'search_items' => __('Search Products', 'easy-digital-downloads'),
        'not_found' =>  __('No Products found', 'easy-digital-downloads'),
        'not_found_in_trash' => __('No Products found in Trash', 'easy-digital-downloads'), 
        'parent_item_colon' => '',
        'menu_name' => __('Products', 'easy-digital-downloads'),
        'featured_image'        => __( '%1$s Image', 'easy-digital-downloads' ),
        'set_featured_image'    => __( 'Set %1$s Image', 'easy-digital-downloads' ),
        'remove_featured_image' => __( 'Remove %1$s Image', 'easy-digital-downloads' ),
        'use_featured_image'    => __( 'Use as %1$s Image', 'easy-digital-downloads' ),
    );
    return $labels;
}
add_filter( 'edd_download_labels', 'binarymods_set_download_labels' );