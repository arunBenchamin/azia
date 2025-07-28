/**
 * Main scripts file for Azia WordPress theme
 */

(function (jQuery) {
    'use strict';

    // DOM elements
    const $header = jQuery('#masthead');
    const $mobileMenuBtn = jQuery('#mobileMenuButton');
    const $closeMenuBtn = jQuery('#closeMenuButton');
    const $mobileMenu = jQuery('#mobileMenu');
    const $backToTopBtn = jQuery('#backToTop');

    // Mobile Menu Toggle
    function setupMobileMenu() {
        $mobileMenuBtn.on('click', function () {
            $mobileMenu.addClass('open');
            $mobileMenu.removeClass('translate-x-full');
        });

        $closeMenuBtn.on('click', function () {
            $mobileMenu.removeClass('open');
            $mobileMenu.addClass('translate-x-full');
        });
    }

    // Header Scroll Effect
    function setupHeaderScroll() {
        jQuery(window).on('scroll', function () {
            if (jQuery(window).scrollTop() > 50) {
                $header.addClass('py-2 shadow-md');
            } else {
                $header.removeClass('py-2 shadow-md');
            }
        });
    }

    // Back to Top Button
    function setupBackToTop() {
        jQuery(window).on('scroll', function () {
            if (jQuery(window).scrollTop() > 300) {
                $backToTopBtn.addClass('visible');
            } else {
                $backToTopBtn.removeClass('visible');
            }
        });

        $backToTopBtn.on('click', function () {
            jQuery('html, body').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    }

    // Initialize functions on document ready
    jQuery(document).ready(function () {
        setupMobileMenu();
        setupHeaderScroll();
        setupBackToTop();
    });

})(jQuery);

//hero
document.addEventListener('DOMContentLoaded', function() {
    // Add 3D tilt effect to the profile image
    const tiltCard = document.querySelector('.tilt-card');
    if (tiltCard) {
        tiltCard.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const angleX = (y - centerY) / 20;
            const angleY = (centerX - x) / 20;
            
            this.style.transform = `perspective(1000px) rotateX(${angleX}deg) rotateY(${angleY}deg)`;
        });
        
        tiltCard.addEventListener('mouseleave', function() {
            this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
        });
    }
    
    // Add magnetic effect to buttons
    const magneticBtns = document.querySelectorAll('.magnetic-btn');
    if (magneticBtns.length > 0) {
        magneticBtns.forEach(btn => {
            btn.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const moveX = (x - centerX) / 10;
                const moveY = (y - centerY) / 10;
                
                this.style.transform = `translateX(${moveX}px) translateY(${moveY}px)`;
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0) translateY(0)';
            });
        });
    }
});

//portfolio


