<?php

defined( 'ABSPATH' ) || exit;

/**
 * Add typekit fonts
 */
function frags_add_typekit(){
	if ( ! is_admin() ) { 
		echo '<link rel="stylesheet" href="https://use.typekit.net/bmc0efd.css"><style>.wp-block-site-title a { font-family: bitcount-prop-double-square, sans-serif; font-weight: 500; font-style: normal; }</style>';
	}
};
add_action('wp_head', 'frags_add_typekit');

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
