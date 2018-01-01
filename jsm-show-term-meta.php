<?php
/**
 * Plugin Name: JSM's Show Term Meta
 * Text Domain: jsm-show-term-meta
 * Domain Path: /languages
 * Plugin URI: https://surniaulula.com/extend/plugins/jsm-show-term-meta/
 * Assets URI: https://jsmoriss.github.io/jsm-show-term-meta/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Description: Show all term meta (aka custom fields) keys and their unserialized values in a metabox on term editing pages.
 * Requires PHP: 5.4
 * Requires At Least: 4.4
 * Tested Up To: 4.9.1
 * Version: 1.0.4
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes / re-writes or incompatible API changes.
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2016-2018 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'JSM_Show_Term_Meta' ) ) {

	class JSM_Show_Term_Meta {

		private static $instance;
	
		public $view_cap;
		public $tax_slug;
	
		private function __construct() {
			if ( is_admin() ) {
				add_action( 'plugins_loaded', array( __CLASS__, 'load_textdomain' ) );
				add_action( 'admin_init', array( __CLASS__, 'check_wp_version' ) );

				// make sure we have a taxonomy slug to hook the metabox action
				if ( ( $this->tax_slug = $this->get_request_value( 'taxonomy' ) ) !== '' )	// uses sanitize_text_field
					add_action( $this->tax_slug . '_edit_form', array( &$this, 'show_meta_boxes' ), 1000, 1 );
			}
		}
	
		public static function &get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	
		public static function load_textdomain() {
			load_plugin_textdomain( 'jsm-show-term-meta', false, 'jsm-show-term-meta/languages/' );
		}

		public static function check_wp_version() {
			global $wp_version;
			$wp_min_version = 4.4;

			if ( version_compare( $wp_version, $wp_min_version, '<' ) ) {
				$plugin = plugin_basename( __FILE__ );
				if ( is_plugin_active( $plugin ) ) {
					if ( ! function_exists( 'deactivate_plugins' ) ) {
						require_once trailingslashit( ABSPATH ) . 'wp-admin/includes/plugin.php';
					}
					$plugin_data = get_plugin_data( __FILE__, false );	// $markup = false
					deactivate_plugins( $plugin, true );	// $silent = true
					wp_die( 
						'<p>' . sprintf( __( '%1$s requires %2$s version %3$s or higher and has been deactivated.',
							'jsm-show-term-meta' ), $plugin_data['Name'], 'WordPress', $wp_min_version ) . '</p>' . 
						'<p>' . sprintf( __( 'Please upgrade %1$s before trying to re-activate the %2$s plugin.',
							'jsm-show-term-meta' ), 'WordPress', $plugin_data['Name'] ) . '</p>'
					);
				}
			}
		}

		public function show_meta_boxes( $term_obj ) {
			if ( ! isset( $term_obj->term_id ) )	// just in case
				return;
	
			$this->view_cap = apply_filters( 'jsm_stm_view_cap', 'manage_options' );
	
			if ( ! current_user_can( $this->view_cap, $term_obj->term_id ) || 
				! apply_filters( 'jsm_stm_taxonomy', true, $term_obj->taxonomy ) )
					return;
	
			add_meta_box( 'jsm-stm', __( 'Term Meta', 'jsm-show-term-meta' ),
				array( &$this, 'show_term_meta' ), 'jsm-stm-term', 'normal', 'low' );
	
			echo '<h3 id="jsm-stm-metaboxes">' . __( 'Show Term Meta', 'jsm-show-term-meta' ) . '</h3>';
			echo '<div id="poststuff">';
			do_meta_boxes( 'jsm-stm-term', 'normal', $term_obj );
			echo '</div><!-- .poststuff -->';
		}
	
		public function show_term_meta( $term_obj ) {
			if ( empty( $term_obj->term_id ) )
				return;
	
			$term_meta = get_term_meta( $term_obj->term_id );	// since wp v4.4
			$term_meta_filtered = apply_filters( 'jsm_stm_term_meta', $term_meta, $term_obj );
			$skip_keys = apply_filters( 'jsm_stm_skip_keys', array() );
	
			?>
			<style>
				div#jsm-stm.postbox table { 
					width:100%;
					max-width:100%;
					text-align:left;
					table-layout:fixed;
				}
				div#jsm-stm.postbox table .key-column { 
					width:30%;
				}
				div#jsm-stm.postbox table tr.added-meta { 
					background-color:#eee;
				}
				div#jsm-stm.postbox table td { 
					padding:10px;
					vertical-align:top;
					border:1px dotted #ccc;
				}
				div#jsm-stm.postbox table td div {
					overflow-x:auto;
				}
				div#jsm-stm.postbox table td div pre { 
					margin:0;
					padding:0;
				}
			</style>
			<?php
	
			echo '<table><thead><tr><th class="key-column">' . __( 'Key', 'jsm-show-term-meta' ) . '</th>';
			echo '<th class="value-column">' . __( 'Value', 'jsm-show-term-meta' ) . '</th></tr></thead><tbody>';
	
			ksort( $term_meta_filtered );

			foreach( $term_meta_filtered as $meta_key => $arr ) {

				foreach ( $skip_keys as $preg_dns ) {
					if ( preg_match( $preg_dns, $meta_key ) ) {
						continue 2;
					}
				}
	
				foreach ( $arr as $num => $el ) {
					$arr[$num] = maybe_unserialize( $el );
				}

				$is_added = isset( $term_meta[$meta_key] ) ? false : true;

				echo $is_added ? '<tr class="added-meta">' : '<tr>';
				echo '<td class="key-column"><div class="key-cell"><pre>' . esc_html( $meta_key ) . '</pre></div></td>';
				echo '<td class="value-column"><div class="value-cell"><pre>' . esc_html( var_export( $arr, true ) ) . '</pre></div></td></tr>' . "\n";
			}

			echo '</tbody></table>';
		}
	
		public function get_request_value( $req_key, $method = 'ANY' ) {
			if ( $method === 'ANY' )
				$method = $_SERVER['REQUEST_METHOD'];
			switch( $method ) {
				case 'POST':
					if ( isset( $_POST[$req_key] ) )
						return sanitize_text_field( $_POST[$req_key] );
					break;
				case 'GET':
					if ( isset( $_GET[$req_key] ) )
						return sanitize_text_field( $_GET[$req_key] );
					break;
			}
			return '';
		}
	}

	JSM_Show_Term_Meta::get_instance();
}

