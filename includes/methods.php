<?php

function yogg_vargangrepp_display_post_meta() {
	global $post;

	$vargangrepp = get_post_meta( $post->ID, '_yogg_vargangrepp', true );

	if($vargangrepp) :

		echo '<section class="vargangrepp">'; 

			if($vargangrepp['id']) :
				echo wp_get_attachment_image( $vargangrepp['id'], 'thumbnail' );
			endif;	

			if($vargangrepp['description']) :
				echo "<p>{$vargangrepp['description']}</p>";
			endif;			

		echo '</section>';		

	endif;	
}


function yogg_entry_footer_markup_open() {
  echo '<footer class="entry-footer">';
}


function yogg_entry_footer_markup_close() {
  echo '</footer>';
}


function yogg_next_prev_article_links() {

	$next = get_adjacent_post(false, '', false);
	$previous = get_adjacent_post(false, '', true);

	echo '<div class="page-navigation">';

		if($next) {
			echo sprintf(
				'<a class="link-previous" href="%s" title="%s">
					<span>&#171 Previous</span>
					<p>Lemme see that again!</p>
				</a>',
				get_permalink($next),
				$next->post_title
			);
		}	

		if($previous) {
			echo sprintf(
				'<a class="link-next" href="%s" title="%s">
					<span>Next &#187;</span>
					<p>Keep &apos;em coming!</p>
				</a>',
				get_permalink($previous),
				$previous->post_title
			);
		}	

	echo '<div>';	
}


function yogg_gallery_post_class($classes) {
	global $post;

	$attachments = get_children( array(
		'post_parent'    => $post->ID,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image'
	) );

	if(0 !== count($attachments)) {
		$classes[] = 'has-gallery';
	}

	return $classes;
}