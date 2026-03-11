<?php
/**
 * Plugin Name: SchoolDigger Widgets
 * Plugin URI:  https://widgets.schooldigger.com/wordpress
 * Description: Embed interactive SchoolDigger school data widgets on your WordPress site. Display school info cards, rankings, search tools, maps, and test score charts.
 * Version:     1.0.5
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author:      SchoolDigger
 * Author URI:  https://www.schooldigger.com
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: schooldigger-widgets
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'SD_WIDGETS_VERSION', '1.0.5' );
define( 'SD_WIDGETS_DIR', plugin_dir_path( __FILE__ ) );
define( 'SD_WIDGETS_URL', plugin_dir_url( __FILE__ ) );
define( 'SD_WIDGETS_BASENAME', plugin_basename( __FILE__ ) );

require_once SD_WIDGETS_DIR . 'includes/widget-catalog.php';
require_once SD_WIDGETS_DIR . 'includes/class-sd-widgets-settings.php';
require_once SD_WIDGETS_DIR . 'includes/class-sd-widgets-shortcode.php';
require_once SD_WIDGETS_DIR . 'includes/class-sd-widgets-block.php';

/**
 * Initialize plugin components.
 */
function sd_widgets_init() {
    SD_Widgets_Shortcode::register();
    SD_Widgets_Block::register();
}
add_action( 'init', 'sd_widgets_init' );

/**
 * Register admin hooks.
 */
SD_Widgets_Settings::init();

/**
 * Register the widget-loader.js script (enqueued on-demand by shortcode/block).
 */
function sd_widgets_register_scripts() {
    $base_url = get_option( 'sd_widgets_base_url', 'https://widgets.schooldigger.com' );
    $base_url = rtrim( $base_url, '/' );

    wp_register_script(
        'sd-widget-loader',
        $base_url . '/js/widget-loader.js',
        array(),
        SD_WIDGETS_VERSION,
        array(
            'strategy'  => 'async',
            'in_footer' => true,
        )
    );
}
add_action( 'wp_enqueue_scripts', 'sd_widgets_register_scripts' );

/**
 * Add async attribute for older WordPress versions (< 6.3).
 */
function sd_widgets_script_loader_tag( $tag, $handle ) {
    if ( 'sd-widget-loader' === $handle && false === strpos( $tag, 'async' ) ) {
        $tag = str_replace( ' src=', ' async src=', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'sd_widgets_script_loader_tag', 10, 2 );

/**
 * Add "Settings" link on the Plugins page.
 */
function sd_widgets_plugin_action_links( $links ) {
    $settings_link = '<a href="' . esc_url( admin_url( 'options-general.php?page=schooldigger-widgets' ) ) . '">'
        . esc_html__( 'Settings', 'schooldigger-widgets' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}
add_filter( 'plugin_action_links_' . SD_WIDGETS_BASENAME, 'sd_widgets_plugin_action_links' );
