=== JSM's Show Term Metadata ===
Plugin Name: JSM's Show Term Metadata
Plugin Slug: jsm-show-term-meta
Text Domain: jsm-show-term-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://jsmoriss.github.io/jsm-show-term-meta/assets/
Tags: taxonomy, meta, term meta, categories, tags, delete, debug, inspector
Contributors: jsmoriss
Requires PHP: 7.2
Requires At Least: 5.2
Tested Up To: 5.8.2
Stable Tag: 3.0.2

Show term metadata in a metabox when editing terms - a great tool for debugging issues with term metadata.

== Description ==

**The JSM's Show Term Metadata plugin displays term (ie. categories, tags, and custom taxonomies) meta keys and their unserialized values in a metabox at the bottom of term editing pages.**

The current user must have the [WordPress *manage_options* capability](https://wordpress.org/support/article/roles-and-capabilities/#manage_options) (allows access to administration options) to view the Term Metadata metabox, and the *manage_options* capability to delete individual meta keys.

The default *manage_options* capability can be modified using the 'jsmstm_show_metabox_capability' and 'jsmstm_delete_meta_capability' filters (see filters.txt in the plugin folder).

There are no plugin settings - simply install and activate the plugin.

= Shows Yoast SEO Term Meta =

Yoast SEO stores its term (ie. categories, tags, and custom taxonomies) metadata in the WordPress options table, not the term meta table. The JSM's Show Term Metadata plugin will read and display Yoast SEO's term metadata, but it cannot be deleted (as it does not reside in the WordPress term meta table).

= Related Plugins =

* [JSM's Show Comment Metadata](https://wordpress.org/plugins/jsm-show-comment-meta/)
* [JSM's Show Post Metadata](https://wordpress.org/plugins/jsm-show-post-meta/)
* [JSM's Show User Metadata](https://wordpress.org/plugins/jsm-show-user-meta/)
* [JSM's Show Registered Shortcodes](https://wordpress.org/plugins/jsm-show-registered-shortcodes/)

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

**Version 3.0.2 (2021/12/10)**

* **New Features**
	* None.
* **Improvements**
	* Added a `trim()` to the returned CSS id after successful delete, in case the ajax return is corrupted with a space or newline.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

**Version 3.0.1 (2021/12/09)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* Fixed a missing table column if there is no metadata and allowed to delete meta is true.
* **Developer Notes**
	* Updated `SucomUtilMetabox::get_table_metadata()` to add a missing empty delete column if `$row_count` is 0.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

**Version 3.0.0 (2021/11/30)**

* **New Features**
	* Added the ability to delete individual term meta.
* **Improvements**
	* Added a `JsmStmCompat` class with a filter to add Yoast SEO taxonomy meta to the Term Metadata metabox.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

**Version 2.0.0 (2021/11/26)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Complete rewrite of the plugin - all class, method, and filter names have changed.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.

== Upgrade Notice ==

= 3.0.2 =

(2021/12/10) Added a `trim()` to the returned CSS id after successful delete, in case the ajax return is corrupted with a space or newline.

= 3.0.1 =

(2021/12/09) Fixed a missing table column if there is no metadata and allowed to delete meta is true.

= 3.0.0 =

(2021/11/30) Added the ability to delete individual term meta. Added a `JsmStmCompat` class with a filter to add Yoast SEO taxonomy meta to the Term Metadata metabox.

= 2.0.0 =

(2021/11/26) Complete rewrite of the plugin - all class, method, and filter names have changed.

