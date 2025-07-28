<?php
/**
 * Template part for displaying posts
 *
 * @package Azia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('modern-card p-6 mb-8 rounded-3xl overflow-hidden hover-up'); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-thumbnail mb-6 rounded-xl overflow-hidden">
        <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto hover:scale-105 transition-transform duration-700' ) ); ?>
    </div>
    <?php endif; ?>

    <header class="entry-header mb-6">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title text-3xl font-bold mb-4">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title text-2xl font-bold mb-4"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="hover:text-sky-500 transition-colors">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta text-gray-500 text-sm mb-4">
                <?php
                azia_posted_on();
                azia_posted_by();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content mb-6 text-gray-700">
        <?php
        if ( is_singular() ) :
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'azia' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'azia' ),
                    'after'  => '</div>',
                )
            );
        else :
            the_excerpt();
            ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="inline-flex items-center text-sky-500 font-medium hover:text-indigo-600 transition-colors group mt-4">
                <?php esc_html_e( 'Read More', 'azia' ); ?>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
            <?php
        endif;
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer text-gray-500 text-sm">
        <?php azia_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->