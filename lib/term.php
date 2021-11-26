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
		}

		public function add_meta_boxes( $term_obj ) {

			if ( ! isset( $term_obj->term_id ) ) {	// Just in case.

				return;
			}

			$capability = apply_filters( 'jsmstm_add_metabox_capability', 'manage_options', $term_obj );

			if ( ! current_user_can( $capability, $term_obj->term_id ) ) {

				return;

			} elseif ( ! apply_filters( 'jsmstm_add_metabox_taxonomy', true, $term_obj->taxonomy ) ) {

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

			$term_meta   = get_term_meta( $term_obj->term_id );
			$skip_keys   = array();
			$metabox_id  = 'jsmstm';
			$key_title   = __( 'Key', 'jsm-show-term-meta' );
			$value_title = __( 'Value', 'jsm-show-term-meta' );

			return SucomUtilMetabox::get_table_metadata( $term_meta, $skip_keys, $term_obj, $metabox_id, $key_title, $value_title );
		}
	}
}
