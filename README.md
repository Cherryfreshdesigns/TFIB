# TFIB

This repository contains the code for the TFIB WordPress site, including the custom `tfib` child theme.

## Structure

- `wp-content/themes/tfib/` — Custom Hello Elementor child theme used for the TFIB shop, including WooCommerce templates and styling.
- `wp-content/plugins/` — WordPress plugins (managed via WordPress admin; generally not modified directly here).
- `wp-content/uploads/` — User-generated content (ignored in git by default).

## Getting Started

1. Clone this repository into your local WordPress environment (or add a remote to an existing Local WP site).
2. Ensure the database and `wp-config.php` are configured locally; these are not committed to the repo.
3. Activate the `tfib` theme in **Appearance → Themes**.

## Development Notes

- All custom theme code lives in `wp-content/themes/tfib/`.
- CSS for WooCommerce and shop layout lives in `wp-content/themes/tfib/assets/css/woocommerce.css`.
- Custom shop behavior (filters, layout) JavaScript lives in `wp-content/themes/tfib/assets/js/filters.js`.

## Git Workflow

- Create feature branches from `main` for new work, e.g. `feature/shop-layout`.
- Commit focused changes with clear messages (e.g. `feat: add Nike-style shop grid`).
- Push branches to GitHub and open pull requests for review before merging.

## Sensitive Data

- `wp-config.php` and other environment-specific files are intentionally ignored in `.gitignore`.
- Do **not** commit secrets, API keys, or production credentials to this repository.
