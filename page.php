<?php 

add_action('genesis_after_content_sidebar_wrap', 'yogg_vargangrepp_display_post_meta');
add_action('genesis_after_header', 'yogg_subst_header');
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


add_filter( 'genesis_attr_content', 'yogg_page_attributes_content' );
function yogg_page_attributes_content( $attributes ) {

	$attributes['id'] = 'formaga';
	return $attributes;
}


genesis();