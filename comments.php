<?php
/**
 * The template for displaying comments
 *
 * @package Azia
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            printf(
                esc_html(_n('%1$s Comment', '%1$s Comments', get_comments_number(), 'your-theme-textdomain')),
                number_format_i18n(get_comments_number())
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
            ));
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

    <?php endif; // Check for comments ?>

    <?php
    // If comments are open or there are comments, load the comment form.
    if (comments_open() || get_comments_number()) {
        comment_form();
    }
    ?>

</div><!-- #comments -->
