=== JSM's Show Term Meta on Term Editing Pages ===
Plugin Name: JSM's Show Term Meta
Plugin Slug: jsm-show-term-meta
Text Domain: jsm-show-term-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://jsmoriss.github.io/jsm-show-term-meta/assets/
Tags: meta, term meta, custom fields, debug, tools
Contributors: jsmoriss
Requires At Least: 4.4
Tested Up To: 4.7.3
Stable Tag: 1.0.3-1

Show all term meta (aka custom fields) keys and their unserialized values in a metabox on term editing pages.

== Description ==

<strong>Wondering about the term meta your theme and/or plugins might be creating?</strong>

<strong>Want to find the name of a specific term meta key?</strong>

<strong>Need some help debugging your term meta?</strong>

<p>The JSM's Show Term Meta plugin displays all term meta (aka custom fields) keys and their unserialized values in a metabox at the bottom of term editing pages (categories, tags, etc.).</p>

Term meta has been available since WordPress v4.4. Older plugins that supported "*term meta*" before WordPress v4.4 may not use the current WordPress term meta functions, preferring to use their own custom "*term meta*" solutions instead. This custom "*term meta*", which is not stored in the WordPress term meta table, will not appear in the Term Meta list. You can contact the author of those older plugins to request an update, which uses the current WordPress term meta functions, or hook the 'jsm_stm_term_meta' filter to merge the custom "*term meta*". As an example, the [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/) plugin still does not use the new term meta functions, while the [WooCommerce](https://wordpress.org/plugins/woocommerce/) and [WordPress Social Sharing Optimization (WPSSO)](https://wordpress.org/plugins/wpsso/) plugins do.

<blockquote>
<p>There are no plugin settings &mdash; simply install and activate the plugin.</p>
</blockquote>

= Developers =

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

1. Download the plugin archive file.
1. Go to the wp-admin/ section of your website.
1. Select the *Plugins* menu item.
1. Select the *Add New* sub-menu item.
1. Click on *Upload* link (just under the Install Plugins page title).
1. Click the *Browse...* button.
1. Navigate your local folders / directories and choose the zip file you downloaded previously.
1. Click on the *Install Now* button.
1. Click the *Activate Plugin* link.

== Frequently Asked Questions ==

= Frequently Asked Questions =

* None

== Other Notes ==

= Additional Documentation =

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

= Repositories =

* [GitHub](https://jsmoriss.github.io/jsm-show-term-meta/)
* [WordPress.org](https://wordpress.org/plugins/jsm-show-term-meta/developers/)

= Version Numbering =

Version components: `{major}.{minor}.{bugfix}-{stage}{level}`

* {major} = Major code changes / re-writes or significant feature changes.
* {minor} = New features / options were added or improved.
* {bugfix} = Bugfixes or minor improvements.
* {stage}{level} = dev &lt; a (alpha) &lt; b (beta) &lt; rc (release candidate) &lt; # (production).

Note that the production stage level can be incremented on occasion for simple text revisions and/or translation updates. See [PHP's version_compare()](http://php.net/manual/en/function.version-compare.php) documentation for additional information on "PHP-standardized" version numbering.

= Changelog / Release Notes =

**Version 1.0.3-1 (2017/03/25)**

* *New Features*
	* None
* *Improvements*
	* Minor updates to textdomain translation strings.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.0.2-1 (2016/12/28)**

* *New Features*
	* None
* *Improvements*
	* Highlighted new term meta rows added by the 'jsm_stm_term_meta' filters.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.0.1-1 (2016/12/23)**

* *New Features*
	* None
* *Improvements*
	* Added French translation of labels and notices.
	* Updated CSS to scroll overflow of meta values.
* *Bugfixes*
	* None
* *Developer Notes*
	* Maintenance release - minor refactoring of code.

**Version 1.0.0-1 (2016/08/04)**

* *New Features*
	* Initial release.
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* None

== Upgrade Notice ==

= 1.0.3-1 =

(2017/03/25) Minor updates to textdomain translation strings.

= 1.0.2-1 =

(2016/12/28) Highlighted new term meta rows added by the 'jsm_sum_term_meta' filters.

= 1.0.1-1 =

(2016/12/23) Maintenance release - minor refactoring of code. Added French translation of labels and notices. Updated CSS to scroll overflow of meta values.

= 1.0.0-1 =

(2016/08/04) Initial release.

