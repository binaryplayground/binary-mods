<?php

defined( 'ABSPATH' ) || exit;

/**
 * CSS to hide the EDD notice
 */
add_action( 'admin_head', function() {
    echo '<style>.edd-promo-notice--inactivepro{display:none!important;}</style>';
}, 999 );

// Remove the Passes component before it gets registered
add_filter( 'edd_cron_components', function( $components_to_register ) {
    // Remove the Passes component which handles Pro license checks
    $key = array_search( 'EDD\Cron\Components\Passes', $components_to_register, true );
    if ( $key !== false ) {
        unset( $components_to_register[ $key ] );
    }
    
    // Also remove by class reference (in case it's stored differently)
    $components_to_register = array_filter( $components_to_register, function( $component ) {
        return $component !== 'EDD\Cron\Components\Passes' && 
               $component !== \EDD\Cron\Components\Passes::class;
    });
    
    return $components_to_register;
}, 1 );

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
