<?php 

/** Widget Init **/
add_action( 'widgets_init', 'yogg_sidebar_init' );
function yogg_sidebar_init() {

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


add_action( 'widgets_init', 'yogg_widget_init');
function yogg_widget_init() {
    register_widget( 'Yogg_User_Profile_Widget' );
    register_widget( 'Yogg_Featured_Page' );
}


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
            <h2><a href="%s">%s %s</a></h2>
            <h3><em>%s</em></h3>            
            %s
            <p><a href="%s">%s</a></p>',
            wp_get_attachment_image( get_the_author_meta( 'author_profile_avatar', $instance['user'] ), 'portrait' ),
            get_author_posts_url( $instance['user'] ),
            get_the_author_meta( 'user_firstname', $instance['user'] ),
            get_the_author_meta( 'user_lastname', $instance['user'] ),            
            get_the_author_meta( 'nickname', $instance['user'] ),            
            wpautop( get_the_author_meta( 'description', $instance['user'] ) ),
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




/**
 * Yogg Featured Page widget class.
 * Modified from Genesis featured page to pull Vargangrepp Image from page
 *
 * @since 0.1.8
 *
 * @package Genesis\Widgets
 */
class Yogg_Featured_Page extends WP_Widget {

    /**
     * Holds widget settings defaults, populated in constructor.
     *
     * @var array
     */
    protected $defaults;

    /**
     * Constructor. Set the default widget options and create widget.
     *
     * @since 0.1.8
     */
    function __construct() {

        $this->defaults = array(
            'title'           => '',
            'page_id'         => '',
            'link_image'      => 0,
            'show_image'      => 0,
            'image_id'        => NULL,
            'image_alignment' => '',
            'image_size'      => '',
            'show_title'      => 0,
            'show_content'    => 0,
            'content_limit'   => '',
            'more_text'       => '',
        );

        $widget_ops = array(
            'classname'   => 'yogg-featured-content yogg-featuredpage',
            'description' => __( 'Displays featured page with Vargangrepp', 'genesis' ),
        );

        $control_ops = array(
            'id_base' => 'yogg-featured-page',
            'width'   => 200,
            'height'  => 250,
        );

        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
     
        parent::__construct( 'yogg-featured-page', __( 'Yogg - Featured Page', 'genesis' ), $widget_ops, $control_ops );

    }


    function admin_scripts() {
        wp_enqueue_media();
        wp_register_script('yogg-admin', get_stylesheet_directory_uri() . '/js/admin/admin.js', 'jquery', '1.0', true);
        wp_enqueue_script('yogg-admin');           
    }

    /**
     * Echo the widget content.
     *
     * @since 0.1.8
     *
     * @global WP_Query $wp_query Query object.
     * @global integer  $more
     *
     * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
     * @param array $instance The settings for the particular instance of the widget
     */
    function widget( $args, $instance ) {

        global $wp_query;

        //* Merge with defaults
        $instance = wp_parse_args( (array) $instance, $this->defaults );

        echo $args['before_widget'];

        //* Set up the author bio
        if ( ! empty( $instance['title'] ) )
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];

        $wp_query = new WP_Query( array( 'page_id' => $instance['page_id'] ) );

        if ( have_posts() ) : while ( have_posts() ) : the_post();

            genesis_markup( array(
                'html5'   => '<article %s>',
                'xhtml'   => sprintf( '<div class="%s">', implode( ' ', get_post_class() ) ),
                'context' => 'entry',
            ) );


            $image = (isset($instance['image_id'])) ? wp_get_attachment_image( $instance['image_id'], $instance['image_size'] ) : false;
            $title = get_the_title() ? get_the_title() : __( '(no title)', 'genesis' );
   

            if ( $instance['show_image'] && $image && $instance['link_image']) {
                printf( '<a href="%s" title="%s" class="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), esc_attr( $instance['image_alignment'] ), $image );
            }
            else {
                printf( '<span class="%s">%s</span>', esc_attr( $instance['image_alignment'] ), $image );
            }



            if ( ! empty( $instance['show_title'] ) &&  $instance['link_image'] ) {

                if ( genesis_html5() )
                    printf( '<header class="entry-header"><h2 class="entry-title"><a href="%s">%s</a></h2></header>', get_permalink(), esc_html( $title ) );
                else
                    printf( '<h2><a href="%s">%s</a></h2>', get_permalink(), esc_html( $title ) );

            }
            elseif( ! empty( $instance['show_title'] ) ) {

                if ( genesis_html5() )
                    printf( '<header class="entry-header"><h2 class="entry-title">%s</h2></header>', esc_html( $title ) );
                else
                    printf( '<h2>%s</h2>', esc_html( $title ) );
            }
            else {
                // Silence is golden
            }



            if ( ! empty( $instance['show_content'] ) ) {

                echo genesis_html5() ? '<div class="entry-content">' : '';

                if ( empty( $instance['content_limit'] ) ) {

                    global $more;

                    $orig_more = $more;
                    $more = 0;

                    the_content( $instance['more_text'] );

                    $more = $orig_more;

                } else {
                    the_content_limit( (int) $instance['content_limit'], esc_html( $instance['more_text'] ) );
                }

                echo genesis_html5() ? '</div>' : '';

            }

            genesis_markup( array(
                'html5' => '</article>',
                'xhtml' => '</div>',
            ) );

            endwhile;
        endif;

        //* Restore original query
        wp_reset_query();

        echo $args['after_widget'];

    }

    /**
     * Update a particular instance.
     *
     * This function should check that $new_instance is set correctly.
     * The newly calculated value of $instance should be returned.
     * If "false" is returned, the instance won't be saved/updated.
     *
     * @since 0.1.8
     *
     * @param array $new_instance New settings for this instance as input by the user via form()
     * @param array $old_instance Old settings for this instance
     * @return array Settings to save or bool false to cancel saving
     */
    function update( $new_instance, $old_instance ) {

        $new_instance['title']     = strip_tags( $new_instance['title'] );
        $new_instance['more_text'] = strip_tags( $new_instance['more_text'] );
        return $new_instance;

    }

    /**
     * Echo the settings update form.
     *
     * @since 0.1.8
     *
     * @param array $instance Current settings
     */
    function form( $instance ) {

        //* Merge with defaults
        $instance = wp_parse_args( (array) $instance, $this->defaults );
        $img      = ($instance['image_id']) ? wp_get_attachment_image( $instance['image_id'], 'thumbnail' ) : null;

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'genesis' ); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Page', 'genesis' ); ?>:</label>
            <?php wp_dropdown_pages( array( 'name' => $this->get_field_name( 'page_id' ), 'selected' => $instance['page_id'] ) ); ?>
        </p>


        <p>
            <input id="<?php echo $this->get_field_id( 'link_image' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'link_image' ); ?>" value="1"<?php checked( $instance['link_image'] ); ?> />
            <label for="<?php echo $this->get_field_id( 'link_image' ); ?>"><?php _e( 'Link to page', 'genesis' ); ?></label>
        </p>      
          
        <hr class="div" />

        <p>
            <input id="<?php echo $this->get_field_id( 'show_image' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'show_image' ); ?>" value="1"<?php checked( $instance['show_image'] ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_image' ); ?>"><?php _e( 'Show Vargangrepp', 'genesis' ); ?></label>
        </p>

        <?php
            echo sprintf(
                '<div id="%s" class="vargangrepp-metabox">
                    <div id="" class="vargangrepp-preview" style="width:150px;height:150px; margin:1em auto;border:1px dashed #cccccc;">
                        %s
                    </div>
                    <input style="width:150px;margin:0 auto;display:block;" type="button" class="yogg-vargangrepp-button button" value="Choose your monster" />
                    <input style="width:150px;margin:10px auto; auto;display:block;" type="button" class="yogg-vargangrepp-button-remove button" value="Remove monster" />
                    <input type="hidden" name="%s" class="vargangrepp-id" value="%s" />     
                </div>',
                $this->get_field_id( 'id' ),
                $img,
                $this->get_field_name( 'image_id' ),
                esc_attr( $instance['image_id'] )
            );
        ?>
    

        <p>
            <label for="<?php echo $this->get_field_id( 'image_size' ); ?>"><?php _e( 'Image Size', 'genesis' ); ?>:</label>
            <select id="<?php echo $this->get_field_id( 'image_size' ); ?>" class="genesis-image-size-selector" name="<?php echo $this->get_field_name( 'image_size' ); ?>">
                <option value="thumbnail">thumbnail (<?php echo absint( get_option( 'thumbnail_size_w' ) ); ?>x<?php echo absint( get_option( 'thumbnail_size_h' ) ); ?>)</option>
                <?php
                $sizes = genesis_get_additional_image_sizes();
                foreach ( (array) $sizes as $name => $size )
                    echo '<option value="' . esc_attr( $name ) . '" ' . selected( $name, $instance['image_size'], FALSE ) . '>' . esc_html( $name ) . ' (' . absint( $size['width'] ) . 'x' . absint( $size['height'] ) . ')</option>';
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'image_alignment' ); ?>"><?php _e( 'Image Alignment', 'genesis' ); ?>:</label>
            <select id="<?php echo $this->get_field_id( 'image_alignment' ); ?>" name="<?php echo $this->get_field_name( 'image_alignment' ); ?>">
                <option value="alignnone">- <?php _e( 'None', 'genesis' ); ?> -</option>
                <option value="alignleft" <?php selected( 'alignleft', $instance['image_alignment'] ); ?>><?php _e( 'Left', 'genesis' ); ?></option>
                <option value="alignright" <?php selected( 'alignright', $instance['image_alignment'] ); ?>><?php _e( 'Right', 'genesis' ); ?></option>
                <option value="aligncenter" <?php selected( 'aligncenter', $instance['image_alignment'] ); ?>><?php _e( 'Center', 'genesis' ); ?></option>
            </select>
        </p>

        <hr class="div" />

        <p>
            <input id="<?php echo $this->get_field_id( 'show_title' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'show_title' ); ?>" value="1"<?php checked( $instance['show_title'] ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_title' ); ?>"><?php _e( 'Show Page Title', 'genesis' ); ?></label>
        </p>

        <p>
            <input id="<?php echo $this->get_field_id( 'show_content' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'show_content' ); ?>" value="1"<?php checked( $instance['show_content'] ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_content' ); ?>"><?php _e( 'Show Page Content', 'genesis' ); ?></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'content_limit' ); ?>"><?php _e( 'Content Character Limit', 'genesis' ); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'content_limit' ); ?>" name="<?php echo $this->get_field_name( 'content_limit' ); ?>" value="<?php echo esc_attr( $instance['content_limit'] ); ?>" size="3" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'more_text' ); ?>"><?php _e( 'More Text', 'genesis' ); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'more_text' ); ?>" name="<?php echo $this->get_field_name( 'more_text' ); ?>" value="<?php echo esc_attr( $instance['more_text'] ); ?>" />
        </p>
        <?php

    }

}
