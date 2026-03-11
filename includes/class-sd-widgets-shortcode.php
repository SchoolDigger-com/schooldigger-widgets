<?php
/**
 * Shortcode handler for SchoolDigger Widgets.
 *
 * Usage: [sd_widgets widget="school-info-card" school-id="340576000472" show-address="true"]
 *
 * The "widget" attribute selects the widget type. All other attributes
 * are passed through as data-* attributes on the container div.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SD_Widgets_Shortcode {

    /**
     * Register the shortcode.
     */
    public static function register() {
        add_shortcode( 'sd_widgets', array( __CLASS__, 'render' ) );
    }

    /**
     * Render the shortcode.
     *
     * @param array|string $atts Shortcode attributes.
     * @return string HTML output.
     */
    public static function render( $atts ) {
        $atts = is_array( $atts ) ? $atts : array();

        $widget_type = isset( $atts['widget'] ) ? sanitize_text_field( $atts['widget'] ) : '';
        if ( empty( $widget_type ) ) {
            return '<!-- SchoolDigger Widget: missing "widget" attribute -->';
        }

        // Get App ID (per-widget override or global setting).
        $app_id = isset( $atts['app-id'] ) ? sanitize_text_field( $atts['app-id'] ) : '';
        if ( empty( $app_id ) ) {
            $app_id = get_option( 'sd_widgets_app_id', '' );
        }
        if ( empty( $app_id ) ) {
            return '<!-- SchoolDigger Widget: no App ID configured. Go to Settings > SchoolDigger Widgets. -->';
        }

        // Get style config (per-widget override or global default).
        $config = isset( $atts['config'] ) ? sanitize_text_field( $atts['config'] ) : '';
        if ( empty( $config ) ) {
            $config = get_option( 'sd_widgets_default_config', '' );
        }

        // Reserved attributes that are not passed as data-* attrs.
        $reserved = array( 'widget', 'app-id', 'config' );

        // Build the widget HTML using the shared renderer.
        return sd_widgets_render_container( $widget_type, $app_id, $config, $atts, $reserved, 'shortcode' );
    }
}

/**
 * Shared widget container renderer used by both shortcode and Gutenberg block.
 *
 * @param string $widget_type  Widget type slug (e.g., "school-info-card").
 * @param string $app_id       The App ID.
 * @param string $config       Base64 style config (may be empty).
 * @param array  $params       Key-value pairs to become data-* attributes.
 * @param array  $reserved     Keys in $params to skip.
 * @param string $source       "shortcode" or "block" — controls key format.
 * @return string HTML.
 */
function sd_widgets_render_container( $widget_type, $app_id, $config, $params, $reserved, $source ) {
    // Enqueue the loader script (registered in main plugin file).
    wp_enqueue_script( 'sd-widget-loader' );

    $id = wp_unique_id( 'sd-widget-' );

    $html = '<div id="' . esc_attr( $id ) . '"';
    $html .= ' data-sd-widget="' . esc_attr( $widget_type ) . '"';
    $html .= ' data-appid="' . esc_attr( $app_id ) . '"';

    if ( ! empty( $config ) ) {
        $html .= ' data-config="' . esc_attr( $config ) . '"';
    }

    foreach ( $params as $key => $value ) {
        if ( in_array( $key, $reserved, true ) ) {
            continue;
        }
        if ( '' === $value || null === $value ) {
            continue;
        }

        if ( 'block' === $source ) {
            // Block params come in camelCase — convert to kebab-case for data attrs.
            $data_key = strtolower( preg_replace( '/([a-z])([A-Z])/', '$1-$2', $key ) );
        } else {
            // Shortcode attrs are already kebab-case (WordPress lowercases them).
            $data_key = $key;
        }

        $html .= ' data-' . esc_attr( $data_key ) . '="' . esc_attr( $value ) . '"';
    }

    $html .= '></div>';

    return $html;
}
