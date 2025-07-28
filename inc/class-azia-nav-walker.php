<?php
/**
 * Custom Walker for Navigation Menu
 *
 * @package Azia
 */

/**
 * Custom nav walker class to create a custom navigation menu
 */
class Azia_Nav_Walker extends Walker_Nav_Menu {

    /**
     * Starts the element output.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        /**
         * Filters the arguments for a single nav menu item.
         *
         * @param stdClass $args  An object of wp_nav_menu() arguments.
         * @param WP_Post  $item  Menu item data object.
         * @param int      $depth Depth of menu item.
         */
        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        // Add custom CSS classes to menu items
        $active_class = in_array( 'current-menu-item', $classes ) ? ' active' : '';
        $contact_class = strpos( $item->url, '#contact' ) !== false ? ' contact-btn' : ' menu-item';

        // Build HTML for output
        $output .= $indent . '<a';
        $output .= ' href="' . esc_url( $item->url ) . '"';
        $output .= ' class="' . $contact_class . $active_class . '"';
        
        if ( ! empty( $item->attr_title ) ) {
            $output .= ' title="' . esc_attr( $item->attr_title ) . '"';
        }

        if ( ! empty( $item->target ) ) {
            $output .= ' target="' . esc_attr( $item->target ) . '"';
        }

        if ( ! empty( $item->xfn ) ) {
            $output .= ' rel="' . esc_attr( $item->xfn ) . '"';
        }

        if ( ! empty( $item->description ) ) {
            $output .= ' aria-label="' . esc_attr( $item->description ) . '"';
        }

        $output .= '>';
        $output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $output .= '</a>';
    }

    /**
     * Ends the element output.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $output .= $n;
    }
}