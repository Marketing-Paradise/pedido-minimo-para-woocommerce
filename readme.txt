=== Minimum order for WooCommerce ===
Contributors: marketingparadise
Tags: woocommerce, minimum order, cart, checkout, e-commerce
Requires at least: 5.8
Tested up to: 7.1
Stable tag: 1.1.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Set a minimum order amount in your WooCommerce store to be able to check out. Simple, lightweight, and effective.

== Description ==

Do you want to ensure your customers reach a minimum amount before completing an order? **Minimum order for WooCommerce** is the ideal tool for you.

This plugin allows you to set a minimum value that the cart subtotal must reach for the customer to proceed to checkout. If this requirement is not met, a clear notice will be displayed on the cart page, and the checkout process will be prevented.

**Main Features:**

* **Simple Configuration:** Adds three single options to define the minimum amount.
* **Clear Notices:** Messages on the cart and checkout pages to inform the user when they have not reached the minimum.
* **Full Compatibility:** Native integration with WooCommerce and compatible with most themes.
* **Optimal Performance:** Clean, lightweight code that aligns with WordPress development best practices.
* **Developer-Friendly:** Includes custom filter hooks to dynamically adjust the minimum amount or the evaluated cart subtotal.

== Installation ==

**Automatic Installation (Recommended):**

1.  From your WordPress dashboard, navigate to `Plugins > Add New`.
2.  Search for "minimum order".
3.  Click "Install Now" and then "Activate".
4.  Go to `WooCommerce > Minimum order` to set the minimum amount in the corresponding section.

**Manual Installation:**

1.  Download the plugin's `.zip` file from the WordPress.org repository.
2.  Unzip the file. You will upload the `pedido-minimo-for-woocommerce` folder to the `/wp-content/plugins/` directory of your WordPress installation.
3.  Activate the plugin from the `Plugins` menu in your dashboard.
4.  Configure the amount in `WooCommerce > Minimum Order`.

== Frequently Asked Questions ==

= Does the minimum amount include shipping costs? =

No, the plugin validates the amount against the **cart subtotal**. You have the option to do this before or after applying a coupon discount.

= Can I customize the message shown to the user? =

Yes, the plugin has a field to customize the message.

= Is it compatible with my theme? =

The plugin uses standard WooCommerce hooks to display notices, so it should be compatible with any theme that follows WooCommerce standards.

= Does it affect my site's performance? =

No. The plugin is extremely lightweight, and its code only runs on the cart and checkout pages, so the impact on performance is negligible.

= Can I dynamically change the minimum order amount or the evaluated cart subtotal using code? =

Yes. The plugin provides two custom filter hooks for developers so you can adapt the validation logic without modifying the plugin files:

* **`pedidominimo_minimum_order`**: Filters the minimum order amount before validation. Receives `(float) $minimum`.
* **`pedidominimo_cart_subtotal`**: Filters the evaluated cart subtotal before comparing it against the minimum amount. Receives `(float) $subtotal` and `(WC_Cart) $cart`.

= How can I set a different minimum order amount for specific user roles? =

You can hook into `pedidominimo_minimum_order` from your child theme's `functions.php` file or a custom snippets plugin. For example, to set a 100 minimum order for wholesale customers:

function set_wholesale_minimum_order( $minimum ) {
	if ( ! is_user_logged_in() ) {
		return (float) $minimum;
	}

	$user = wp_get_current_user();

	if ( in_array( 'wholesale_customer', (array) $user->roles, true ) ) {
		return 100.0;
	}

	return (float) $minimum;
}
add_filter( 'pedidominimo_minimum_order', 'set_wholesale_minimum_order', 10, 1 );`

== Screenshots ==

1.  The settings page where the minimum amount is configured.
2.  Notice on the cart page when the minimum is not met.
3.  Notice on the checkout page if the minimum is not met.

== Changelog ==

= 1.1.0 - 2026-11-18 =
* New: Added `pedidominimo_minimum_order` and `pedidominimo_cart_subtotal` filter hooks to allow customizing the minimum order amount and the evaluated cart subtotal.
* Fix: Included taxes in the evaluated cart subtotal when WooCommerce is configured to display prices including tax.

= 1.0.10 - 2026-10-19 =
* Confirm WordPress 7.1.3 compatibility.
* Confirm WooCommerce 11.2.1 compatibility.

= 1.0.9 - 2026-05-28 =
* Confirm WordPress 7.0 compatibility.
* Confirm WooCommerce 10.8.1 compatibility.

= 1.0.8 - 2026-03-10 =
* New: Added a link to settings in plugin action links.
* Confirm WooCommerce 10.5.3 compatibility.

= 1.0.7 - 2026-02-11 =
* Fix: Corrected a problem where the total cart amount was not displayed correctly in the message when there was a discount.

= 1.0.6.1 - 2026-01-15 =
* Fix: Corrected blueprint for repository live preview.

= 1.0.6 - 2026-01-15 =
* Fix: Corrected some texts.

= 1.0.5 - 2025-12-05 =
* New: Added option to customize the message shown to the user.

= 1.0.4 - 2025-10-07 =
* New: Added option to take coupon discounts into account.
* Fix: Corrected the English texts.

= 1.0.3 - 2025-09-15 =
* Tweak: Minor changes to class and function names.

= 1.0.2 - 2025-09-09 =
* Tweak: Rename and change the description of the plugin.

= 1.0.1 - 2025-09-03 =
* Fix: Corrected internationalization strings.
* Fix: Corrected escaping for some variables.

= 1.0.0 - 2025-09-01 =
* Initial release of the plugin.
* Basic functionality to set a minimum amount in the cart.
* Visible notice on the cart page when the minimum amount is not reached.