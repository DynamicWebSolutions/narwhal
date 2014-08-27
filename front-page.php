<?php


add_action('genesis_after_header', 'yogg_homepage_after_header');
function yogg_homepage_after_header() {
    if ( is_front_page() ) {
    	echo do_shortcode('[flexslider slug="homepage"]');

	    genesis_widget_area ('home_slider', array(
	        'before' => '<section>',
	        'after' => '</section>'
      ));    	
    }
}


add_action('genesis_after_header', 'yogg_middle_menu');
function yogg_middle_menu() {
	wp_nav_menu( array( 
		'theme_location' => 'middle', 
		'container' => 'nav',
		'container_class' => 'middle-nav' 
	) );
}


add_action('genesis_after_content_sidebar_wrap', 'yogg_homepage_after_content_sidebar_wrap');
function yogg_homepage_after_content_sidebar_wrap() {
	    genesis_widget_area ('home_after_content', array(
	        'before' => '<section class="formaga">',
	        'after' => '</section>'
      ));    	
}


add_action('genesis_entry_header', 'yogg_homepage_featured_image', 9);
function yogg_homepage_featured_image() {
	the_post_thumbnail( 'medium' );
}


add_filter('genesis_attr_content', 'yogg_homepage_main_content_filter');
function yogg_homepage_main_content_filter($meta) {
	$meta['class'] = $meta['class'] . ' vargangrepp ';
	return $meta;
}


remove_action('genesis_entry_header', 'genesis_do_post_title');
remove_action('genesis_post_title', 'genesis_do_post_title');
add_action('genesis_entry_header', 'yogg_do_post_title');
add_action('genesis_post_title', 'yogg_do_post_title');
/**
 * Echo the title of a post.
 *
 * The `genesis_post_title_text` filter is applied on the text of the title, while the `genesis_post_title_output`
 * filter is applied on the echoed markup. 
 *
 * This copy adds an additional check for is_front_page.
 *
 *
 * @since 1.1.0
 *
 * @uses genesis_html5()          Check for HTML5 support.
 * @uses genesis_get_SEO_option() Get SEO setting value.
 * @uses genesis_markup()         Contextual markup.
 *
 * @return null Return early if the length of the title string is zero.
 */
function yogg_do_post_title() {

	$title = apply_filters( 'genesis_post_title_text', get_the_title() );

	if ( 0 === mb_strlen( $title ) )
		return;

	//* Link it, if necessary
	if ( ! is_singular() && apply_filters( 'genesis_link_post_title', true ) )
		$title = sprintf( '<a href="%s" rel="bookmark">%s</a>', get_permalink(), $title );

	//* Wrap in H1 on singular pages
	$wrap = is_singular() ? 'h1' : 'h2';

	//* Make sure there is only one h1 on the homepage.
	$wrap = ! is_front_page() ? $wrap : 'h2';

	//* Also, if HTML5 with semantic headings, wrap in H1
	$wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;

	//* Build the output
	$output = genesis_markup( array(
		'html5'   => "<{$wrap} %s>",
		'xhtml'   => sprintf( '<%s class="entry-title">%s</%s>', $wrap, $title, $wrap ),
		'context' => 'entry-title',
		'echo'    => false,
	) );

	$output .= genesis_html5() ? "{$title}</{$wrap}>" : '';

	echo apply_filters( 'genesis_post_title_output', "$output \n" );	
}



add_filter('genesis_seo_title', 'yogg_homepage_site_title_filter', null, 3);
function yogg_homepage_site_title_filter($title, $inside, $wrap) {
	return '<h1 class="site-title" itemprop="headline">'.$inside.'</h1>';
}


genesis();