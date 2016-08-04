<?php
/*
 * Plugin Name: JSM's Show Term Meta
 * Plugin URI: http://wordpress.org/extend/plugins/jsm-show-term-meta/
 * Author: JS Morisset
 * Author URI: http://surniaulula.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Description: Show all term meta (aka custom fields) keys and their unserialized values in a metabox on term editing pages.
 * Requires At Least: 4.4
 * Tested Up To: 4.6
 * Version: 1.0.0-1
 */

class JSM_Show_Term_Meta {

	private static $instance;

	public $view_cap;
	public $tax_slug;

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new JSM_Show_Term_Meta;
			self::setup_actions();
		}
		return self::$instance;
	}

	private function __construct() {
	}

	private static function setup_actions() {
		if ( ! is_admin() )
			return;

		// make sure we have a taxonomy slug to hook the metabox action
		if ( ( self::$instance->tax_slug = self::get_request_value( 'taxonomy' ) ) === '' )
			return;

		add_action( self::$instance->tax_slug.'_edit_form', 
			array( self::$instance, 'show_meta_boxes' ), 1000, 1 );
	}

	public function show_meta_boxes( $term_obj ) {
		if ( ! isset( $term_obj->term_id ) )	// just in case
			return;

		$this->view_cap = apply_filters( 'jsm_stm_view_cap', 'manage_options' );

		if ( ! current_user_can( $this->view_cap, $term_obj->term_id ) || 
			! apply_filters( 'jsm_stm_taxonomy', '__return_true', $term_obj->taxonomy ) )
				return;

		add_meta_box( 'jsm-stm', 'Term Meta', 
			array( &$this, 'show_term_meta' ), 'jsm-stm-term', 'normal', 'low' );

		echo '<h3 id="jsm-stm-metaboxes">Show Term Meta</h3>';
		echo '<div id="poststuff">';
		do_meta_boxes( 'jsm-stm-term', 'normal', $term_obj );
		echo '</div><!-- .poststuff -->';
	}

	public function show_term_meta( $term_obj ) {
		if ( empty( $term_obj->term_id ) )
			return;

		$term_meta = apply_filters( 'jsm_stm_term_meta', 
			get_term_meta( $term_obj->term_id ), $term_obj );	// since wp v3.0

		$skip_keys = apply_filters( 'jsm_stm_skip_keys', 
			array(
			)
		);

		?>
		<style>
			div#jsm-stm.postbox table { 
				width:100%;
				max-width:100%;
				text-align:left;
			}
			div#jsm-stm.postbox table td { 
				padding:10px;
				vertical-align:top;
				border:1px dotted #ccc;
			}
			div#jsm-stm.postbox table td pre { 
				margin:0;
				padding:0;
				white-space:pre-wrap;
			}
			div#jsm-stm.postbox table .key-column { 
				width:20%;
			}
		</style>
		<table><thead><tr><th class="key-column">Key</th>
		<th class="value-column">Value</th></tr></thead><tbody>
		<?php

		ksort( $term_meta );
		foreach( $term_meta as $key => $arr ) {
			foreach ( $skip_keys as $dnsw )
				if ( strpos( $key, $dnsw ) === 0 )
					continue 2;

			foreach ( $arr as $num => $el )
				$arr[$num] = maybe_unserialize( $el );

			echo '<tr><td class="key-column">'.esc_html( $key ).'</td>'.
				'<td class="value-column"><pre>'.
					esc_html( var_export( $arr, true ) ).'</pre></td></tr>';
		}
		echo '</tbody></table>';
	}

	public static function get_request_value( $key, $method = 'ANY' ) {
		if ( $method === 'ANY' )
			$method = $_SERVER['REQUEST_METHOD'];
		switch( $method ) {
			case 'POST':
				if ( isset( $_POST[$key] ) )
					return sanitize_text_field( $_POST[$key] );
				break;
			case 'GET':
				if ( isset( $_GET[$key] ) )
					return sanitize_text_field( $_GET[$key] );
				break;
		}
		return '';
	}
}

function jsm_show_term_meta() {
	return JSM_Show_Term_Meta::instance();
}

add_action( 'plugins_loaded', 'jsm_show_term_meta' );

