<?php

defined( 'ABSPATH' ) || exit;

// Method 1: Filter at the site_option level (works for Pro license)
add_filter( 'default_site_option_edd_pro_license_key', function( $value ) {
    return $value ? $value : 'MOCK_KEY';
}, 1, 3 );

add_filter( 'default_site_option_edd_pro_license', function( $value ) {
    return (object) array(
        'license' => 'valid',
        'key'     => 'MOCK_KEY',
        'success' => true,
    );
}, 1, 3 );

/**
 * Change login logo
 */
function jettyworks_login_logo() { ?>
    <style type="text/css">
        #login h1 a {
            background-image: url(<?php echo esc_url( plugins_url( 'assets/jettyworks-logo.png', dirname( __FILE__ ) ) )  ?>) !important;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'jettyworks_login_logo' );

/**
 * Add custom styles
 */
function jettyworks_custom_styles() {
    $dir = plugin_dir_path( __DIR__ ) . 'assets/jettyworks-custom-styles.css';
    $url = plugins_url( 'assets/jettyworks-custom-styles.css', dirname( __FILE__ ) );
    wp_enqueue_style( 'jettyworks-custom-styles', $url, array(), filemtime( $dir ), 'all' );
}
add_action( 'wp_enqueue_scripts', 'jettyworks_custom_styles', PHP_INT_MAX );
