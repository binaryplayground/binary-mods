<?php

defined( 'ABSPATH' ) || exit;

/**
 * Add typekit fonts
 */
function brinybits_add_typekit(){
	if ( ! is_admin() ) { 
		echo '<link rel="stylesheet" href="https://use.typekit.net/jyb5iaa.css"><style>.wp-block-site-title a { font-family: "gridlite-pe-variable", sans-serif;
font-variation-settings: "ELSH" 3, "RECT" 1, "BACK" 1, "wght" 900; }</style>';
	}
};
add_action('wp_head', 'brinybits_add_typekit');

/**
 * Change login logo
 */
function brinybits_login_logo() { ?>
    <style type="text/css">
        #login h1 a {
            background-image: url(<?php echo esc_url( plugins_url( 'assets/brinybits-logo.png', dirname( __FILE__ ) ) )  ?>) !important;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'brinybits_login_logo' );

/**
 * Add custom styles
 */
function brinybits_custom_styles() {
    $dir = plugin_dir_path( __DIR__ ) . 'assets/brinybits-custom-styles.css';
    $url = plugins_url( 'assets/brinybits-custom-styles.css', dirname( __FILE__ ) );
    wp_enqueue_style( 'brinybits-custom-styles', $url, array(), filemtime( $dir ), 'all' );
}
add_action( 'wp_enqueue_scripts', 'brinybits_custom_styles', PHP_INT_MAX );
