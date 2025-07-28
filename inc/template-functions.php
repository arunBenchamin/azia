<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Azia
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function azia_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter( 'body_class', 'azia_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function azia_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'azia_pingback_header' );

/**
 * Change the excerpt length
 *
 * @param int $length Excerpt length.
 * @return int
 */
function azia_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'azia_excerpt_length' );

/**
 * Change the excerpt more string
 *
 * @param string $more The string shown within the more link.
 * @return string
 */
function azia_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'azia_excerpt_more' );

/**
 * Add a wrapper around the main content (if not using Elementor)
 *
 * @param string $template The path of the template to include.
 * @return string
 */
function azia_maybe_wrap_template( $template ) {
    // If it's a singular Elementor template, we'll use our special template file
    if ( class_exists( '\Elementor\Plugin' ) ) {
        if ( is_singular() && \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() ) ) {
            return $template;
        }
    }
    
    return $template;
}
add_filter( 'template_include', 'azia_maybe_wrap_template' );

/**
 * Add required attributes to menu items to match design
 *
 * @param array $atts The HTML attributes applied to the menu item's link element.
 * @param object $item The current menu item.
 * @param array $args An array of wp_nav_menu() arguments.
 * @return array
 */
function azia_nav_menu_link_attributes( $atts, $item, $args ) {
    // Add the menu-item class to each menu link
    if ( 'primary' === $args->theme_location ) {
        $atts['class'] = isset( $atts['class'] ) ? $atts['class'] . ' menu-item' : 'menu-item';
        
        // Add active class to current menu item
        if ( in_array( 'current-menu-item', $item->classes ) ) {
            $atts['class'] .= ' active';
        }
        
        // Special styling for contact link
        if ( strpos( $item->url, '#contact' ) !== false ) {
            $atts['class'] = 'contact-btn';
        }
    }
    
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'azia_nav_menu_link_attributes', 10, 3 );

/**
 * Include the Custom Nav Walker
 */
require get_template_directory() . '/inc/class-azia-nav-walker.php';