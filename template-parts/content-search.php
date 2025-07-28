<?php
/**
 * Template part for displaying results in search pages
 *
 * @package Azia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('modern-card p-6 mb-8 rounded-3xl overflow-hidden hover-up'); ?>>
    <header class="entry-header mb-4">
        <?php the_title( sprintf( '<h2 class="entry-title text-xl font-bold mb-2"><a href="%s" rel="bookmark" class="hover:text-sky-500 transition-colors">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta text-gray-500 text-sm">
            <?php
            azia_posted_on();
            azia_posted_by();
            ?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-thumbnail mb-4 rounded-xl overflow-hidden">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-auto hover:scale-105 transition-transform duration-700' ) ); ?>
        </a>
    </div>
    <?php endif; ?>

    <div class="entry-summary mb-4 text-gray-700">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->

    <footer class="entry-footer text-gray-500 text-sm flex justify-between items-center">
        <?php if ( 'post' === get_post_type() ) : ?>
            <div>
                <?php
                $categories_list = get_the_category_list( esc_html__( ', ', 'azia' ) );
                if ( $categories_list ) {
                    /* translators: 1: list of categories. */
                    printf( '<span class="cat-links">' . esc_html__( 'In %1$s', 'azia' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }
                ?>
            </div>
        <?php endif; ?>
        
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="inline-flex items-center text-sky-500 font-medium hover:text-indigo-600 transition-colors group">
            <?php esc_html_e( 'Read More', 'azia' ); ?>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->