<?php

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
add_theme_support ( 'genesis-menus', array ( 
	'header' => 'Header Navigation Menu',
	'middle' => 'Middle Navigation Menu',
	'footer' => 'Footer Navigation Menu', 
	'social' => 'Social Navigation Menu' 
));


/** Widget Init **/
add_action( 'widgets_init', 'yogg_widget_init' );
function yogg_widget_init() {
   genesis_register_sidebar( array(          
        'name' => __( 'Home Slider', 'genesis' ),
        'id' => 'home_slider',
        'description' => __( 'Your Most Awesome Stuff', 'genesis' ),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ) );	

   genesis_register_sidebar( array(          
        'name' => __( 'Home After Content', 'genesis' ),
        'id' => 'home_after_content',
        'description' => __( 'Your Second Most Awesome Stuff', 'genesis' ),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ) );	

   genesis_register_sidebar( array(          
        'name' => __( 'Footer Left', 'genesis' ),
        'id' => 'footer_left',
        'description' => __( 'Stuff to the left of me.', 'genesis' ),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ) );	 

   genesis_register_sidebar( array(          
        'name' => __( 'Footer Right', 'genesis' ),
        'id' => 'footer_right',
        'description' => __( 'Stuff to the right of me.', 'genesis' ),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ) );	           
}


add_action('genesis_header', 'yogg_top_menu', 20);
function yogg_top_menu() {
	wp_nav_menu( array( 
		'theme_location' => 'header', 
		'container' => null,
		'container_class' => 'top-nav'
	) );
}


add_filter('wp_nav_menu', 'yogg_test', null, 2);
function yogg_test($html, $args) {
	if('header' === $args->theme_location) {
		$menu = $html;

		$html = sprintf('<nav class="%s"> %s %s</nav>', 
				$args->container_class, 
				do_shortcode('[contact-form-7 id="84" title="Telegraph Service"]'),
				$menu
		);
	}
	return $html;
}


add_action('genesis_footer', 'yogg_footer_menu');
function yogg_footer_menu() {
	wp_nav_menu( array( 
		'theme_location' => 'footer', 
		'container' => 'nav',
		'container_class' => 'footer-nav' 
	) );

	wp_nav_menu( array( 
		'theme_location' => 'social', 
		'container' => 'nav',
		'container_class' => 'social-nav' 
	) );
}


add_action('genesis_footer', 'yogg_footer_widgets');
function yogg_footer_widgets() {

	genesis_widget_area ('footer_left', array(
	    'before' => '<div>',
	    'after' => '</div>'
	));  

	genesis_widget_area ('footer_right', array(
	    'before' => '<div>',
	    'after' => '</div>'
	));  

}




