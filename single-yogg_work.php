<?php

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );



add_action( 'genesis_after_content_sidebar_wrap', 'yogg_vargangrepp_display_post_meta');
add_action( 'genesis_entry_footer', 'genesis_prev_next_post_nav' );
add_action( 'genesis_entry_footer', 'yogg_entry_footer_markup_open', 5);
add_action( 'genesis_entry_footer', 'yogg_entry_footer_markup_close', 15);
add_action('genesis_entry_footer', 'yogg_next_prev_article_links');

add_filter('post_class', 'yogg_gallery_post_class');


add_filter('the_title', 'yogg_post_title_output');
function yogg_post_title_output( $title ) {

	if ( in_the_loop() && is_main_query() ) {
		$title = sprintf(
			'<a href="%s" title="Work">Work</a> &#187; %s',
			get_post_type_archive_link( 'yogg_work' ),
			$title
		);
	}

	return $title;
}


add_action('genesis_entry_header', 'yogg_work_single_entry_header', 10);
function yogg_work_single_entry_header() {

	echo genesis_get_image( array(
		'format'  => 'html',
		'size'    => 'large',
		'context' => 'archive',
		'attr'    => genesis_parse_attr( 'entry-image' )
	) );	

	echo sprintf('<p>%s</p>', get_the_excerpt());
}


add_filter( 'gallery_style', 'yogg_work_single_gallery_style');
function yogg_work_single_gallery_style( $styles ) {
	return '<div class="gallery">';
}


add_action('genesis_before_entry_content','yogg_work_single_before_entry_content');
function yogg_work_single_before_entry_content() {
	global $post;

	$attachments = get_children( array(
		'post_parent'    => $post->ID,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image'
	) );

	if(0 !== count($attachments)) {
		$featuredImage = get_post_thumbnail_id();
		echo do_shortcode("[gallery size='large' columns='1' link='none' exclude={$featuredImage}]");
	}

}


genesis();