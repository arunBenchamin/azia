<?php
/**
 * The template for displaying search results pages
 *
 * @package Azia
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main pt-28 pb-20 md:py-36">
        <div class="container mx-auto px-6">

            <?php if ( have_posts() ) : ?>

                <header class="page-header mb-10">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 tracking-tight">
                        <?php
                        /* translators: %s: search query. */
                        printf( esc_html__( 'Search Results for: %s', 'azia-social' ), '<span class="gradient-text">' . get_search_query() . '</span>' );
                        ?>
                    </h1>
                    <?php get_search_form(); ?>
                </header><!-- .page-header -->

                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', 'search' );

                endwhile;

                the_posts_pagination(
                    array(
                        'mid_size'  => 2,
                        'prev_text' => sprintf(
                            '<span class="nav-prev-text">%s</span>',
                            __( 'Previous', 'azia-social' )
                        ),
                        'next_text' => sprintf(
                            '<span class="nav-next-text">%s</span>',
                            __( 'Next', 'azia-social' )
                        ),
                    )
                );

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>

        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();