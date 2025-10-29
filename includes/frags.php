<?php

defined( 'ABSPATH' ) || exit;

/**
 * Change login logo
 */
function frags_login_logo() { ?>
    <style type="text/css">
        #login h1 a {
            background-image: url(<?php echo esc_url( plugins_url( 'assets/frags-logo.png', dirname( __FILE__ ) ) )  ?>) !important;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'frags_login_logo' );

/**
 * Add custom styles
 */
function frags_custom_styles() {
    $dir = plugin_dir_path( __DIR__ ) . 'assets/frags-custom-styles.css';
    $url = plugins_url( 'assets/frags-custom-styles.css', dirname( __FILE__ ) );
    wp_enqueue_style( 'frags-custom-styles', $url, array(), filemtime( $dir ), 'all' );
}
add_action( 'wp_enqueue_scripts', 'frags_custom_styles', PHP_INT_MAX );
