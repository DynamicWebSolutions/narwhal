<?php
/*
Template Name: Subst + yoggernauts
*/

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action('genesis_after_content_sidebar_wrap', 'yogg_yoggernauts_widget_area');
add_action('genesis_after_header', 'yogg_subst_header');


genesis();