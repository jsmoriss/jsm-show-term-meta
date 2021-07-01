<h1>JSM&#039;s Show Term Metadata</h1>

<table>
<tr><th align="right" valign="top" nowrap>Plugin Name</th><td>JSM&#039;s Show Term Metadata</td></tr>
<tr><th align="right" valign="top" nowrap>Summary</th><td>Show all term (categories, tags) meta (aka custom fields) in a metabox on term editing pages -- a great tool for debugging issues with term meta.</td></tr>
<tr><th align="right" valign="top" nowrap>Stable Version</th><td>1.3.0</td></tr>
<tr><th align="right" valign="top" nowrap>Requires PHP</th><td>7.0 or newer</td></tr>
<tr><th align="right" valign="top" nowrap>Requires WordPress</th><td>5.0 or newer</td></tr>
<tr><th align="right" valign="top" nowrap>Tested Up To WordPress</th><td>5.7.2</td></tr>
<tr><th align="right" valign="top" nowrap>Contributors</th><td>jsmoriss</td></tr>
<tr><th align="right" valign="top" nowrap>License</th><td><a href="https://www.gnu.org/licenses/gpl.txt">GPLv3</a></td></tr>
<tr><th align="right" valign="top" nowrap>Tags / Keywords</th><td>meta, term meta, inspector, custom fields, debug, tools</td></tr>
</table>

<h2>Description</h2>

<p><strong>Wondering about the term meta your theme and/or plugins might be creating?</strong></p>

<p><strong>Want to find the name of a specific term meta key?</strong></p>

<p><strong>Need some help debugging your term meta (aka custom fields)?</strong></p>

<p>The JSM's Show Term Metadata plugin displays all term (categories, tags) meta keys and their unserialized values in a metabox at the bottom of term editing pages.</p>

<p>There are no plugin settings - simply <em>install</em> and <em>activate</em> the plugin.</p>

<h4>Related Plugins</h4>

<ul>
<li><a href="https://wordpress.org/plugins/jsm-show-comment-meta/">JSM's Show Comment Metadata</a></li>
<li><a href="https://wordpress.org/plugins/jsm-show-post-meta/">JSM's Show Post Metadata</a></li>
<li><a href="https://wordpress.org/plugins/jsm-show-user-meta/">JSM's Show User Metadata</a></li>
</ul>

<h4>Need a Boost to your Social and Search Ranking?</h4>

<p>Check out <a href="https://wordpress.org/plugins/wpsso/">the WPSSO Core plugin</a> to rank higher and improve click-through-rates by presenting your content at its best on social sites and in search results - no matter how URLs are shared, re-shared, messaged, posted, embedded, or crawled.</p>


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


<h2>Frequently Asked Questions</h2>

<h3 class="top">Frequently Asked Questions</h3>

<ul>
<li>None.</li>
</ul>

<h3>Notes and Documentation</h3>

<p><strong>Developer Filters</strong></p>

<p>An example to add Yoast SEO term meta to the "Term Metadata" metabox.</p>

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


