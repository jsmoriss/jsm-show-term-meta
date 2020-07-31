=== JSM's Show Term Metadata ===
Plugin Name: JSM's Show Term Metadata
Plugin Slug: jsm-show-term-meta
Text Domain: jsm-show-term-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://jsmoriss.github.io/jsm-show-term-meta/assets/
Tags: meta, term meta, inspector, custom fields, debug, tools
Contributors: jsmoriss
Requires PHP: 5.6
Requires At Least: 4.4
Tested Up To: 5.5
Stable Tag: 1.2.0

Show all term (categories, tags) meta in a metabox on term editing pages -- great plugin for developers or debugging issues with term meta.

== Description ==

Wondering about the term meta your theme and/or plugins might be creating?

Want to find the name of a specific term meta key?

Need some help debugging your term meta?

The JSM's Show Term Metadata plugin displays all term (categories, tags) meta keys and their unserialized values in a metabox at the bottom of term editing pages.

There are no plugin settings &mdash; simply *install* and *activate* the plugin.

> Term meta has been available since WordPress v4.4. Older plugins that supported "*term meta*" before WordPress v4.4 may not use the current WordPress term meta functions, preferring to use their own custom "*term meta*" solutions instead. This custom "*term meta*", which is not stored in the WordPress term meta table, will not appear in the Term Metadata list. You can contact the author of those older plugins to request an update, which uses the current WordPress term meta functions, or hook the 'jsm_stm_term_meta' filter to merge the custom "*term meta*". As an example, the [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/) plugin still does not use the new term meta functions, while the [WooCommerce](https://wordpress.org/plugins/woocommerce/) and [WPSSO](https://wordpress.org/plugins/wpsso/) plugins do.

= Related Plugins =

* [JSM's Show Post Metadata](https://wordpress.org/plugins/jsm-show-post-meta/)
* [JSM's Show User Metadata](https://wordpress.org/plugins/jsm-show-user-meta/)

== Installation ==

= Automated Install =

1. Go to the wp-admin/ section of your website.
1. Select the *Plugins* menu item.
1. Select the *Add New* sub-menu item.
1. In the *Search* box, enter the plugin name.
1. Click the *Search Plugins* button.
1. Click the *Install Now* link for the plugin.
1. Click the *Activate Plugin* link.

= Semi-Automated Install =

1. Download the plugin ZIP file.
1. Go to the wp-admin/ section of your website.
1. Select the *Plugins* menu item.
1. Select the *Add New* sub-menu item.
1. Click on *Upload* link (just under the Install Plugins page title).
1. Click the *Browse...* button.
1. Navigate your local folders / directories and choose the ZIP file you downloaded previously.
1. Click on the *Install Now* button.
1. Click the *Activate Plugin* link.

== Frequently Asked Questions ==

<h3 class="top">Frequently Asked Questions</h3>

* None.

<h3>Notes and Documentation</h3>

**Developer Filters**

An example to add Yoast SEO term meta to the "Term Metadata" metabox.

<pre>
add_filter( 'jsm_stm_term_meta', 'add_yoast_seo_term_meta', 10, 2 );

function add_yoast_seo_term_meta( $term_meta, $term_obj ) {

	$tax_opts = get_option( 'wpseo_taxonomy_meta' );

	if ( isset( $tax_opts[ $term_obj->taxonomy ][ $term_obj->term_id ] ) ) {
		$term_meta[ 'wpseo_taxonomy_meta' ][] = $tax_opts[ $term_obj->taxonomy ][ $term_obj->term_id ];
	}
	
	return $term_meta;
}
</pre>

== Screenshots ==

01. The Term Metadata metabox added to admin term editing pages.

== Changelog ==

<h3 class="top">Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Repositories</h3>

* [GitHub](https://jsmoriss.github.io/jsm-show-term-meta/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/jsm-show-term-meta/)

<h3>Changelog / Release Notes</h3>

**Version 1.2.0 (2020/05/08)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Maintenance release - minor code formatting changes.
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.4.

== Upgrade Notice ==

= 1.2.0 =

(2020/05/08) Maintenance release - minor code formatting changes.

