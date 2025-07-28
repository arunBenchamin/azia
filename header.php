<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class('overflow-x-hidden'); ?>>
    <?php wp_body_open(); ?>

    <!-- Noise texture overlay -->
    <div class="noise"></div>
    <!-- Background blobs -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="blob bg-blue-100/50 w-96 h-96 -top-20 -left-20"></div>
        <div class="blob bg-purple-100/50 w-80 h-80 top-1/3 -right-20 animation-delay-2"></div>
        <div class="blob bg-pink-100/50 w-72 h-72 bottom-10 left-1/4 animation-delay-3"></div>
    </div>

    <!-- Header -->
    <header id="masthead" class="site-header glass-header shadow-sm">
        <div class="container">
            <div class="header-inner">
                <!-- Logo -->
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                        <div class="logo-icon">
                            <?php echo esc_html(substr(get_bloginfo('name'), 0, 1)); ?>
                        </div>
                        <div class="logo-text">
                            <span class="text-gray-800"><?php bloginfo('name'); ?></span>
                            <?php if (get_bloginfo('description')) : ?>
                                <span class="gradient-text"><?php bloginfo('description'); ?></span>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endif; ?>

                <!-- Desktop Navigation -->
                <nav id="desktop-menu" class="desktop-nav">
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_class'     => 'desktop-nav',
                                'container'      => false,
                                'fallback_cb'    => false,
                                'walker'         => new Azia_Nav_Walker(),
                            )
                        );
                    } else {
                        // Display default menu if no menu is assigned
                        echo '<a href="' . esc_url(home_url('/')) . '" class="menu-item active">Home</a>';
                    }
                    ?>
                </nav>

                <!-- Mobile Menu Button -->
                <button class="mobile-menu-btn" id="mobileMenuButton" aria-label="Open mobile menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>


    </header>
    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <!-- Close button -->
        <button class="absolute top-6 right-6 mobile-menu-btn" id="closeMenuButton" aria-label="Close mobile menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Mobile Navigation -->
        <nav class="mobile-nav">
            <?php
            if (has_nav_menu('mobile')) {
                wp_nav_menu(
                    array(
                        'theme_location' => 'mobile',
                        'menu_class'     => 'mobile-nav',
                        'container'      => false,
                        'fallback_cb'    => false,
                    )
                );
            } else if (has_nav_menu('primary')) {
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'mobile-nav',
                        'container'      => false,
                        'fallback_cb'    => false,
                    )
                );
            } else {
                // Display default menu if no menu is assigned
                echo '<a href="' . esc_url(home_url('/')) . '" class="menu-item">Home</a>';
            }
            ?>


        </nav>
    </div>