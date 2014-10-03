<?php
/*
Template Name: Foramga
*/

add_action( 'genesis_after_content_sidebar_wrap', 'yogg_vargangrepp_display_post_meta');


add_action('genesis_entry_content', 'yogg_you_who_after_content_sidebar_wrap', 5);
function yogg_you_who_after_content_sidebar_wrap() {

  genesis_widget_area( 'home_formaga_top', array(
    'before' => '<div id="formaga-top">',
    'after' => '</div>'
  ));  
}

genesis();