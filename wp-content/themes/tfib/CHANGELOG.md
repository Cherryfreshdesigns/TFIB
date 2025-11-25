# Changelog

All notable changes to this theme will be documented in this file.

## [2.0.0] - 2025-11-25
### Changed
- Bumped child theme version to `2.0.0`.
- Restored WooCommerce Filters block overlay behavior on mobile (allow plugin overlay to open).
- Updated `assets/css/woocommerce.css` to avoid hiding the block overlay and to hide theme-inserted clone containers to avoid duplicate chrome.
- Bumped `assets/css/woocommerce.css` enqueue version to `1.0.5` to force cache refresh.

### Notes
- This release focuses on improving mobile filter UX by deferring to the official WooCommerce overlay for filter interactions and adding child-theme fixes for spacing and accessibility.
