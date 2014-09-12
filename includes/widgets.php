<?php 

/** Widget Init **/
add_action( 'widgets_init', 'yogg_widget_init' );
function yogg_widget_init() {

   genesis_register_sidebar( array(          
        'name' => __( 'Home Vargangrepp', 'genesis' ),
        'id' => 'home_vargangrepp',
        'description' => __( 'Homepage Monster', 'genesis' ),
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ) );	   

   genesis_register_sidebar( array(          
        'name' => __( 'Home Formaga Top', 'genesis' ),
        'id' => 'home_formaga_top',
        'description' => __( 'Clever Content', 'genesis' ),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ) );	

   genesis_register_sidebar( array(          
        'name' => __( 'Home Formaga Bottom', 'genesis' ),
        'id' => 'home_formaga_bottom',
        'description' => __( 'Clever Content', 'genesis' ),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ) );     

   genesis_register_sidebar( array(          
        'name' => __( 'Work Archive Vargangrepp', 'genesis' ),
        'id' => 'work_archive_vargangrepp',
        'description' => __( 'Work Archive Monster', 'genesis' ),
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
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