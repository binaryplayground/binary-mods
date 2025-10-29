<?php
/*
 * Plugin Name:       Binary Modifications
 * Plugin URI:        https://binaryplayground.com
 * Description:       Modifications for BP family of sites.
 * Version:           0.1
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            findingsimple
 * Author URI:        https://findingsimple.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Update URI:        https://github.com/binaryplayground/binary-mods/
 * Text Domain:       binary-mods
 */

defined( 'ABSPATH' ) || exit;

function binary_mods_init() {

    /** Global mods */
    require_once __DIR__ . '/includes/global-mods.php';

    /** Per site mods - auto-load based on domain */
    $site_url = get_site_url();
    $host = wp_parse_url( $site_url, PHP_URL_HOST );

    if ( $host ) {
        // Extract site identifier from hostname (first segment before dot)
        $site_id = strtok( $host, '.' );
        $site_file = __DIR__ . '/includes/' . $site_id . '.php';

        if ( file_exists( $site_file ) ) {
            require_once $site_file;
        }
    }
}

add_action( 'init', 'binary_mods_init' );
