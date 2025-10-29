<?php

defined( 'ABSPATH' ) || exit;

/** Disable EDD notice */
add_filter( 'pre_site_option_edd_pro_license', function( $pre_option ) {
    // Return false to let WordPress continue with normal option retrieval
    if ( $pre_option !== false ) {
        return $pre_option;
    }
    
    // Create a mock valid license object
    return (object) array(
        'license' => 'valid',
        'key'     => 'mock-key-to-hide-notice',
    );
} );

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
