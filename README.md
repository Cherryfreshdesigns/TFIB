# The Focus is Betterment - WordPress WooCommerce Theme

A modern, responsive WordPress theme designed specifically for WooCommerce e-commerce websites. Built for The Focus is Betterment website with clean design, excellent user experience, and full WooCommerce integration.

## Features

- **Full WooCommerce Support**: Complete integration with WooCommerce including product galleries, cart functionality, and checkout
- **Responsive Design**: Mobile-first approach ensuring great experience on all devices
- **Modern Layout**: Clean, professional design with customizable colors
- **SEO Friendly**: Built with best practices for search engine optimization
- **Widget Areas**: Multiple widget areas including sidebar and footer columns
- **Custom Menus**: Support for primary and footer navigation menus
- **Translation Ready**: Full support for internationalization
- **Custom Logo Support**: Easy logo upload through WordPress Customizer
- **Performance Optimized**: Lightweight and fast-loading

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- WooCommerce plugin (latest version recommended)

## Installation

1. Download the theme files
2. Upload to `/wp-content/themes/TFIB/` directory
3. Activate the theme through the WordPress admin panel (Appearance > Themes)
4. Install and activate WooCommerce plugin if not already installed
5. Configure theme settings through Appearance > Customize

## Theme Setup

### Menus
1. Go to Appearance > Menus
2. Create a new menu and assign it to "Primary Menu" location
3. Optionally create a footer menu and assign to "Footer Menu" location

### Widgets
The theme includes the following widget areas:
- **Sidebar**: Main sidebar for blog posts and pages
- **Footer 1, 2, 3**: Three footer columns for footer widgets

### WooCommerce Setup
1. Install WooCommerce plugin
2. Complete WooCommerce setup wizard
3. The theme will automatically integrate with WooCommerce
4. Products will display in a 3-column grid layout (12 products per page)

### Customization
Access customization options through Appearance > Customize:
- Site Identity: Upload logo, set site title and tagline
- Colors: Customize primary theme color
- Menus: Assign menus to locations
- Widgets: Configure widget areas

## File Structure

```
TFIB/
├── inc/                    # Theme includes
│   ├── customizer.php      # Customizer settings
│   ├── template-tags.php   # Custom template functions
│   └── woocommerce.php     # WooCommerce integration
├── js/                     # JavaScript files
│   ├── customizer.js       # Customizer preview JS
│   └── theme.js            # Main theme JavaScript
├── template-parts/         # Template part files
│   ├── content.php         # Default post content
│   ├── content-single.php  # Single post content
│   ├── content-page.php    # Page content
│   ├── content-search.php  # Search results content
│   └── content-none.php    # No results content
├── woocommerce/           # WooCommerce template overrides
│   └── content-product.php # Product loop template
├── archive.php            # Archive template
├── footer.php             # Footer template
├── functions.php          # Theme functions
├── header.php             # Header template
├── index.php              # Main template
├── page.php               # Page template
├── search.php             # Search template
├── sidebar.php            # Sidebar template
├── single.php             # Single post template
├── style.css              # Main stylesheet
└── README.md              # This file
```

## Support

For theme support and issues:
- GitHub Repository: https://github.com/Cherryfreshdesigns/TFIB
- Theme Author: Cherry Fresh Designs

## Development

The theme is built with:
- Pure HTML5 and CSS3
- JavaScript/jQuery for interactions
- WordPress template hierarchy
- WooCommerce hooks and filters

## License

This theme is licensed under GNU General Public License v2 or later.

## Credits

- Theme Developer: Cherry Fresh Designs
- Built for: The Focus is Betterment
- WooCommerce: Automattic

## Changelog

### Version 1.0.0
- Initial release
- Full WooCommerce integration
- Responsive design
- Widget areas
- Custom menus
- Customizer integration
- Translation ready