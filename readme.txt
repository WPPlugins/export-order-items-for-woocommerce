=== Export Order Items for WooCommerce ===
Contributors: hearken
Donate link: https://potentplugins.com/donate/?utm_source=export-order-items-for-woocommerce&utm_medium=link&utm_campaign=wp-plugin-readme-donate-link
Tags: woocommerce, orders, order items, line items, sales, report, reporting, export, csv, excel, spreadsheet
Requires at least: 3.5
Tested up to: 4.8
Stable tag: 1.0.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Export order items (products ordered) in CSV (Comma Seperated Values) format, with product, line item, order, and customer data.

== Description ==

The Export Order Items plugin generates a CSV formatted spreadsheet containing data on individual order line items sold during a specified time period.

Features:

* Use a date range preset, or specify custom start and end dates.
* Select from 18 data fields that can be included in the report.
* Filter line items by order status (Pending Payment, Processing, Completed, Cancelled, etc.)
* Schedule the export to be sent automatically by email on a recurring basis with the [Scheduled Email Reports for WooCommerce](https://potentplugins.com/downloads/scheduled-email-reports-woocommerce-plugin/?utm_source=wc-export-order-items&utm_medium=link&utm_campaign=wp-repo-upgrade-link) addon.
* Embed the export or a download link in posts and pages with the [Frontend Reports for WooCommerce](https://potentplugins.com/downloads/frontend-reports-woocommerce-plugin/?utm_source=wc-export-order-items&utm_medium=link&utm_campaign=wp-repo-upgrade-link) addon.

A [pro version](https://potentplugins.com/downloads/export-order-items-pro-wordpress-plugin/?utm_source=export-order-items-for-woocommerce&utm_medium=link&utm_campaign=wp-repo-upgrade-link) with the following additional features is also available:

* Create multiple export presets to save time.
* Include product variation details.
* Include any custom field associated with an order, product order line item, product, or product variation.
* Limit the export to only include certain product IDs or product categories.
* Change the names and order of fields in the report.
* Export in XLS, XLSX, or HTML format (in addition to CSV).

If you like this free plugin, please consider [making a donation](https://potentplugins.com/donate/?utm_source=export-order-items-for-woocommerce&utm_medium=link&utm_campaign=wp-plugin-repo-donate-link).

== Installation ==

1. Click "Plugins" > "Add New" in the WordPress admin menu.
1. Search for "Export Order Items".
1. Click "Install Now".
1. Click "Activate Plugin".

Alternatively, you can manually upload the plugin to your wp-content/plugins directory.

== Frequently Asked Questions ==

== Screenshots ==

1. Report generation screen

== Changelog ==

= 1.0.7 =
* Fixed incorrect date ranges when using the "Last 7 days" or "Last 30 days" options
* Added future and calendar month date range options

= 1.0.6 =
* Fixed potential incompatibility with order status plugin(s)

= 1.0.4 =
* Bugfix

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.0.7 =
When using the "Last 7 days" or "Last 30 days" options in previous versions of the plugin, the computed date range included one too many days. We recommend updating immediately to ensure data accuracy.