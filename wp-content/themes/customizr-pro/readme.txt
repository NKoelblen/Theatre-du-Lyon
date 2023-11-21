# Customizr Pro v2.4.23
![Customizr - Pro](/screenshot.png)

> The pro version of the popular Customizr WordPress theme.

## Copyright
**Customizr Pro** is a WordPress theme designed by Nicolas Guillaume in Nice, France. ([website : Press Customizr](http://presscustomizr.com>))
Customizr Pro is distributed under the terms of the [GNU GPL v2.0 or later](http://www.gnu.org/licenses/gpl-3.0.en.html)

## Demo, Documentation, FAQs and Support
* DEMO : https://demo.presscustomizr.com/
* DOCUMENTATION : https://docs.presscustomizr.com/article/182-getting-started-with-the-customizr-pro-wordpress-theme
* FAQs : https://docs.presscustomizr.com/customizr-pro/faq
* SUPPORT : https://presscustomizr.com/support/

## Changelog

= 2.4.23 August 23th 2022 =
* update : restrict auto google fonts

= 2.4.22 December 6th 2021 =
* checked : [WP 5.9] preliminary successfull tests with the beta version of WordPress 5.9
* update : [admin] admin page wording

= 2.4.21 October 27th 2021 =
* fixed : [HTML] removed type attribute for script elements
* fixed : [HTML] removed type attribute for style elements
* fixed : [CSS] The first argument to the linear-gradient function should be "to top", not "top" as per w3 specification
* fixed : [CSS] minor box-shadow property fix
* fixed : [CSS] value hidden doesn't exist for property webkit-backface-visibility

= 2.4.20 October 6th 2021 =
* fixed : [CSS] minor CSS W3C validation error
* fixed : [CSS][customizer] improved style for textareas
* improved : [admin] update notice style and wording

= 2.4.19 September 20th 2021 =
* fixed : [PHP] improved compatibility with PHP 8.0

= 2.4.18 September 10th 2021 =
* fixed : Using Tickets add-on for The Events Calendar generates a bug
* improved : update notice now includes a link to changelog
* added : sms and map icon in social list
* improved : design of the theme's admin page

= 2.4.17 September 2nd 2021 =
* fixed : [PHP8] improved compatibility with PHP8, fix social links displayed in sidebars even when unchecked in customizer options

= 2.4.16 August 25th 2021 =
* fixed : [header][PHP8] tagline and social links in header might be displayed even when unchecked in options
* fixed : [table style] disable CSS rule table-layout: fixed; on mobile devices to prevent displaying unreadable tables

= 2.4.15 July 28th 2021 =
* fixed : [PHP8] theme updater possible error with PHP8

= 2.4.14 July 19th, 2021 =
* 100% compatible with WordPress 5.8
* fixed : [lazy load] compatibility with Nimble Builder

= 2.4.13 June 21st, 2021 =
* fixed : [PHP] removed various deprecated calls in head and header

= 2.4.12 June 1st, 2021 =
* fixed : [performance] Using wp_cache_set() can break sites using persistent caching like Memcached
* fixed : [PHP8] compatibility issue ( required parameter follows optional parameter )
* fixed : [accessibility] improve accessibility of checkbox toggle for slider options
* fixed : [markup] remove W3C deprecated attributes for script and style tags

= 2.4.11 May 26th, 2021 =
* fixed : [accessibility] accessibility of toggle checkboxes in the customizer

= 2.4.9 April 12th, 2021 =
* fixed : [WooCommerce] checkboxes on checkout page can be broken when Font Awesome icons are not loaded

= 2.4.8 March 30th, 2021 =
* fixed : [header] when centered on desktop, the site title stays left aligned
* fixed : [PHP] error when global font-size left blank. "Unsupported operand types: string / int"
* successufully tested with WP 5.7

= 2.4.7 February 2nd, 2021 =
* fixed : Conflict with OptimizePress3
* fixed : [header] top offset issue when user logged in
* updated : Font Awesome icons to latest version (v5.15.2)
* added : [social links] added Tiktok icon

= 2.4.6 January 22nd, 2021 =
* fixed : [effect] effect not applied on all expected selectors due to an error in the inline javascript code

= 2.4.5 January 17th, 2021 =
* fixed : [PHP 8] error Uncaught ValueError: Unknown format specifier “;” in core/czr-customize-ccat.php:966

= 2.4.4 January 13th, 2021 =
* added : [featured pages] support for shortcodes in fp custom text
* added : [social links] mastodon icon

= 2.4.3 January 8th, 2021 =
* fixed : [PHP 8.0] broken value checks on boolean options

= 2.4.1 January 5th, 2021 =
* fixed : [performance] preload customizr.woff2 font
* fixed : [performance][php] removed duplicated queries for 'template' option and thumbnail models
* fixed : [performance] improve loading performance of Font awesome icons to comply with Google lighthouse metrics ( preload warning removed )
* improved : [performance][footer] replaced font awesome WP icon

= 2.4.0 December 14th, 2020 =
* fixed : [PHP 8] Fix deprecation notices for optional function parameters declared before required parameter

= 2.3.14 December 10th, 2020 =
* fixed : [WP 5.6][WP 5.7] replaced deprecated shorthands
* fixed : [WP 5.6][fancybox] Close (x) link not working on pop-up image in galleries
* fixed : [WP Gallery Block] padding style conflict created by the theme

= 2.3.13 December 2nd, 2020 =
* fixed : [links] external links icons not displayed

= 2.3.12 December 1st, 2020 =
* fixed : [menu] javascript error on click on menu item with an anchor link

= 2.3.11 December 1st, 2020 =
* fixed : [headings] H3 heading size not smaller enough than H2 makes it difficult to distinguish
* fixed : [WP 5.7] remove jquery-migrate dependencies
* improved : [Font customizer][performance][JS] remove webfontload library from front js
* improved : [Font customizer][performance][JS] write front js inline
* improved : [Font customizer][performance][CSS] write base front CSS inline + load stylesheet for effects only when needed
* improved : [Font customizer][performance][CSS] loads Google effect images locally
* improved : [Home Features Pages][performance] print front js inline

= 2.3.10 November 23rd, 2020 =
* fixed : [Links] => when underline is disabled, hovering/activating a link should display the underline

= 2.3.9 November 19th, 2020 =
* added : [CSS][links] added a new option to opt-out underline on links. Option located in customizer > Global Settings > Formatting

= 2.3.8 November 17th, 2020 =
* fixed : [javascript] console warning when resizing in console due to an error in flickity slider script

= 2.3.7 November 17th, 2020 =
* fixed : [TRT requirement][accessibility] Links within content must be underlined
* fixed : [WP 5.6][jQuery] adapt to WP jQuery updated version. Prepare removal of jQuery Migrate in future WP 5.7 ( https://make.wordpress.org/core/2020/06/29/updating-jquery-version-shipped-with-wordpress/ )

= 2.3.6 November 4th, 2020 =
* fixed : [PHP] possible warning => "Deprecated: Invalid characters passed for attempted conversion" when converting hex colors
* added : support for auto-update

= 2.3.5 November 2nd, 2020 =
* tested : [WordPress] Customizr v4.3.5 is 100% compatible with WP 5.5.3
* fixed : [Menu] right clicking a parent menu item breaks sub-menu items auto-collapse
* fixed : [CSS] add back the "home" CSS class to body tag when user picked option "Don't show any posts or page"
* fixed : [Infinite scrool] WooCommerce, if infinite scroll is not supported,remove the "load more products" button
* added : [Infinite scroll] implement a new filters 'czr_infinite_scroll_handle_text' allowing developers to replace the text "Load more..." by a custom one
