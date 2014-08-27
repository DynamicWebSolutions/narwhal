<?php

add_action('genesis_after_header', 'yogg_work_page_header');
function yogg_work_page_header() {
	echo "<h1>Workin' it.</h1>";
}

remove_action( 'genesis_post_content', 'genesis_do_post_content');
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );





genesis();