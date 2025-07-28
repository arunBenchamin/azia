<?php
/**
 * The template for displaying all pages
 *
 * @package Azia
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main pt-28 pb-20 md:py-36">
        <div class="container mx-auto px-6">
            <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', 'page' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();