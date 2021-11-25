<?php
/**
 * Plugin Name: JSM's Show Term Metadata
 * Text Domain: jsm-show-term-meta
 * Domain Path: /languages
 * Plugin URI: https://surniaulula.com/extend/plugins/jsm-show-term-meta/
 * Assets URI: https://jsmoriss.github.io/jsm-show-term-meta/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Description: Show all term meta (aka custom fields) keys and their unserialized values in a metabox on term editing pages.
 * Requires PHP: 7.2
 * Requires At Least: 5.2
 * Tested Up To: 5.8.2
 * Version: 2.0.0-dev.2
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes / re-writes or incompatible API changes.
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2016-2021 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'JsmShowTermMeta' ) ) {

	class JsmShowTermMeta {

		private static $instance = null;	// JsmShowTermMeta class object.

		private function __construct() {

			if ( is_admin() ) {

				add_action( 'plugins_loaded', array( $this, 'init_textdomain' ) );

				/**
				 * Make sure we have a taxonomy slug to hook the metabox action.
				 */
				if ( '' !== ( $tax_slug = $this->get_request_value( 'taxonomy' ) ) ) {	// Uses sanitize_text_field.

					add_action( $tax_slug . '_edit_form', array( $this, 'show_meta_boxes' ), 1000, 1 );
				}
			}
		}

		public static function &get_instance() {

			if ( null === self::$instance ) {

				self::$instance = new self;
			}

			return self::$instance;
		}

		public function init_textdomain() {

			load_plugin_textdomain( 'jsm-show-term-meta', false, 'jsm-show-term-meta/languages/' );
		}

		public function show_meta_boxes( $term_obj ) {

			if ( ! isset( $term_obj->term_id ) ) {	// Just in case.

				return;
			}

			$view_cap = apply_filters( 'jsm_stm_view_cap', 'manage_options' );

			if ( ! current_user_can( $view_cap, $term_obj->term_id ) ) {
			
				return;

			} elseif ( ! apply_filters( 'jsm_stm_taxonomy', true, $term_obj->taxonomy ) ) {

				return;
			}

			$metabox_id      = 'jsmstm';
			$metabox_title   = __( 'Term Metadata', 'jsm-show-term-meta' );
			$metabox_screen  = 'jsm-show-term-meta';
			$metabox_context = 'normal';
			$metabox_prio    = 'low';
			$callback_args   = array(	// Second argument passed to the callback function / method.
				'__block_editor_compatible_meta_box' => true,
			);

			add_meta_box( $metabox_id, $metabox_title, array( $this, 'show_term_metadata' ), $metabox_screen, $metabox_context, $metabox_prio, $callback_args );

			echo '<h3 id="jsmstm-metaboxes">' . __( 'Show Term Metadata', 'jsm-show-term-meta' ) . '</h3>';

			echo '<div id="poststuff">';

			do_meta_boxes( 'jsm-show-term-meta', 'normal', $term_obj );

			echo '</div><!-- .poststuff -->';
		}

		public function show_term_metadata( $term_obj ) {

			if ( empty( $term_obj->term_id ) ) {

				return;
			}

			$term_meta            = get_term_meta( $term_obj->term_id );	// Since WP v4.4.
			$term_meta_filtered   = apply_filters( 'jsm_stm_term_meta', $term_meta, $term_obj );
			$skip_keys_preg_match = apply_filters( 'jsm_stm_skip_keys', array() );

			?>
			<style type="text/css">
				div#jsmstm.postbox table {
					width:100%;
					max-width:100%;
					text-align:left;
					table-layout:fixed;
				}
				div#jsmstm.postbox table .key-column {
					width:30%;
				}
				div#jsmstm.postbox table tr.added-meta {
					background-color:#eee;
				}
				div#jsmstm.postbox table td {
					padding:10px;
					vertical-align:top;
					border:1px dotted #ccc;
				}
				div#jsmstm.postbox table td div {
					overflow-x:auto;
				}
				div#jsmstm.postbox table td div pre {
					margin:0;
					padding:0;
				}
			</style>
			<?php

			echo '<table><thead><tr><th class="key-column">' . __( 'Key', 'jsm-show-term-meta' ) . '</th>';

			echo '<th class="value-column">' . __( 'Value', 'jsm-show-term-meta' ) . '</th></tr></thead><tbody>';

			ksort( $term_meta_filtered );

			foreach( $term_meta_filtered as $meta_key => $arr ) {

				foreach ( $skip_keys_preg_match as $preg_expr ) {

					if ( preg_match( $preg_expr, $meta_key ) ) {

						continue 2;
					}
				}

				if ( is_array( $arr ) ) {	// Just in case.

					foreach ( $arr as $num => $el ) {

						$arr[ $num ] = maybe_unserialize( $el );
					}
				}

				$is_added = isset( $term_meta[ $meta_key ] ) ? false : true;

				echo $is_added ? '<tr class="added-meta">' : '<tr>';

				echo '<td class="key-column"><div class="key-cell"><pre>' . esc_html( $meta_key ) . '</pre></div></td>';

				echo '<td class="value-column"><div class="value-cell"><pre>' . esc_html( var_export( $arr, true ) ) . '</pre></div></td></tr>' . "\n";
			}

			echo '</tbody></table>';
		}

		public function get_request_value( $req_key, $method = 'ANY' ) {

			if ( 'ANY' === $method ) {

				$method = $_SERVER[ 'REQUEST_METHOD' ];
			}

			switch( $method ) {

				case 'POST':

					if ( isset( $_POST[ $req_key ] ) ) {

						return sanitize_text_field( $_POST[ $req_key ] );
					}

					break;

				case 'GET':

					if ( isset( $_GET[ $req_key ] ) ) {

						return sanitize_text_field( $_GET[ $req_key ] );
					}

					break;
			}

			return '';
		}
	}

	JsmShowTermMeta::get_instance();
}
