<?php
/**
 * Settings page for SchoolDigger Widgets.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SD_Widgets_Settings {

    /**
     * Initialize admin hooks.
     */
    public static function init() {
        add_action( 'admin_menu', array( __CLASS__, 'add_settings_page' ) );
        add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
    }

    /**
     * Add the settings page under Settings menu.
     */
    public static function add_settings_page() {
        add_options_page(
            __( 'SchoolDigger Widgets', 'schooldigger-widgets' ),
            __( 'SchoolDigger Widgets', 'schooldigger-widgets' ),
            'manage_options',
            'schooldigger-widgets',
            array( __CLASS__, 'render_settings_page' )
        );
    }

    /**
     * Register settings with the Settings API.
     */
    public static function register_settings() {
        register_setting( 'sd_widgets_settings', 'sd_widgets_app_id', array(
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        ) );

        // API Configuration section.
        add_settings_section(
            'sd_widgets_api_section',
            __( 'API Configuration', 'schooldigger-widgets' ),
            array( __CLASS__, 'render_api_section' ),
            'schooldigger-widgets'
        );

        add_settings_field(
            'sd_widgets_app_id',
            __( 'App ID', 'schooldigger-widgets' ),
            array( __CLASS__, 'render_app_id_field' ),
            'schooldigger-widgets',
            'sd_widgets_api_section'
        );
    }

    /**
     * Render the settings page.
     */
    public static function render_settings_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $app_id   = get_option( 'sd_widgets_app_id', '' );
        $site_url = get_option( 'sd_widgets_base_url', 'https://widgets.schooldigger.com' );
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

            <!-- WordPress Integration Guide -- prominent banner (always visible) -->
            <div style="background: linear-gradient(135deg, #1d4ed8, #2563eb); color: #fff; padding: 24px 28px; border-radius: 8px; margin: 20px 0 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 280px;">
                        <h2 style="color: #fff; margin: 0 0 8px; font-size: 1.4em;">
                            <span class="dashicons dashicons-book" style="font-size: 1.2em; margin-right: 6px; vertical-align: middle;"></span>
                            <?php esc_html_e( 'WordPress Integration Guide', 'schooldigger-widgets' ); ?>
                        </h2>
                        <p style="margin: 0; opacity: 0.92; font-size: 14px; line-height: 1.5;">
                            <?php esc_html_e( 'Look up School & District IDs, generate shortcodes with a visual configurator, customize widget styles, and preview widgets -- all in one page.', 'schooldigger-widgets' ); ?>
                        </p>
                    </div>
                    <div style="flex-shrink: 0;">
                        <a href="<?php echo esc_url( $site_url . '/wordpress' ); ?>" target="_blank" rel="noopener"
                           style="display: inline-block; background: #fff; color: #1d4ed8; font-weight: 600; font-size: 15px; padding: 12px 28px; border-radius: 6px; text-decoration: none; white-space: nowrap; box-shadow: 0 1px 4px rgba(0,0,0,0.12); transition: transform 0.1s;">
                            <?php esc_html_e( 'Open WordPress Guide', 'schooldigger-widgets' ); ?> &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <?php if ( empty( $app_id ) ) : ?>
            <div class="notice notice-info" style="padding: 12px 16px;">
                <h3 style="margin-top: 0;"><?php esc_html_e( 'Get Started', 'schooldigger-widgets' ); ?></h3>
                <p>
                    <?php esc_html_e( 'To use SchoolDigger Widgets, you need an App ID.', 'schooldigger-widgets' ); ?>
                </p>
                <p>
                    <a href="<?php echo esc_url( $site_url . '/signup' ); ?>" target="_blank" rel="noopener" class="button button-primary">
                        <?php esc_html_e( 'Create a Free Account', 'schooldigger-widgets' ); ?>
                    </a>
                    <span style="margin: 0 8px; color: #666;"><?php esc_html_e( 'or', 'schooldigger-widgets' ); ?></span>
                    <?php esc_html_e( 'enter your App ID below if you already have an account.', 'schooldigger-widgets' ); ?>
                </p>
            </div>
            <?php endif; ?>

            <form action="options.php" method="post">
                <?php
                settings_fields( 'sd_widgets_settings' );
                do_settings_sections( 'schooldigger-widgets' );
                submit_button();
                ?>
            </form>

            <?php if ( ! empty( $app_id ) ) : ?>
            <hr>
            <h2><?php esc_html_e( 'Account Management', 'schooldigger-widgets' ); ?></h2>
            <p>
                <a href="https://widgets.schooldigger.com/dashboard" target="_blank" rel="noopener" class="button">
                    <?php esc_html_e( 'Manage Your Account', 'schooldigger-widgets' ); ?>
                </a>
            </p>
            <p class="description">
                <?php
                printf(
                    /* translators: 1: the site domain, 2: opening link tag, 3: closing link tag */
                    esc_html__( 'Make sure %1$s is added to your %2$sdomain whitelist%3$s in the SchoolDigger dashboard.', 'schooldigger-widgets' ),
                    '<code>' . esc_html( wp_parse_url( home_url(), PHP_URL_HOST ) ) . '</code>',
                    '<a href="https://widgets.schooldigger.com/dashboard/domains" target="_blank" rel="noopener">',
                    '</a>'
                );
                ?>
            </p>

            <hr>
            <h2><?php esc_html_e( 'Quick Start', 'schooldigger-widgets' ); ?></h2>
            <p><?php esc_html_e( 'Use the shortcode in any post or page:', 'schooldigger-widgets' ); ?></p>
            <pre style="background: #f0f0f0; padding: 12px; display: inline-block; border-radius: 4px;">[sd_widgets widget="school-info-card" school-id="340576000472"]</pre>
            <p>
                <?php
                printf(
                    /* translators: 1: opening link tag, 2: closing link tag */
                    esc_html__( 'Or use the %1$sSchoolDigger Widget block%2$s in the block editor.', 'schooldigger-widgets' ),
                    '<a href="https://widgets.schooldigger.com/wordpress" target="_blank" rel="noopener">',
                    '</a>'
                );
                ?>
            </p>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Section callbacks.
     */
    public static function render_api_section() {
        // Empty -- description handled by notices above.
    }

    /**
     * Field renderers.
     */
    public static function render_app_id_field() {
        $value   = get_option( 'sd_widgets_app_id', '' );
        $site_url = get_option( 'sd_widgets_base_url', 'https://widgets.schooldigger.com' );
        ?>
        <input type="text"
               id="sd_widgets_app_id"
               name="sd_widgets_app_id"
               value="<?php echo esc_attr( $value ); ?>"
               class="regular-text"
               placeholder="e.g., abc123def456">
        <p class="description">
            <?php
            printf(
                /* translators: %s: link to API keys page */
                esc_html__( 'Find your App ID in the %s.', 'schooldigger-widgets' ),
                '<a href="https://widgets.schooldigger.com/dashboard/api-keys" target="_blank" rel="noopener">' .
                    esc_html__( 'SchoolDigger dashboard under Integration', 'schooldigger-widgets' ) . '</a>'
            );
            ?>
        </p>
        <?php
    }

}
