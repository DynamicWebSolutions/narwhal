<?php


add_action('genesis_after_header', 'yogg_homepage_after_header');
function yogg_homepage_after_header() {
    if ( is_front_page() ) {
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
    if ( is_front_page() ) {
	    genesis_widget_area ('home_after_content', array(
	        'before' => '<section>',
	        'after' => '</section>'
      ));    	
    }
}

genesis();