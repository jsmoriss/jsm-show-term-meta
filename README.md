<h1>JSM&#039;s Show Term Metadata</h1>

<table>
<tr><th align="right" valign="top" nowrap>Plugin Name</th><td>JSM&#039;s Show Term Metadata</td></tr>
<tr><th align="right" valign="top" nowrap>Summary</th><td>Show term metadata in a metabox when editing terms - a great tool for debugging issues with term metadata.</td></tr>
<tr><th align="right" valign="top" nowrap>Stable Version</th><td>3.0.2</td></tr>
<tr><th align="right" valign="top" nowrap>Requires PHP</th><td>7.2 or newer</td></tr>
<tr><th align="right" valign="top" nowrap>Requires WordPress</th><td>5.2 or newer</td></tr>
<tr><th align="right" valign="top" nowrap>Tested Up To WordPress</th><td>5.8.3</td></tr>
<tr><th align="right" valign="top" nowrap>Contributors</th><td>jsmoriss</td></tr>
<tr><th align="right" valign="top" nowrap>License</th><td><a href="https://www.gnu.org/licenses/gpl.txt">GPLv3</a></td></tr>
<tr><th align="right" valign="top" nowrap>Tags / Keywords</th><td>taxonomy, meta, term meta, categories, tags, delete, debug, inspector</td></tr>
</table>

<h2>Description</h2>

<p><strong>The JSM's Show Term Metadata plugin displays term (ie. categories, tags, and custom taxonomies) meta keys and their unserialized values in a metabox at the bottom of term editing pages.</strong></p>

<p>The current user must have the <a href="https://wordpress.org/support/article/roles-and-capabilities/#manage_options">WordPress <em>manage_options</em> capability</a> (allows access to administration options) to view the Term Metadata metabox, and the <em>manage_options</em> capability to delete individual meta keys.</p>

<p>The default <em>manage_options</em> capability can be modified using the 'jsmstm_show_metabox_capability' and 'jsmstm_delete_meta_capability' filters (see filters.txt in the plugin folder).</p>

<p>There are no plugin settings - simply install and activate the plugin.</p>

<h4>Shows Yoast SEO Term Meta</h4>

<p>Yoast SEO stores its term (ie. categories, tags, and custom taxonomies) metadata in the WordPress options table, not the term meta table. The JSM's Show Term Metadata plugin will read and display Yoast SEO's term metadata, but it cannot be deleted (as it does not reside in the WordPress term meta table).</p>

<h4>Related Plugins</h4>

<ul>
<li><a href="https://wordpress.org/plugins/jsm-show-comment-meta/">JSM's Show Comment Metadata</a></li>
<li><a href="https://wordpress.org/plugins/jsm-show-post-meta/">JSM's Show Post Metadata</a></li>
<li><a href="https://wordpress.org/plugins/jsm-show-user-meta/">JSM's Show User Metadata</a></li>
<li><a href="https://wordpress.org/plugins/jsm-show-registered-shortcodes/">JSM's Show Registered Shortcodes</a></li>
</ul>


<h2>Installation</h2>

<h4>Automated Install</h4>

<ol>
<li>Go to the wp-admin/ section of your website.</li>
<li>Select the <em>Plugins</em> menu item.</li>
<li>Select the <em>Add New</em> sub-menu item.</li>
<li>In the <em>Search</em> box, enter the plugin name.</li>
<li>Click the <em>Search Plugins</em> button.</li>
<li>Click the <em>Install Now</em> link for the plugin.</li>
<li>Click the <em>Activate Plugin</em> link.</li>
</ol>

<h4>Semi-Automated Install</h4>

<ol>
<li>Download the plugin ZIP file.</li>
<li>Go to the wp-admin/ section of your website.</li>
<li>Select the <em>Plugins</em> menu item.</li>
<li>Select the <em>Add New</em> sub-menu item.</li>
<li>Click on <em>Upload</em> link (just under the Install Plugins page title).</li>
<li>Click the <em>Browse...</em> button.</li>
<li>Navigate your local folders / directories and choose the ZIP file you downloaded previously.</li>
<li>Click on the <em>Install Now</em> button.</li>
<li>Click the <em>Activate Plugin</em> link.</li>
</ol>


