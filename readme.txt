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
Requires PHP: 7.2
Requires At Least: 5.2
Tested Up To: 5.8.2
Stable Tag: 1.3.0

Show all term (categories, tags) meta (aka custom fields) in a metabox on term editing pages &mdash; a great tool for debugging issues with term meta.

== Description ==

**Wondering about the term meta your theme and/or plugins might be creating?**

**Want to find the name of a specific term meta key?**

**Need some help debugging your term meta (aka custom fields)?**

The JSM's Show Term Metadata plugin displays all term (categories, tags) meta keys and their unserialized values in a metabox at the bottom of term editing pages.

There are no plugin settings - simply *install* and *activate* the plugin.

= Related Plugins =

* [JSM's Show Comment Metadata](https://wordpress.org/plugins/jsm-show-comment-meta/)
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

01. The "Term Metadata" metabox added to admin term editing pages.

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

**Version 1.3.0 (2020/10/07)**

Maintenance release.

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

== Upgrade Notice ==

= 1.3.0 =

(2020/10/07) Maintenance release.

