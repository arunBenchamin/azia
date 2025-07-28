<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Azia
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <div class="container mx-auto px-6 py-8">
        <div class="modern-card p-6 rounded-3xl">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </div>
    </div>
</aside><!-- #secondary -->