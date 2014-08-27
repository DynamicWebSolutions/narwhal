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


add_filter('flexslider_hg_rotators', 'yogg_slider_customizations');
function yogg_slider_customizations($args) {
	if(isset($args['homepage'])) {
		$options = json_decode($args['homepage']['options']);
		$options->prevText = '&#171;';
		$options->nextText = '&#187;';

		$args['homepage']['options'] = json_encode($options);

	}

	return $args;
}


add_action('genesis_after_header', 'yogg_middle_menu');
function yogg_middle_menu() {
	wp_nav_menu( array( 
		'theme_location' => 'middle', 
		'container' => 'nav',
		'container_class' => 'middle-nav' 
	) );
}


remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_before_loop', 'yogg_homepage_vargangrepp');
function yogg_homepage_vargangrepp() {
	genesis_widget_area ('home_vargangrepp', array(
	    'before' => '<section>',
	    'after' => '</section>'
	));  
}


add_action('genesis_after_content_sidebar_wrap', 'yogg_homepage_after_content_sidebar_wrap');
function yogg_homepage_after_content_sidebar_wrap() {
  genesis_widget_area ('home_formaga', array(
      'before' => '<section class="formaga">',
      'after' => '</section>'
  ));    	
}


add_filter('genesis_attr_content', 'yogg_homepage_main_content_filter');
function yogg_homepage_main_content_filter($meta) {
	$meta['class'] = $meta['class'] . ' vargangrepp ';
	return $meta;
}


remove_action('genesis_entry_header', 'genesis_do_post_title');
remove_action('genesis_post_title', 'genesis_do_post_title');


add_filter('genesis_seo_title', 'yogg_homepage_site_title_filter', null, 3);
function yogg_homepage_site_title_filter($title, $inside, $wrap) {
	return '<h1 class="site-title" itemprop="headline">'.$inside.'</h1>';
}


genesis();