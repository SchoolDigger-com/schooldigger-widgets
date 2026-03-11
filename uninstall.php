<?php
/**
 * Uninstall handler for SchoolDigger Widgets.
 *
 * Removes all plugin options from the database when the plugin is deleted.
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

delete_option( 'sd_widgets_app_id' );
delete_option( 'sd_widgets_base_url' );
delete_option( 'sd_widgets_default_config' );
