<?php
/**
 * Azia Theme Customizer
 *
 * @package Azia
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function azia_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'azia_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'azia_customize_partial_blogdescription',
            )
        );
    }


    // Theme Colors Section
    $wp_customize->add_section(
        'azia_colors_section',
        array(
            'title'       => __( 'Theme Colors', 'azia-social' ),
            'priority'    => 130,
        )
    );
    
    // Primary Color
    $wp_customize->add_setting(
        'azia_primary_color',
        array(
            'default'           => '#0ea5e9',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'azia_primary_color',
            array(
                'label'   => __( 'Primary Color', 'azia-social' ),
                'section' => 'azia_colors_section',
            )
        )
    );
    
    // Secondary Color
    $wp_customize->add_setting(
        'azia_secondary_color',
        array(
            'default'           => '#6366f1',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'azia_secondary_color',
            array(
                'label'   => __( 'Secondary Color', 'azia-social' ),
                'section' => 'azia_colors_section',
            )
        )
    );
    
    // Accent Color
    $wp_customize->add_setting(
        'azia_accent_color',
        array(
            'default'           => '#f6339a',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'azia_accent_color',
            array(
                'label'   => __( 'Accent Color', 'azia-social' ),
                'section' => 'azia_colors_section',
            )
        )
    );
    
    
    // Footer Options
    $wp_customize->add_section(
        'azia_footer_options',
        array(
            'title'       => __( 'Footer Options', 'azia-social' ),
            'description' => __( 'Customize the footer section', 'azia-social' ),
            'priority'    => 140,
        )
    );
    
    // Copyright Text
    $wp_customize->add_setting(
        'azia_copyright_text',
        array(
            'default'           => sprintf( __( '© %s. All rights reserved.', 'azia-social' ), date_i18n( _x( 'Y', 'copyright date format', 'azia-social' ) ) ),
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'azia_copyright_text',
        array(
            'label'   => __( 'Copyright Text', 'azia-social' ),
            'section' => 'azia_footer_options',
            'type'    => 'textarea',
        )
    );
}
add_action( 'customize_register', 'azia_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function azia_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function azia_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function azia_customize_preview_js() {
    wp_enqueue_script( 'azia-social-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), AZIA_VERSION, true );
}
add_action( 'customize_preview_init', 'azia_customize_preview_js' );

/**
 * Output custom CSS for theme colors
 */
function azia_custom_colors_css() {
    $primary_color = get_theme_mod( 'azia_primary_color', '#0ea5e9' );
    $secondary_color = get_theme_mod( 'azia_secondary_color', '#6366f1' );
    $accent_color = get_theme_mod( 'azia_accent_color', '#f6339a' );
    
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr($primary_color); ?>;
            --secondary-color: <?php echo esc_attr($secondary_color); ?>;
            --accent-color: <?php echo esc_attr($accent_color); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'azia_custom_colors_css' );