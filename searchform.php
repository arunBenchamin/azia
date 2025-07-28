<?php
/**
 * The template for displaying search forms
 *
 * @package Azia
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text"><?php esc_html_e( 'Search for:', 'azia-social' ); ?></label>
    <div class="relative">
        <input type="search" class="search-field w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'azia-social' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" class="search-submit absolute right-3 top-1/2 transform -translate-y-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'azia-social' ); ?></span>
        </button>
    </div>
</form>