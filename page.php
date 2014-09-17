<?php 

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action('genesis_after_content_sidebar_wrap', 'yogg_vargangrepp_display_post_meta');


add_action('genesis_after_header', 'yogg_page_after_header');
function yogg_page_after_header() {
	global $post;

	$subst = get_post_meta( $post->ID, '_yogg_subst', true );
	$substImage = genesis_get_image( 
		array( 
			'format' => 'html', 
			'size' => 'page-top', 
			'attr' => array( 
				'title' => $subst 
			) 
		) 
	);

	echo sprintf(
		'<div id="formaga-header">%s <h2>%s</h2></div>', 
		$substImage, 
		$subst
	);

	$pageID = ($post->post_parent) ? $post->post_parent : $post->ID;

	$breadcrumbArgs = array(
		'child_of'     => $pageID ,
		'date_format'  => get_option('date_format'),
		'depth'        => -1,
		'echo'         => 0,
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'sort_column'  => 'menu_order, post_title',
		'title_li'     => null
	);

	echo sprintf(
		'<nav class="middle-nav">
			<ul class="menu">
				<li %s>
					<a href="%s">%s &#187;</a>
				</li>
				%s
			</ul>
		</nav>', 
		(!$post->post_parent) ? 'class="page_item current_page_item"' : 'class="page_item"',
		get_permalink($pageID),
		get_the_title($pageID),
		wp_list_pages( $breadcrumbArgs )
	);
}


add_filter( 'genesis_attr_content', 'yogg_page_attributes_content' );
function yogg_page_attributes_content( $attributes ) {
	$attributes['id'] = 'formaga';
	return $attributes;

}



genesis();