<?php

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_before_footer', 'yogg_vargangrepp_display_post_meta');


add_action('genesis_after_header', 'yogg_single_header', 10);
function yogg_single_header() {

	echo '<section>';
	
		echo '<h2>Deer Diary</h2>';

		echo '<a href="/deer-diary/">Archive &#187;</a>';

	echo '</section>';
}

add_action( 'genesis_entry_header', 'yogg_single_featured_image', 9);
function yogg_single_featured_image() {

	echo genesis_get_image( array(
		'format'  => 'html',
		'size'    => 'large',
		'context' => 'archive',
		'attr'    => genesis_parse_attr( 'entry-image' )
	) );

}


add_filter( 'genesis_post_meta', 'yogg_single_meta_filter' );
function yogg_single_meta_filter($post_meta) {
	$post_meta = '[post_date format="F j, Y"]' . '[post_categories before=""]';
	return $post_meta;
}

genesis();