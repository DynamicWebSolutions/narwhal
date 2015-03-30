<?php


/**
 ** Land of yogg colonies
 **
 **
**/
include_once(dirname(__FILE__) . '/includes/widgets.php');
include_once(dirname(__FILE__) . '/includes/methods.php');
include_once(dirname(__FILE__) . '/includes/meta_boxes.php');
include_once(dirname(__FILE__) . '/includes/user_profile.php');


/**
 ** Genesis mods
 **
 **
**/ 
add_action('after_setup_theme', 'yogg_remove_layouts');
function yogg_remove_layouts() {

    // One layout to rule them all.
    genesis_unregister_layout( 'content-sidebar' );
    genesis_unregister_layout( 'sidebar-content' );
    genesis_unregister_layout( 'content-sidebar-sidebar' );
    genesis_unregister_layout( 'sidebar-sidebar-content' );
    genesis_unregister_layout( 'sidebar-content-sidebar' ); 
}


add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
add_theme_support( 'post-thumbnails' ); 
add_theme_support ( 'genesis-menus', array ( 
    'header' => 'Header Navigation Menu',
    'middle' => 'Middle Navigation Menu',
    'footer' => 'Footer Navigation Menu', 
    'social' => 'Social Navigation Menu' 
));


/**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
add_filter( 'theme_page_templates', 'yogg_remove_genesis_page_templates' );
function yogg_remove_genesis_page_templates( $page_templates ) {

    unset( $page_templates['page_archive.php'] );
    unset( $page_templates['page_blog.php'] );
    return $page_templates;
}



/**
 ** Yogg custom image sizes
 **
 **
**/ 
add_image_size('archive-grid', 200, 200, true);
add_image_size('page-top', 1150, 300, true);
add_image_size('slider', 1150, 500, true);
add_image_size('portrait', 400, 600, true);






/**
 ** Yogg encantations, otherwise known as javascript
 **
 **
**/ 
add_action('wp_enqueue_scripts', 'yogg_encantations');
function yogg_encantations() {

    wp_register_script('yogg-modernizr', get_stylesheet_directory_uri() . '/js/modernizr.js', '', '2.8.3', false);
    wp_enqueue_script('yogg-modernizr');

    wp_register_script('yogg-encantations', get_stylesheet_directory_uri() . '/js/encantations.js', 'jquery', '1.0', true);
    wp_enqueue_script('yogg-encantations');
}


add_action('admin_enqueue_scripts', 'yogg_admin_js');
function yogg_admin_js() {

    $screen = get_current_screen();

    $screens = array('post', 'user-edit', 'profile');

    if(in_array($screen->base, $screens)) :

        wp_enqueue_media();
        wp_register_script('yogg-admin', get_stylesheet_directory_uri() . '/js/admin/admin.js', 'jquery', '1.0', true);
        wp_enqueue_script('yogg-admin');
    endif;
}




/**
 ** Yogg Header Mods
 **
 **
**/ 
add_filter('body_class', 'yogg_menu_item_count');
add_action('genesis_before', 'yogg_sitewide_mods');
function yogg_sitewide_mods() {

    remove_action( 'genesis_site_description', 'genesis_seo_site_description');    
}


add_action('genesis_header', 'yogg_top_menu_toggle', 11);
function yogg_top_menu_toggle() {

    echo '
        <span id="header-meta">
            <a itemprop="telephone" href="tel:1-804-888-6380">(804) 888-6380</a>
            <a itemprop="email" href="mailto:hello@landofyogg.com">hello@landofyogg.com</a>
            <span id="hamburger"></span>
        </span>';
}


add_action('genesis_header', 'yogg_top_menu', 20);
function yogg_top_menu() {

	wp_nav_menu( array( 
		'theme_location' => 'header', 
		'container' => null,
		'container_class' => 'top-nav closed'
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



/**
 ** Yogg Article Mods
 **
 **
**/ 
add_action('genesis_before_loop', 'yogg_before_loop');
function yogg_before_loop() {

    if(!is_singular()) {
        remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
        remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
    }
}



/**
 ** Yogg Footer Mods
 **
 **
**/ 
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


add_action('wp_footer', 'yogg_twitter_script');
function yogg_twitter_script() {

    echo '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
}


add_filter('genesis_footer_creds_text', 'yogg_footer_creds_text');
function yogg_footer_creds_text( $creds ) {

    $year = date("Y");
    $url = get_bloginfo('url');
    $creds = '<span class="creds">117 North 20th Street / Richmond, VA 23223</span>';
    $creds .= "<span class='creds'>&copy; {$year} <a href='{$url}' title='Land of yogg'>yogg</a> All rights reserved";
    
    return $creds;
}

