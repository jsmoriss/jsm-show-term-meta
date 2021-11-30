<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2012-2021 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! defined( 'JSMSTM_PLUGINDIR' ) ) {

	die( 'Do. Or do not. There is no try.' );
}

if ( ! class_exists( 'JsmStmTerm' ) ) {

	class JsmStmTerm {

		public function __construct() {

			/**
			 * Make sure we have a taxonomy slug to hook the metabox action.
			 */
			$tax_slug = SucomUtil::get_request_value( 'taxonomy' );	// Uses sanitize_text_field.

			if ( ! empty( $tax_slug ) ) {

				add_action( $tax_slug . '_edit_form', array( $this, 'add_meta_boxes' ), 1000, 1 );
			}

			add_action( 'wp_ajax_delete_jsmstm_meta', array( $this, 'ajax_delete_meta' ) );
		}

		public function add_meta_boxes( $term_obj ) {

			if ( ! isset( $term_obj->term_id ) ) {	// Just in case.

				return;
			}

			$show_meta_cap = apply_filters( 'jsmstm_show_metabox_capability', 'manage_options', $term_obj );
			$can_show_meta = current_user_can( $show_meta_cap, $term_obj->ID );

			if ( ! $can_show_meta ) {

				return;

			} elseif ( ! apply_filters( 'jsmstm_show_metabox_taxonomy', true, $term_obj->taxonomy ) ) {

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

			add_meta_box( $metabox_id, $metabox_title, array( $this, 'show_metabox' ), $metabox_screen, $metabox_context, $metabox_prio, $callback_args );

			echo '<h3 id="jsmstm-metaboxes">' . __( 'Show Term Metadata', 'jsm-show-term-meta' ) . '</h3>';
			echo '<div id="poststuff">';

			do_meta_boxes( $metabox_screen, 'normal', $term_obj );

			echo '</div><!-- .poststuff -->';
		}

		public function show_metabox( $term_obj ) {

			echo $this->get_metabox( $term_obj );
		}

		public function get_metabox( $term_obj ) {

			if ( empty( $term_obj->term_id ) ) {

				return;
			}

			$cf          = JsmStmConfig::get_config();
			$term_meta   = get_term_meta( $term_obj->term_id );
			$skip_keys   = array();
			$metabox_id  = 'jsmstm';
			$admin_l10n  = $cf[ 'plugin' ][ 'jsmstm' ][ 'admin_l10n' ];

			$titles = array(
				'key'   => __( 'Key', 'jsm-show-term-meta' ),
				'value' => __( 'Value', 'jsm-show-term-meta' ),
			);

			return SucomUtilMetabox::get_table_metadata( $term_meta, $skip_keys, $term_obj, $term_obj->term_id, $metabox_id, $admin_l10n, $titles );
		}

		public function ajax_delete_meta() {

			$doing_ajax = SucomUtilWP::doing_ajax();

			if ( ! $doing_ajax ) {	// Just in case.

				return;
			}

			check_ajax_referer( JSMSTM_NONCE_NAME, '_ajax_nonce', $die = true );

			if ( empty( $_POST[ 'obj_id' ] ) || empty( $_POST[ 'meta_key' ] ) ) {

				die( -1 );
			}
	
			$metabox_id   = 'jsmstm';
			$obj_id       = sanitize_key( $_POST[ 'obj_id' ] );
			$meta_key     = sanitize_key( $_POST[ 'meta_key' ] );
			$term_obj     = get_term( $obj_id );
			$del_meta_cap = apply_filters( 'jsmstm_delete_meta_capability', 'manage_options', $term_obj );
			$can_del_meta = current_user_can( $del_meta_cap, $obj_id );
			$hide_row_id  = $metabox_id . '-' . $obj_id . '-' . $meta_key;

			if ( ! $can_del_meta ) {

				die( -1 );
			}

			if ( delete_term_meta( $obj_id, $meta_key ) ) {

				die( $hide_row_id );
			}

			die( false );	// Show delete failed message.
		}
	}
}
