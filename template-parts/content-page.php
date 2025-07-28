<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package Azia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('modern-card p-8 rounded-3xl overflow-hidden'); ?>>
    <header class="entry-header mb-8">
        <?php the_title( '<h1 class="entry-title text-4xl font-bold">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-thumbnail mb-8 rounded-xl overflow-hidden">
        <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
    </div>
    <?php endif; ?>

    <div class="entry-content text-gray-700">
        <?php
        the_content();

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'azia-social' ),
                'after'  => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer pt-6 mt-8 border-t border-gray-100">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Edit <span class="screen-reader-text">%s</span>', 'azia-social' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                ),
                '<span class="edit-link text-sm text-gray-500">',
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->