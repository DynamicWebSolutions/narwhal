<?php

add_action( 'add_meta_boxes', 'yogg_subst_meta_box' );
function yogg_subst_meta_box() {
  add_meta_box(
	  'subst',
	  'Subst',
	  'yogg_subst_do_meta_box',
	  'page',
	  'normal',
	  'default'
  );
}


add_action( 'add_meta_boxes', 'yogg_vargangrepp_meta_box' );
function yogg_vargangrepp_meta_box() {

	$screens = array('post', 'page', 'yogg_work');

	foreach($screens as $screen):
	  add_meta_box(
		  'vargangrepp',
		  'Vargangrepp',
		  'yogg_vargangrepp_do_meta_box',
		  $screen,
		  'normal',
		  'default'
	  );
	endforeach;

}


function yogg_subst_do_meta_box( $post ) {
	wp_nonce_field( 'yogg_subst_meta_box', 'yogg_subst_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_yogg_subst', true );

	echo '<p><label for="yogg_subst"><b>This noun will be overlayed atop the featured image.</b></label></p>';
	echo '<p><input class="medium-text" type="text" id="yogg_subst" name="yogg_subst" value="' . esc_attr( $value ) . '" /></p>';	
}


function yogg_vargangrepp_do_meta_box( $post ) {

	$value  = get_post_meta( $post->ID, '_yogg_vargangrepp', true );
	$fields = ($value) ? $value : array('id' => null, 'description' => null);
	$img    = ($fields['id']) ? wp_get_attachment_image( $fields['id'], 'thumbnail' ) : null;

	wp_nonce_field( 'yogg_vargangrepp_meta_box', 'yogg_vargangrepp_meta_box_nonce' );

	echo sprintf(
		'<div id="vargangrepp-metabox-%s" class="vargangrepp-metabox">
			<div class="vargangrepp-preview" style="width:150px;height:150px; margin:1em auto;border:1px dashed #cccccc;">
				%s
			</div>
			<input style="width:150px;margin:0 auto;display:block;" type="button" class="yogg-vargangrepp-button button" value="Choose your monster" />
			<input style="width:150px;margin:10px auto; auto;display:block;" type="button" class="yogg-vargangrepp-button-remove button" value="Remove monster" />

			<input type="hidden" name="yogg_vargangrepp_id" class="vargangrepp-id" value="%s" />		
			<p><label for="yogg_vargangrepp_text"><b>This message will be dispalyed underneath the monster.</b></label></p>			
			<p><input class="large-text" type="text" id="yogg_subst" name="yogg_vargangrepp_description" value="%s" /></p>	
		</div>',
		$post->ID,
		$img,
		esc_attr( $fields['id'] ),
		esc_attr( $fields['description'] )
	);
}


add_action( 'save_post', 'yogg_vargangrepp_save_meta_box' );
function yogg_vargangrepp_save_meta_box($post_id) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['yogg_vargangrepp_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['yogg_vargangrepp_meta_box_nonce'], 'yogg_vargangrepp_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['yogg_vargangrepp_id']) && ! isset( $_POST['yogg_vargangrepp_description']) ) {
		return;
	}

	// Sanitize user input.
	$yogg_vargangrepp = array(
		'id' => sanitize_text_field( $_POST['yogg_vargangrepp_id']),
		'description' => sanitize_text_field( $_POST['yogg_vargangrepp_description']) 
	);

	// Update the meta field in the database.
	update_post_meta( $post_id, '_yogg_vargangrepp', $yogg_vargangrepp );
}


add_action( 'save_post', 'yogg_subst_save_meta_box' );
function yogg_subst_save_meta_box($post_id) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['yogg_subst_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['yogg_subst_meta_box_nonce'], 'yogg_subst_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['yogg_subst'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['yogg_subst'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_yogg_subst', $my_data );
}