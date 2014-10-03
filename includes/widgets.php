<?php 

/** Widget Init **/
add_action( 'widgets_init', 'yogg_widget_init' );
function yogg_widget_init() {

    unregister_sidebar( 'sidebar' );
    unregister_sidebar( 'sidebar-alt' );   
    unregister_sidebar( 'header-right' );     

    genesis_register_sidebar( array(          
        'name' => __( 'Home Vargangrepp', 'genesis' ),
        'id' => 'home_vargangrepp',
        'description' => __( 'Homepage Monster', 'genesis' ),
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );	   

    genesis_register_sidebar( array(          
        'name' => __( 'Home Formaga Top', 'genesis' ),
        'id' => 'home_formaga_top',
        'description' => __( 'Clever Content', 'genesis' ),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );	

    genesis_register_sidebar( array(          
        'name' => __( 'Home Formaga Bottom', 'genesis' ),
        'id' => 'home_formaga_bottom',
        'description' => __( 'Clever Content', 'genesis' ),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );     

    genesis_register_sidebar( array(          
        'name' => __( 'Work Archive Vargangrepp', 'genesis' ),
        'id' => 'work_archive_vargangrepp',
        'description' => __( 'Work Archive Monster', 'genesis' ),
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );    

    genesis_register_sidebar( array(          
        'name' => __( 'yoggernauts', 'genesis' ),
        'id' => 'yoggernauts',
        'description' => __( 'These people work for us.', 'genesis' ),
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ) );              
}

function yogg_yoggernauts_widget_area() {
    genesis_widget_area ('yoggernauts', array(
        'before' => '<div id="yoggernauts-widget">',
        'after' => '</div>'
    ));   
}


add_action( 'widgets_init', function(){
    register_widget( 'Yogg_User_Profile_Widget' );
});


class Yogg_User_Profile_Widget extends WP_Widget {

    function __construct() {

        $this->defaults = array(
            'user'           => '',
            'size'           => '45',
            'author_info'    => '',
            'bio_text'       => '',
            'page'           => '',
            'page_link_text' => __( 'Read More', 'genesis' ) . '&#x02026;',
            'posts_link'     => '',
        );

        $widget_ops = array(
            'classname'   => 'yogg-user-profile',
            'description' => __( 'Displays user profile block with their photo', 'genesis' ),
        );

        $control_ops = array(
            'id_base' => 'yogg-user-profile',
            'width'   => 200,
            'height'  => 250,
        );

        parent::__construct( 'yogg-user-profile', __( 'Yogg - User Profile', 'genesis' ), $widget_ops, $control_ops );

    }


    function widget( $args, $instance ) {

        echo $args['before_widget'];

        echo sprintf(
            '%s 
            <a href="%s">%s %s</a>
            <p><em>%s</em></p>            
            %s
            <p><a href="https://twitter.com/%s">@%s</a></p>
            <p><a href="%s">%s</a></p>',
            wp_get_attachment_image( get_the_author_meta( 'author_profile_avatar', $instance['user'] ), 'portrait' ),
            get_author_posts_url( $instance['user'] ),
            get_the_author_meta( 'user_firstname', $instance['user'] ),
            get_the_author_meta( 'user_lastname', $instance['user'] ),            
            get_the_author_meta( 'nickname', $instance['user'] ),            
            wpautop( get_the_author_meta( 'description', $instance['user'] ) ),
            get_the_author_meta( 'twitter', $instance['user'] ),
            get_the_author_meta( 'twitter', $instance['user'] ),
            get_the_author_meta( 'user_url', $instance['user'] ),
            get_the_author_meta( 'user_url', $instance['user'] )
        );

        echo $args['after_widget'];
    }


    function form( $instance ) {

        //* Merge with defaults
        $instance = wp_parse_args( (array) $instance, $this->defaults );    


        echo '<p>';
            echo "<label for='{$this->get_field_name( 'user' )}'>";
                _e( 'This will display information from the user&apos;s profile. .', 'genesis' );
            echo "</label><br />";
            wp_dropdown_users( array( 'who' => 'authors', 'name' => $this->get_field_name( 'user' ), 'selected' => $instance['user'] ) );
        echo '</p>';        

    }

}