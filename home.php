<?php


add_action('genesis_after_header', 'yogg_home_after_header');
function yogg_home_after_header() {
	global $wp_query;

	$page_content = get_post($wp_query->queried_object_id);

	echo sprintf('<section><h1>%s</h1><p>%s</p></section>', $page_content->post_title, $page_content->post_content);

}

add_filter( 'genesis_attr_content', 'yogg_blog_attributes_content' );
function yogg_blog_attributes_content( $attributes ) {
	$attributes['id'] = 'formaga';
	return $attributes;
}

add_filter( 'post_class', 'genesis_grid_loop_post_class' );

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

add_action('genesis_entry_header', 'yogg_home_entry_header', 5);
function yogg_home_entry_header() {

	$img = genesis_get_image( array(
		'format'  => 'html',
		'size'    => 'large',
		'context' => 'archive',
		'attr'    => genesis_parse_attr( 'entry-image' )
	) );	

	if ( ! empty( $img ) ) {
   printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $img );
	}

}

add_action( 'genesis_entry_footer', 'genesis_post_meta', 11);

add_filter( 'genesis_post_meta', 'yogg_blog_post_meta_filter' );
function yogg_blog_post_meta_filter($post_meta) {
if ( !is_page() ) {
	return '[post_date format="F j, Y"]' . '[post_categories before=""]';
}}


genesis();