// Functions to handle project popup
function openProjectPopup(projectId, portfolioId) { 
    const $popup = jQuery('#projectPopup-' + portfolioId);
    
    // Show popup
    $popup.removeClass('hidden').addClass('fade-in');
    jQuery('body').css('overflow', 'hidden');
    
    // Add loading indicator
    $popup.find('.popup-content').html('<div class="flex justify-center items-center p-12"><div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500"></div></div>');

    // Load project content via AJAX
    jQuery.ajax({
        url: azia_ajax_object.ajax_url,
        type: 'POST',
        data: {
            action: 'azia_load_portfolio_project',
            project_id: projectId,
            nonce: azia_ajax_object.nonce
        },
        success: function (response) {
            if (response.success) {
                $popup.find('.popup-content').html(response.data.html);
 
                // Initialize close button in loaded content
                $popup.find('#closePopupBtn').on('click', function (e) {
                    e.preventDefault();
                    closeProjectPopup(portfolioId);
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
            $popup.find('.popup-content').html('<div class="text-center py-8 text-red-500">Error loading project. Please try again.</div>');
        }
    });
}

function closeProjectPopup(portfolioId) {
    const $popup = jQuery('#projectPopup-' + portfolioId);
    $popup.addClass('hidden').removeClass('fade-in');
    jQuery('body').css('overflow', '');
}


// Add this to your JavaScript file
jQuery(document).ready(function () {
    // Find all portfolio sections on the page
    initPortfolio();
});

function initPortfolio() { 
    jQuery('.portfolio-items').each(function () {
        const portfolioId = jQuery(this).attr('id');

        // Initialize filter functionality
        initFilterFunctionality(portfolioId);
        
        // Initialize pagination click handlers
        initPaginationClicks(portfolioId);
        
        // Initially update the filter buttons based on available categories
        updateFilterButtons(portfolioId);
    });
}

// Function to update filter buttons based on available categories
function updateFilterButtons(portfolioId) {
    const $portfolioItems = jQuery('#' + portfolioId + ' .portfolio-item');
    const $filterContainer = jQuery('#' + portfolioId + ' .filter-container');
    const $allFilterBtn = jQuery('#' + portfolioId + ' .filter-btn[data-filter="all"]');
    
    // Get all category filter buttons except "All"
    const $categoryFilterBtns = jQuery('#' + portfolioId + ' .filter-btn:not([data-filter="all"])');
    
    // Hide all category buttons first
    $categoryFilterBtns.hide();
    
    // Keep track of found categories
    const foundCategories = new Set();
    
    // Find all categories that exist in the current items
    $portfolioItems.each(function() {
        const classes = jQuery(this).attr('class').split(/\s+/);
        classes.forEach(className => {
            if (className.startsWith('cat-')) {
                const categoryId = className.replace('cat-', '');
                foundCategories.add(categoryId);
            }
        });
    });
    
    // Show only filter buttons for categories that exist in current items
    foundCategories.forEach(categoryId => {
        jQuery('#' + portfolioId + ' .filter-btn[data-filter="' + categoryId + '"]').show();
    });
    
    // If there are no category items, hide the filter container
    if (foundCategories.size === 0 && $portfolioItems.length === 0) {
        $filterContainer.hide();
    } else {
        $filterContainer.show();
        // Always show the "All" button if there are items
        $allFilterBtn.show();
    }
}

// Function to initialize filter functionality
function initFilterFunctionality(portfolioId) {
    const $filterBtns = jQuery('#' + portfolioId + ' .filter-btn');
    const $portfolioItems = jQuery('#' + portfolioId + ' .portfolio-item');
    const $popup = jQuery('#projectPopup-' + portfolioId);
    
    // First, unbind any existing click handlers to prevent duplicates
    $filterBtns.off('click');
    
    // Filter items
    $filterBtns.on('click', function () {
        const filterValue = jQuery(this).data('filter');
        
        // Store the active filter in a data attribute for future reference
        jQuery('#' + portfolioId).data('active-filter', filterValue);

        // Update active class on buttons
        $filterBtns.removeClass('active bg-indigo-50 text-indigo-500').addClass('bg-white text-gray-700');
        jQuery(this).addClass('active bg-indigo-50 text-indigo-500').removeClass('bg-white text-gray-700');

        // Filter items
        if (filterValue === 'all') {
            $portfolioItems.show();
        } else {
            $portfolioItems.hide();
            $portfolioItems.filter('.cat-' + filterValue).show();
        }
    });

    // View Project Button Click - first unbind any existing handlers
    jQuery('#' + portfolioId + ' .view-project-btn').off('click').on('click', function (e) {
        e.preventDefault();
        const projectId = jQuery(this).data('project-id');
        openProjectPopup(projectId, portfolioId);
    });

    // Close popup when clicking outside the popup content
    $popup.off('click').on('click', function (e) {
        if (jQuery(e.target).is($popup)) {
            closeProjectPopup(portfolioId);
        }
    });

    // Close popup with Escape key
    jQuery(document).off('keydown.popup' + portfolioId).on('keydown.popup' + portfolioId, function (e) {
        if (e.key === 'Escape' && !$popup.hasClass('hidden')) {
            closeProjectPopup(portfolioId);
        }
    });
}

// Function to initialize pagination clicks
function initPaginationClicks(portfolioId) {
    // First, unbind any existing click handlers to prevent duplicates
    jQuery('#' + portfolioId + ' .portfolio-pagination a').off('click');
    
    // Then bind new click handlers
    jQuery('#' + portfolioId + ' .portfolio-pagination a').on('click', function (e) {
        e.preventDefault();
        
        // Get page number directly from data attribute
        const pageNum = jQuery(this).data('page');
        
        if (!pageNum) return;

        // Show loading state
        jQuery('#' + portfolioId + ' .grid').html('<div class="col-span-full flex justify-center py-12"><div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500"></div></div>');

        // Get current filter
        const currentFilter = jQuery('#' + portfolioId).data('active-filter') || 
                             jQuery('#' + portfolioId + ' .filter-btn.active').data('filter') || 
                             'all';

        // AJAX request to load page
        jQuery.ajax({
            url: azia_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'azia_load_portfolio_page',
                page: pageNum,
                posts_per_page: jQuery('#' + portfolioId).data('posts-per-page') || 5,
                categories: jQuery('#' + portfolioId).data('categories') || [],
                orderby: jQuery('#' + portfolioId).data('orderby') || 'date',
                order: jQuery('#' + portfolioId).data('order') || 'DESC',
                nonce: azia_ajax_object.nonce
            },
            success: function (response) {
                if (response.success) {
                    // Replace items in grid
                    jQuery('#' + portfolioId + ' .grid').html(response.data.html);

                    // Update pagination
                    jQuery('#' + portfolioId + ' .portfolio-pagination').html(response.data.pagination);

                    // Re-initialize filter functionality
                    initFilterFunctionality(portfolioId);
                    
                    // Reinitialize pagination click handlers
                    initPaginationClicks(portfolioId);
                    
                    // Update which filter buttons are shown based on available categories
                    updateFilterButtons(portfolioId);

                    // Reset to "All" if the current filter doesn't exist in the new page
                    const filterExists = currentFilter === 'all' || 
                                       jQuery('#' + portfolioId + ' .portfolio-item.cat-' + currentFilter).length > 0;
                    
                    if (!filterExists) {
                        // Reset to "All" filter
                        jQuery('#' + portfolioId + ' .filter-btn[data-filter="all"]').trigger('click');
                    } else if (currentFilter && currentFilter !== 'all') {
                        // Apply the previous filter if it exists in the new page
                        jQuery('#' + portfolioId + ' .filter-btn').removeClass('active bg-indigo-50 text-indigo-500').addClass('bg-white text-gray-700');
                        jQuery('#' + portfolioId + ' .filter-btn[data-filter="' + currentFilter + '"]').addClass('active bg-indigo-50 text-indigo-500').removeClass('bg-white text-gray-700');
                        
                        jQuery('#' + portfolioId + ' .portfolio-item').hide();
                        jQuery('#' + portfolioId + ' .portfolio-item.cat-' + currentFilter).show();
                    }

                    // Scroll to top of portfolio section
                    jQuery('html, body').animate({
                        scrollTop: jQuery('#' + portfolioId).offset().top - 100
                    }, 500);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
                jQuery('#' + portfolioId + ' .grid').html('<div class="text-center py-8 text-red-500">Error loading content. Please try again.</div>');
            }
        });
    });
}

 // Function to initialize animations for large screens and handle small screens
function initAnimations() {
    'use strict';
    // For screens larger than 1024px, use intersection observer
    if (window.innerWidth > 1024) {
        const observer = new IntersectionObserver((entries) => {
            'use strict';
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.1 });
  
        document.querySelectorAll('.fade-in-effect').forEach(
            section => observer.observe(section)
        );
    } 
    // For smaller screens, add 'is-visible' class by default
    else {
        document.querySelectorAll('.fade-in-effect').forEach(
            section => section.classList.add('is-visible')
        );
    }
  }
  // Initialize animations on page load
document.addEventListener("DOMContentLoaded", initAnimations);