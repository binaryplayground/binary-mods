<?php

defined( 'ABSPATH' ) || exit;

/**
 * CSS to hide the EDD notice
 */
add_action( 'admin_head', function() {
    echo '<style>.edd-promo-notice--inactivepro{display:none!important;}</style>';
}, 999 );

/**
 * Remove the Pro license weekly check
 */
add_action( 'init', function() {
    if ( class_exists( '\\EDD\\Cron\\Components\\Passes' ) ) {
        $passes_component = new \EDD\Cron\Components\Passes();
        remove_action( 'edd_weekly_scheduled_events', array( $passes_component, 'weekly_license_check' ) );
    }
}, 99 );

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
