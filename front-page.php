<?php

remove_action('genesis_entry_header', 'genesis_do_post_title');
remove_action('genesis_post_title', 'genesis_do_post_title');
remove_action( 'genesis_loop', 'genesis_do_loop' );


add_action('genesis_after_header', 'yogg_homepage_after_header');
function yogg_homepage_after_header() {
    if ( is_front_page() ) {

			if(function_exists('show_flexslider_rotator')) {
				echo show_flexslider_rotator( 'homepage' );    	
			}
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


add_action('genesis_before_loop', 'yogg_homepage_vargangrepp');
function yogg_homepage_vargangrepp() {
	genesis_widget_area ('home_vargangrepp', array(
    'before' => '<section class="vargangrepp">',
    'after' => '</section>'
	));  
}


add_action('genesis_after_content_sidebar_wrap', 'yogg_homepage_after_content_sidebar_wrap');
function yogg_homepage_after_content_sidebar_wrap() {
	echo '<section id="formaga">';

	  genesis_widget_area ('home_formaga_top', array(
      'before' => '<div id="formaga-top">',
      'after' => '</div>'
	  ));  

	  genesis_widget_area ('home_formaga_bottom', array(
      'before' => '<div id="formaga-bottom">',
      'after' => '</div>'
	  ));  


  echo '</section>'; 	

  echo '<section class="deers-mouth">
				  <h2>From the deer&apos;s mouth</h2>

				  <aside>';

						$recentArgs = array(
							'posts_per_page' => 2
						);

					  $recentPosts = new WP_Query($recentArgs);

					  if($recentPosts->have_posts()) :
					  	while($recentPosts->have_posts()) :
					  		$recentPosts->the_post();

								echo sprintf(
									'<article>
										<header>
											<h3><a href="%s" title="%s">%s</a></h3>
										</header>
										<div class="entry-content">
											%s
										</div>
										<footer>
										%s
										%s
										</footer>
									</article>',
									get_permalink(),
									the_title_attribute(array('echo' => false)),
									get_the_title(),
									get_the_excerpt(),
									do_shortcode('[post_date format="F j, Y" label=""]'),
									do_shortcode('[post_categories sep=", " before=""]')
								);

					  	endwhile;
					  endif;		

					  wp_reset_postdata();

	echo		'</aside>

				  <aside>
					  <a class="twitter-timeline" href="https://twitter.com/LandOfyogg" data-widget-id="512236773447983104">Tweets by @LandOfyogg</a>
					</aside>			  
			  </section>';
}


add_filter('genesis_seo_title', 'yogg_homepage_site_title_filter', null, 3);
function yogg_homepage_site_title_filter($title, $inside, $wrap) {
	return '<h1 class="site-title" itemprop="headline">'.$inside.'</h1>';
}



genesis();