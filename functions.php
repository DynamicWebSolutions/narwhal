<?php



add_image_size('archive-grid', 200, 200, true);

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
add_theme_support( 'post-thumbnails' ); 
add_theme_support ( 'genesis-menus', array ( 
	'header' => 'Header Navigation Menu',
	'middle' => 'Middle Navigation Menu',
	'footer' => 'Footer Navigation Menu', 
	'social' => 'Social Navigation Menu' 
));


add_action('wp_enqueue_scripts', 'yogg_encantations');
function yogg_encantations() {
    wp_register_script('yogg-encantations', get_stylesheet_directory_uri() . '/js/encantations.js', 'jquery', 1.0, true);
    wp_enqueue_script('yogg-encantations');
}


add_action('genesis_before', 'yogg_sitewide_mods');
function yogg_sitewide_mods() {
    //* Remove the site description
    remove_action( 'genesis_site_description', 'genesis_seo_site_description');    
}


add_action('genesis_before_loop', 'yogg_before_loop');
function yogg_before_loop() {
	if(!is_singular()) {
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	}
}


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
        'name' => __( 'Home Vargangrepp', 'genesis' ),
        'id' => 'home_vargangrepp',
        'description' => __( 'Homepage monster', 'genesis' ),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ) );	   

   genesis_register_sidebar( array(          
        'name' => __( 'Home Formaga', 'genesis' ),
        'id' => 'home_formaga',
        'description' => __( 'Clever Content', 'genesis' ),
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


add_action('genesis_header', 'yogg_top_menu_toggle', 11);
function yogg_top_menu_toggle() {
    echo '
        <span id="header-meta">
            <span itemprop="telephone">(804) 888-6380</span>
            <span itemprop="email">hello@landofyogg.com</span>
            <span id="hamburger"></span>
        </span>';
}



add_action('genesis_header', 'yogg_top_menu', 20);
function yogg_top_menu() {
	wp_nav_menu( array( 
		'theme_location' => 'header', 
		'container' => null,
		'container_class' => 'top-nav'
	) );
}


add_filter('wp_nav_menu', 'yogg_header_form', null, 2);
function yogg_header_form($html, $args) {
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




