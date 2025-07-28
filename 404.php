<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Azia
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main pt-28 pb-20 md:py-36">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto">
                <!-- 404 SVG Icon -->
                <div class="mb-8 relative">
                    <svg viewBox="0 0 200 100" class="w-full h-auto">
                        <text x="50%" y="50%" font-size="50" font-weight="bold" text-anchor="middle" dominant-baseline="middle" class="gradient-text">404</text>
                    </svg>
                    <!-- Decorative blobs -->
                    <div class="absolute -top-10 -left-10 w-20 h-20 bg-blue-100 rounded-full opacity-50 blob"></div>
                    <div class="absolute -bottom-10 -right-10 w-24 h-24 bg-purple-100 rounded-full opacity-50 blob animation-delay-2"></div>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-bold mb-6"><?php esc_html_e( 'Oops! Page Not Found', 'azia-social' ); ?></h1>
                
                <p class="text-lg text-gray-600 mb-12">
                    <?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching for what you\'re looking for?', 'azia-social' ); ?>
                </p>
                
                <div class="modern-card p-8 rounded-3xl max-w-md mx-auto">
                    <?php get_search_form(); ?>
                </div>
                
                <div class="mt-12">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="px-8 py-4 bg-gradient-to-r from-sky-500 to-indigo-500 text-white font-medium rounded-full hover:shadow-lg hover:shadow-indigo-500/20 transition-all inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <?php esc_html_e( 'Back to Homepage', 'azia-social' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();