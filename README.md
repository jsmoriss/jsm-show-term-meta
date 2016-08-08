<h1>JSM&#039;s Show Term Meta on Term Editing Pages</h1>

<table>
<tr><th align="right" valign="top" nowrap>Plugin Name</th><td>JSM&#039;s Show Term Meta</td></tr>
<tr><th align="right" valign="top" nowrap>Summary</th><td>Show all term meta (aka custom fields) keys and their unserialized values in a metabox on term editing pages.</td></tr>
<tr><th align="right" valign="top" nowrap>Stable Version</th><td>1.0.0-1</td></tr>
<tr><th align="right" valign="top" nowrap>Requires At Least</th><td>WordPress 4.4</td></tr>
<tr><th align="right" valign="top" nowrap>Tested Up To</th><td>WordPress 4.6</td></tr>
<tr><th align="right" valign="top" nowrap>Contributors</th><td>jsmoriss</td></tr>
<tr><th align="right" valign="top" nowrap>License</th><td><a href="http://www.gnu.org/licenses/gpl.txt">GPLv3</a></td></tr>
<tr><th align="right" valign="top" nowrap>Tags / Keywords</th><td>meta, term meta, custom fields, debug, tools</td></tr>
</table>

<h2>Description</h2>

<p><strong>Wondering about the term meta your theme and/or plugins might be creating?</strong></p>

<p><strong>Want to find the name of a specific term meta key?</strong></p>

<p><strong>Need some help debugging your term meta?</strong></p>

<blockquote>
<p>The JSM's Show Term Meta plugin displays all term meta (aka custom fields) keys and their unserialized values in a metabox at the bottom of term editing pages (categories, tags, etc.).</p>
</blockquote>

<p>Term meta has been available since WordPress v4.4. Older plugins that supported "<em>term meta</em>" before WordPress v4.4 may not use the current WordPress term meta functions &mdash; preferring to use their own custom "<em>term meta</em>" solutions instead. This custom "<em>term meta</em>", which is not stored in the WordPress term meta table, will not appear in the Term Meta list. You can contact the author of those older plugins to request an update, which uses the current WordPress term meta functions, or hook the 'jsm_stm_term_meta' filter to merge the custom "<em>term meta</em>". As an example, the <a href="https://wordpress.org/plugins/wordpress-seo/">Yoast SEO</a> plugin still does not use term meta functions, while <a href="https://wordpress.org/plugins/woocommerce/">WooCommerce</a> and the <a href="https://wordpress.org/plugins/wpsso/">WordPress Social Sharing Optimization</a> plugins do.</p>

<h4>Plugin Settings</h4>

<p>There are no plugin settings - simply activate to add a metabox to all term editing pages.</p>

<h4>Developer Filters</h4>

<p><em>'jsm_stm_view_cap' ( 'manage_options' )</em> &mdash; The current user must have these capabilities to view the "Term Meta" metabox (default: 'manage_options' ).</p></p>

<p><em>'jsm_stm_taxonomy' ( true, $screen_base )</em> &mdash; Add the "Term Meta" metabox to the term editing page of this taxonomy (example: 'category').</p></p>

<p><em>'jsm_stm_term_meta' ( $term_meta, $term_obj )</em> &mdash; The term meta array (unserialized) retrieved for display in the metabox.</p></p>

<p><em>'jsm_stm_skip_keys' ( $array )</em> &mdash; An array of key name prefixes to ignore (default: empty array).</p></p>

<h4>Related Plugins</h4>

<ul>
<li><a href="https://wordpress.org/plugins/jsm-show-post-meta/">JSM's Show Post Meta</a></li>
<li><a href="https://wordpress.org/plugins/jsm-show-user-meta/">JSM's Show User Meta</a></li>
</ul>


<h2>Installation</h2>

<h4>Automated Install</h4>

<ol>
<li>Go to the wp-admin/ section of your website</li>
<li>Select the <em>Plugins</em> menu item</li>
<li>Select the <em>Add New</em> sub-menu item</li>
<li>In the <em>Search</em> box, enter the plugin name</li>
<li>Click the <em>Search Plugins</em> button</li>
<li>Click the <em>Install Now</em> link for the plugin</li>
<li>Click the <em>Activate Plugin</em> link</li>
</ol>

<h4>Semi-Automated Install</h4>

<ol>
<li>Download the plugin archive file</li>
<li>Go to the wp-admin/ section of your website</li>
<li>Select the <em>Plugins</em> menu item</li>
<li>Select the <em>Add New</em> sub-menu item</li>
<li>Click on <em>Upload</em> link (just under the Install Plugins page title)</li>
<li>Click the <em>Browse...</em> button</li>
<li>Navigate your local folders / directories and choose the zip file you downloaded previously</li>
<li>Click on the <em>Install Now</em> button</li>
<li>Click the <em>Activate Plugin</em> link</li>
</ol>


<h2>Frequently Asked Questions</h2>

<h4>Frequently Asked Questions</h4>

<ul>
<li>None</li>
</ul>


<h2>Other Notes</h2>

<h3>Other Notes</h3>
<h4>Additional Documentation</h4>

<ul>
<li>None</li>
</ul>

