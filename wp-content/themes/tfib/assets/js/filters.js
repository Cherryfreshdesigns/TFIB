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
		var isHiddenDesktop = sidebar.classList.contains('is-open');

		// On mobile/tablet, label describes action: open = "Hide", closed = "Show".
		// On desktop, sidebar is part of the layout: is-open means hidden.
		if (window.matchMedia('(max-width: 1024px)').matches) {
			headerToggleLabel.textContent = isOpenMobile ? 'Hide Filters' : 'Show Filters';
		} else {
			headerToggleLabel.textContent = isHiddenDesktop ? 'Show Filters' : 'Hide Filters';
		}
	}

	function toggleFilters() {
		// Toggle classes that control visibility/layout.
		sidebar.classList.toggle('is-open');
		body.classList.toggle('tfib-filters-open');

		// When sidebar is hidden on desktop, let the grid span full width.
		if (sidebar.classList.contains('is-open')) {
			body.classList.add('tfib-sidebar-hidden');
		} else {
			body.classList.remove('tfib-sidebar-hidden');
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
		// close filters when clicking the overlay
		sidebar.classList.remove('is-open');
		body.classList.remove('tfib-filters-open');
		body.classList.remove('tfib-sidebar-hidden');
		updateHeaderLabel();
	});

	// Close with Escape key for accessibility
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape' && body.classList.contains('tfib-filters-open')) {
			sidebar.classList.remove('is-open');
			body.classList.remove('tfib-filters-open');
			body.classList.remove('tfib-sidebar-hidden');
			updateHeaderLabel();
		}
	});

	// Keep label in sync on resize between desktop and mobile layouts.
	window.addEventListener('resize', function() {
		updateHeaderLabel();
	});

	// Initial label state.
	updateHeaderLabel();
});

