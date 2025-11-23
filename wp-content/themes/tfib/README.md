# TFIB Theme

Custom WooCommerce + Elementor theme for The Focus Is Betterment athletic apparel brand.

## Features

- WooCommerce styles fully overridden via `assets/css/woocommerce.css`.
- Custom `archive-product.php` shop layout with sidebar filters and responsive grid.
- `woocommerce/content-product.php` product card markup.
- Simple JS-driven show/hide filter toggle for mobile.
- **Shipping rate filtering** - Shows only premium shipping options (USPS Priority/Express, UPS 2nd Day/Next Day Air)
- **Clean checkout experience** - Removes unnecessary WooCommerce debug notices

## Usage

1. Copy the `tfib` folder into `wp-content/themes/`.
2. In WordPress admin, activate **TFIB** theme.
3. Ensure WooCommerce and Elementor are installed and activated.
4. Build headers/footers with Elementor Theme Builder if desired.

## Shipping Configuration

The theme automatically filters shipping options to show only premium services:

**Included carriers:**
- Stamps.com (USPS Priority Mail, Priority Mail Express)
- UPS (2nd Day Air, Next Day Air)

**Excluded services:**
- First Class Mail
- Parcel Select
- Ground Advantage
- Media Mail

To modify shipping options, edit the `tfib_filter_shipping_rates()` function in `functions.php`:
- Add carriers: Uncomment `'fedex'` in `$include_keywords` array
- Change excluded services: Modify the `$exclude_keywords` array

## Recent Changes

### November 23, 2025
- **Added shipping rate filter** - Limits checkout to 4 premium shipping options only
- **Fixed carrier label matching** - Updated from 'usps' to 'stamps.com' to match actual ShipStation labels
- **Added multi-carrier support** - Configured for USPS (via Stamps.com) and UPS carriers
- **Removed zone matching notices** - Filters out "Customer matched zone" debug messages from checkout page

### Commit History
- `3540a1a` - Remove 'Customer matched zone' notices from checkout
- `851bdea` - Limit shipping to Priority Mail and Express only (exclude slow/budget services)
- `5fb0d76` - Fix shipping filter keyword from 'usps' to 'stamps.com'
- `8daa703` - Add initial shipping rate filter
