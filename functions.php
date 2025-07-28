<?php

/**
 * Azia Theme functions and definitions
 *
 * @package Azia
 */
if (! defined('AZIA_VERSION')) {
    define('AZIA_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function azia_setup()
{
    // Make theme available for translation
    load_theme_textdomain('azia-social', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in two locations
    register_nav_menus(
        array(
            'primary' => esc_html__('Primary Menu', 'azia-social'),
            'footer' => esc_html__('Footer Menu', 'azia-social'),
            'mobile' => esc_html__('Mobile Menu', 'azia-social'),
        )
    );

    // Switch default core markup to output valid HTML5
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom logo feature
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for Elementor
    add_theme_support('elementor');
}
add_action('after_setup_theme', 'azia_setup');

/**
 * Set the content width in pixels
 */
function azia_content_width()
{
    $GLOBALS['content_width'] = apply_filters('azia_content_width', 1280);
}
add_action('after_setup_theme', 'azia_content_width', 0);

/**
 * Register widget area
 */
function azia_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'azia-social'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'azia-social'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Footer Widget Area', 'azia-social'),
            'id'            => 'footer-widgets',
            'description'   => esc_html__('Add footer widgets here.', 'azia-social'),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}
add_action('widgets_init', 'azia_widgets_init');

/**
 * Enqueue scripts and styles
 */
function azia_scripts()
{

    $dependencies = array();
    if (did_action('elementor/loaded')) {
        $dependencies = array('elementor-frontend');
    }
    // Enqueue Google Fonts
    wp_enqueue_style('azia-social-fonts', 'https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&display=swap', array(), AZIA_VERSION);
    wp_enqueue_style('fontaweasome-style', get_template_directory_uri() . '/assets/font/fontawesome.min.css');


    wp_enqueue_style(
        'main-css',
        get_template_directory_uri() . '/assets/css/main.css',
        $dependencies,
        AZIA_VERSION
    );

    // Enqueue main stylesheet
    wp_enqueue_style('azia-social-style', get_stylesheet_uri(), array(), AZIA_VERSION);
    // Enqueue custom scripts
    wp_enqueue_script('azia-social-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), AZIA_VERSION, true);

    // Enqueue custom scripts for animations and interactions
    wp_enqueue_script('azia-social-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), AZIA_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'azia_scripts');

/**
 * Custom template tags for this theme
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions
 */
require get_template_directory() . '/inc/customizer.php';

//Remove automatically add <p> or <br> tags around form fields.
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * ============================================================================
 * Requirement Plugins
 * ============================================================================
 */
require_once get_template_directory() . '/framework/plugins/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'dhaara_register_required_plugins');

function dhaara_register_required_plugins()
{
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
    */
    $plugins = array(
        [
            'name' => esc_html__('Elementor Page Builder', 'azia'),
            'slug' => 'elementor',
            'required' => true,
        ],
        array(
            'name' => esc_html__('Azia Addon', 'azia'),
            'version' => '1.0',
            'slug' => 'azia-addon',
            'source' => get_template_directory_uri() . '/framework/plugins/azia-addon.zip',
            'required' => true,
        ),

        array(
            'name' => esc_html__('One Click Demo Import', 'azia'),
            'slug' => 'one-click-demo-import',
            'required' => false,
        ),

        array(
            'name' => esc_html__('Contact Form 7', 'azia'),
            'slug' => 'contact-form-7',
            'version' => '',
            'required' => false,
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
    */
    $config = array(
        'id' => 'dhaara', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.



    );
    tgmpa($plugins, $config);
}
