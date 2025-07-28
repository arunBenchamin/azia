<!-- Footer Section -->
<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="footer-inner">
            <!-- Logo -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <div class="logo-icon">
                        <?php echo esc_html( substr( get_bloginfo( 'name' ), 0, 1 ) ); ?>
                    </div>
                    <div class="logo-text">
                        <span class="font-semibold text-gray-800"><?php bloginfo( 'name' ); ?></span>
                        <?php if ( get_bloginfo( 'description' ) ) : ?>
                            <span class="gradient-text font-semibold"><?php bloginfo( 'description' ); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </a>
            
            <!-- Navigation -->
            <nav class="footer-nav">
                <?php
                if ( has_nav_menu( 'footer' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-nav',
                            'container'      => false,
                            'fallback_cb'    => false,
                            'depth'          => 1,
                        )
                    );
                } else {
                    // Display default menu if no menu is assigned
                }
                ?>
            </nav>
            
            <!-- Copyright -->
            <div class="copyright">
                &copy; <?php echo date_i18n( _x( 'Y', 'copyright date format', 'azia-social' ) ); ?> 
                <?php bloginfo( 'name' ); ?>. 
                <?php esc_html_e( 'All rights reserved.', 'azia-social' ); ?>
            </div>
        </div>
        
        <?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
            <div class="footer-widgets-area mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php dynamic_sidebar( 'footer-widgets' ); ?>
            </div>
        <?php endif; ?>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="backToTop" class="back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'azia-social' ); ?>">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
    </svg>
</button>

<?php wp_footer(); ?>
</body>
</html>