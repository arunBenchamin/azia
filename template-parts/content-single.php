<?php
/**
 * Template part for displaying single posts
 *
 * @package Azia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('modern-card p-8 rounded-3xl overflow-hidden'); ?>>
    <header class="entry-header mb-8">
        <?php
        the_title( '<h1 class="entry-title text-4xl font-bold">', '</h1>' );
        
        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta mt-4 flex items-center flex-wrap gap-4 text-gray-500 text-sm">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <?php
                    azia_posted_on();
                    ?>
                </div>
                
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <?php
                    azia_posted_by();
                    ?>
                </div>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-thumbnail mb-8 rounded-xl overflow-hidden">
        <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
    </div>
    <?php endif; ?>

    <div class="entry-content text-gray-700 prose prose-lg max-w-none">
        <?php
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
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer mt-8 pt-8 border-t border-gray-100">
        <?php 
        // Show categories and tags
        $categories_list = get_the_category_list( esc_html__( ', ', 'azia' ) );
        if ( $categories_list ) {
            echo '<div class="mb-4 flex items-center">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>';
            /* translators: 1: list of categories. */
            printf( '<span class="cat-links text-gray-700">' . esc_html__( 'Categories: %1$s', 'azia' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo '</div>';
        }
        
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'azia' ) );
        if ( $tags_list ) {
            echo '<div class="mb-4 flex items-center">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
            </svg>';
            /* translators: 1: list of tags. */
            printf( '<span class="tags-links text-gray-700">' . esc_html__( 'Tags: %1$s', 'azia' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo '</div>';
        }
        
        // Edit link
        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'azia' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post( get_the_title() )
            ),
            '<div class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg><span class="edit-link text-gray-700">',
            '</span></div>'
        );
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->