=== JSM's Show Term Meta in a Metabox on Term Editing Pages (Great Plugin for Developers) ===
Plugin Name: JSM's Show Term Meta
Plugin Slug: jsm-show-term-meta
Text Domain: jsm-show-term-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://jsmoriss.github.io/jsm-show-term-meta/assets/
Tags: meta, term meta, inspector, custom fields, debug, tools
Contributors: jsmoriss
Requires PHP: 5.4
Requires At Least: 4.4
Tested Up To: 4.9.1
Stable Tag: 1.0.4

Show all term meta (aka custom fields) keys and their unserialized values in a metabox on term editing pages.

== Description ==

<strong>Wondering about the term meta your theme and/or plugins might be creating?</strong>

<strong>Want to find the name of a specific term meta key?</strong>

<strong>Need some help debugging your term meta?</strong>

<p>The JSM's Show Term Meta plugin displays all term meta (aka custom fields) keys and their unserialized values in a metabox at the bottom of term editing pages (categories, tags, etc.).</p>

Term meta has been available since WordPress v4.4. Older plugins that supported "*term meta*" before WordPress v4.4 may not use the current WordPress term meta functions, preferring to use their own custom "*term meta*" solutions instead. This custom "*term meta*", which is not stored in the WordPress term meta table, will not appear in the Term Meta list. You can contact the author of those older plugins to request an update, which uses the current WordPress term meta functions, or hook the 'jsm_stm_term_meta' filter to merge the custom "*term meta*". As an example, the [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/) plugin still does not use the new term meta functions, while the [WooCommerce](https://wordpress.org/plugins/woocommerce/) and [WPSSO](https://wordpress.org/plugins/wpsso/) plugins do.

<blockquote>
<p>There are no plugin settings &mdash; simply install and activate the plugin.</p>
</blockquote>

= Power-users / Developers =

See the plugin [Other Notes](https://wordpress.org/plugins/jsm-show-term-meta/other_notes/) page for information on available filters.

= Related Plugins =

* [JSM's Show Post Meta](https://wordpress.org/plugins/jsm-show-post-meta/)
* [JSM's Show User Meta](https://wordpress.org/plugins/jsm-show-user-meta/)

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

<h3>Frequently Asked Questions</h3>

* None

== Other Notes ==

<h3>Additional Documentation</h3>

**Developer Filters**

*'jsm_stm_view_cap' ( 'manage_options' )* &mdash; The current user must have these capabilities to view the "Term Meta" metabox (default: 'manage_options' ).</p>

*'jsm_stm_taxonomy' ( true, $screen_base )* &mdash; Add the "Term Meta" metabox to the term editing page of this taxonomy (example: 'category').</p>

*'jsm_stm_term_meta' ( $term_meta, $term_obj )* &mdash; The term meta array (unserialized) retrieved for display in the metabox.</p>

*'jsm_stm_skip_keys' ( $array )* &mdash; An array of key name regular expressions to ignore (default: empty array).</p>

An example to add Yoast SEO term meta to the "Term Meta" metabox.

`
add_filter( 'jsm_stm_term_meta', 'add_yoast_seo_term_meta', 10, 2 );

function add_yoast_seo_term_meta( $term_meta, $term_obj ) {

	$tax_opts = get_option( 'wpseo_taxonomy_meta' );

	if ( ! isset( $term_obj->taxonomy ) ||
		! isset( $tax_opts[$term_obj->taxonomy][$term_obj->term_id] ) )
			return $term_meta;

	$term_meta['wpseo_taxonomy_meta'][] = $tax_opts[$term_obj->taxonomy][$term_obj->term_id];
	
	return $term_meta;
}
`

== Screenshots ==

01. The Term Meta metabox added to admin term editing pages.

== Changelog ==

<h3>Repositories</h3>

* [GitHub](https://jsmoriss.github.io/jsm-show-term-meta/)
* [WordPress.org](https://wordpress.org/plugins/jsm-show-term-meta/developers/)

<h3>Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Changelog / Release Notes</h3>

**Version 1.0.4 (2017/04/08)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Maintenance release - update to version numbering scheme.
	* Dropped the package number from the production version string.

== Upgrade Notice ==

= 1.0.4 =

(2017/04/08) Maintenance release - update to version numbering scheme.

