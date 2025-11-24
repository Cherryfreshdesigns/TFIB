document.addEventListener('DOMContentLoaded', function() {
	var sidebar = document.querySelector('.tfib-shop-sidebar');
	var body = document.body;
	var headerToggle = document.querySelector('.tfib-filter-offcanvas-toggle');
	var headerToggleLabel = headerToggle ? headerToggle.querySelector('.tfib-filter-label') : null;
	var filtersToggle = document.querySelector('.tfib-shop-filters-toggle');

	if (!sidebar) return;

	function updateHeaderLabel() {
		if (!headerToggleLabel) return;
		var isOpenMobile = body.classList.contains('tfib-filters-open');
		var isHiddenDesktop = body.classList.contains('tfib-sidebar-hidden');

		// On mobile/tablet, label describes action: open = "Hide", closed = "Show".
		// On desktop, sidebar is part of the layout: is-open means hidden.
		if (window.matchMedia('(max-width: 1024px)').matches) {
			headerToggleLabel.textContent = isOpenMobile ? 'Hide Filters' : 'Show Filters';
		} else {
			headerToggleLabel.textContent = isHiddenDesktop ? 'Show Filters' : 'Hide Filters';
		}
	}

	// Accessibility helpers
	var lastFocusedElement = null;

	function setAriaExpanded(el, expanded) {
		if (!el) return;
		el.setAttribute('aria-expanded', expanded ? 'true' : 'false');
	}

	function getFocusableElements(container) {
		if (!container) return [];
		var selector = 'a[href], button:not([disabled]), textarea, input:not([type="hidden"]), select, [tabindex]:not([tabindex="-1"])';
		var nodes = Array.prototype.slice.call(container.querySelectorAll(selector));
		return nodes.filter(function (el) {
			return el.offsetWidth > 0 || el.offsetHeight > 0 || el.getClientRects().length;
		});
	}

	function trapFocus(e) {
		if (!document.body.classList.contains('tfib-filters-open')) return;
		if (!sidebar.contains(document.activeElement)) return; // let it be if focus is outside

		var focusable = getFocusableElements(sidebar);
		if (focusable.length === 0) return;
		var first = focusable[0];
		var last = focusable[focusable.length - 1];

		if (e.key === 'Tab') {
			if (e.shiftKey) { // shift+tab
				if (document.activeElement === first) {
					e.preventDefault();
					last.focus();
				}
			} else { // tab
				if (document.activeElement === last) {
					e.preventDefault();
					first.focus();
				}
			}
		}
	}

	function openFilters() {
		lastFocusedElement = document.activeElement;
		var isMobile = window.matchMedia('(max-width: 1024px)').matches;
		if (isMobile) {
			// Mobile: slide-in off-canvas + overlay
			sidebar.classList.add('is-open');
			document.body.classList.add('tfib-filters-open');
			// don't touch body.tfib-sidebar-hidden on mobile
		} else {
			// Desktop: "Hide Filters" behavior — hide the sidebar and let content span
			sidebar.classList.add('is-open');
			document.body.classList.add('tfib-sidebar-hidden');
		}
		setAriaExpanded(headerToggle, true);
		setAriaExpanded(filtersToggle, true);
		sidebar.setAttribute('aria-hidden', 'false');

		// Move focus to first focusable in sidebar (mobile only)
		var focusable = getFocusableElements(sidebar);
		if (isMobile && focusable.length) {
			focusable[0].focus();
		} else if (isMobile) {
			// fallback: focus the sidebar container on mobile
			sidebar.setAttribute('tabindex', '-1');
			sidebar.focus();
		}
		// Only trap focus on mobile off-canvas
		if (isMobile) {
			document.addEventListener('keydown', trapFocus);
		}
	}

	function closeFilters() {
		var isMobile = window.matchMedia('(max-width: 1024px)').matches;
		if (isMobile) {
			// Mobile: remove off-canvas + overlay
			sidebar.classList.remove('is-open');
			document.body.classList.remove('tfib-filters-open');
		} else {
			// Desktop: restore sidebar in layout
			sidebar.classList.remove('is-open');
			document.body.classList.remove('tfib-sidebar-hidden');
		}
		setAriaExpanded(headerToggle, false);
		setAriaExpanded(filtersToggle, false);
		sidebar.setAttribute('aria-hidden', 'true');
		// remove focus trap if it was added
		document.removeEventListener('keydown', trapFocus);

		// return focus to the element that opened the filters
		if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
			lastFocusedElement.focus();
		}
	}

	function toggleFilters() {
		var isOpen = sidebar.classList.contains('is-open');
		if (isOpen) {
			closeFilters();
		} else {
			openFilters();
		}
		updateHeaderLabel();
	}

	// Click handlers for both header button and internal Filters button.
	if (headerToggle) {
		headerToggle.addEventListener('click', function(event) {
			event.preventDefault();
			toggleFilters();
		});
	}

	if (filtersToggle) {
		filtersToggle.addEventListener('click', function(event) {
			event.preventDefault();
			toggleFilters();
		});
	}

	// Create an overlay for mobile when filters are open so clicking outside closes it
	var overlay = document.querySelector('.tfib-filters-overlay');
	if (!overlay) {
		overlay = document.createElement('div');
		overlay.className = 'tfib-filters-overlay';
		document.body.appendChild(overlay);
	}

	overlay.addEventListener('click', function() {
		// Close via shared handler which branches by viewport
		closeFilters();
		updateHeaderLabel();
	});

	// Close with Escape key for accessibility
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape') {
			// If either mobile overlay is open or desktop hide is active, close
			if (body.classList.contains('tfib-filters-open') || body.classList.contains('tfib-sidebar-hidden')) {
				closeFilters();
				updateHeaderLabel();
			}
		}
	});

	// Keep label in sync on resize between desktop and mobile layouts.
	window.addEventListener('resize', function() {
		updateHeaderLabel();
	});

	// Initial label state.
	updateHeaderLabel();
});

