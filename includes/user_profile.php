<?php

add_action('show_user_profile', 'yogg_user_avatar');
add_action('edit_user_profile', 'yogg_user_avatar');
function yogg_user_avatar($user) {

	$avatar = get_the_author_meta( 'author_profile_avatar', $user->ID );

	$avatar = ($avatar) ? $avatar : null;	

	echo '<div class="vargangrepp-metabox">';
	echo '<h3>Author Avatar</h3>';
	echo '<p><span class="description">Used for yoggernauts page.</span></p>';

	echo '<div class="vargangrepp-preview" style="width:150px;height:150px; margin:1em auto;border:1px dashed #cccccc;">';

		if($avatar) :
			echo wp_get_attachment_image( $avatar, 'thumbnail' );
		endif;

	echo '</div>';

  echo '<input style="width:150px;margin:0 auto;display:block;" type="button" class="yogg-vargangrepp-button" class="button" value="Choose your monster." />';
  echo '<input type="hidden" class="vargangrepp-id" name="yogg_vargangrepp_id" value="' . esc_attr( $avatar ) . '" />';	
	echo '</div>';
}


add_action( 'personal_options_update', 'yogg_save_user_avatar' );
add_action( 'edit_user_profile_update', 'yogg_save_user_avatar' );
function yogg_save_user_avatar( $user_id ) {
    
	if ( !current_user_can( 'edit_user', $user_id ) )
	  return FALSE;
	        
	update_user_meta( $user_id, 'author_profile_avatar', $_POST['yogg_vargangrepp_id'] );
}