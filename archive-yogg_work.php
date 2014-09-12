<?php

add_action('genesis_after_header', 'yogg_work_page_header');
function yogg_work_page_header() {
	echo "<h1>Workin' it.</h1>";
}

remove_action( 'genesis_post_content', 'genesis_do_post_content');
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );


add_action('genesis_after_content_sidebar_wrap', 'yogg_work_after_content_sidebar_wrap');
function yogg_work_after_content_sidebar_wrap() {

	  genesis_widget_area ('work_archive_vargangrepp', array(
	    'before' => '<section class="vargangrepp">',
	    'after' => '</section>'
	  ));  
}


genesis();