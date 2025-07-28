/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	const mobileMenuButton = document.getElementById('mobileMenuButton');
	const closeMenuButton = document.getElementById('closeMenuButton');
	const mobileMenu = document.getElementById('mobileMenu');
	const header = document.querySelector('header');
	const backToTopBtn = document.getElementById('backToTop');

	// Mobile menu toggle
	if (mobileMenuButton && closeMenuButton && mobileMenu) {
		mobileMenuButton.addEventListener('click', function() {
			mobileMenu.classList.add('open');
			mobileMenu.classList.remove('translate-x-full');
			document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
		});
		
		closeMenuButton.addEventListener('click', function() {
			mobileMenu.classList.remove('open');
			mobileMenu.classList.add('translate-x-full');
			document.body.style.overflow = ''; // Re-enable scrolling
		});
	}

	// Header scroll effect
	if (header) {
		window.addEventListener('scroll', function() {
			if (window.scrollY > 50) {
				header.classList.add('py-2');
				header.classList.add('shadow-md');
			} else {
				header.classList.remove('py-2');
				header.classList.remove('shadow-md');
			}
		});
	}

	// Back to top button
	if (backToTopBtn) {
		window.addEventListener('scroll', function() {
			if (window.scrollY > 300) {
				backToTopBtn.classList.add('visible');
			} else {
				backToTopBtn.classList.remove('visible');
			}
		});

		backToTopBtn.addEventListener('click', function() {
			window.scrollTo({
				top: 0,
				behavior: 'smooth'
			});
		});
	}

	/**
	 * Focus trap within modal dialogs
	 */
	document.addEventListener('keydown', function(e) {
		// If not tab key or if menu is not open, do nothing
		if (e.key !== 'Tab' || !mobileMenu.classList.contains('open')) return;
		
		// Get all focusable elements in the mobile menu
		const focusableElements = mobileMenu.querySelectorAll('a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])');
		const firstElement = focusableElements[0];
		const lastElement = focusableElements[focusableElements.length - 1];
		
		// If shift + tab and first element is focused, focus on last element
		if (e.shiftKey && document.activeElement === firstElement) {
			e.preventDefault();
			lastElement.focus();
		} 
		
		// If tab and last element is focused, focus on first element
		else if (!e.shiftKey && document.activeElement === lastElement) {
			e.preventDefault();
			firstElement.focus();
		}
	});
	
	// Close mobile menu when ESC key is pressed
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape' && mobileMenu.classList.contains('open')) {
			mobileMenu.classList.remove('open');
			mobileMenu.classList.add('translate-x-full');
			document.body.style.overflow = '';
			mobileMenuButton.focus(); // Return focus to the menu button
		}
	});
} )();