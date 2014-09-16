<?php

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



add_action('genesis_entry_header', 'yogg_work_single_entry_header', 15);
function yogg_work_single_entry_header() {

		echo genesis_get_image( array(
			'format'  => 'html',
			'size'    => 'large',
			'context' => 'archive',
			'attr'    => genesis_parse_attr( 'entry-image' )
		) );	
}


add_filter( 'gallery_style', 'yogg_work_single_gallery_style');
function yogg_work_single_gallery_style( $styles ) {
	return '<div class="gallery">';
}


add_action('genesis_before_entry_content','yogg_work_single_before_entry_content');
function yogg_work_single_before_entry_content() {

	echo sprintf('<section><p>%s</p></section>', get_the_excerpt());

	$featuredImage = get_post_thumbnail_id();
	echo do_shortcode("[gallery size='large' columns='1' link='none' exclude={$featuredImage}]");

	
}

genesis();