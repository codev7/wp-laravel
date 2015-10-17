<?php

namespace BaseTheme;

/**
* Loads the base theme class.  The base_theme_class is extended here.
* Please see wiki documentation for full set of features and helpers available in the base_theme_class.
*/
include_once( 'core/base-theme-class.php' );  

class Theme extends base_theme_class {

    var $version = '1.0';

    var $theme_name = 'codemyviews';

    var $include_jquery = true;

    var $load_options_panel = false;

    var $disabled_theme_editor = true;

    var $load_thumbnail_support = true;

    var $excerpt_text = 'Read More';

    var $force_enable_acf_option_panel = false;

    /* Load more custom post types here */
    public function load_custom_post_types()
    {

        // Sample Custom Post Type - Add as many as you'd like 

        $labels = array(
            'name'               => _x( 'Landing Pages', 'post type general name', 'codemyviews' ),
            'singular_name'      => _x( 'Landing Page', 'post type singular name', 'codemyviews' ),
            'menu_name'          => _x( 'SEO Landing Pages', 'admin menu', 'codemyviews' ),
            'name_admin_bar'     => _x( 'SEO Landing Page', 'add new on admin bar', 'codemyviews' ),
            'add_new'            => _x( 'Add New SEO Landing Page', 'service', 'codemyviews' ),
            'add_new_item'       => __( 'Add New SEO Landing Page', 'codemyviews' ),
            'new_item'           => __( 'New SEO Landing Page', 'codemyviews' ),
            'edit_item'          => __( 'Edit SEO Landing Page', 'codemyviews' ),
            'view_item'          => __( 'View SEO Landing Page', 'codemyviews' ),
            'all_items'          => __( 'All SEO Landing Pages', 'codemyviews' ),
            'search_items'       => __( 'Search SEO Landing Pages', 'codemyviews' ),
            'parent_item_colon'  => __( 'Parent SEO Landing Pages:', 'codemyviews' ),
            'not_found'          => __( 'No SEO landing pages found.', 'codemyviews' ),
            'not_found_in_trash' => __( 'No SEO landing pages found in Trash.', 'codemyviews' )
        );
       
        $this->custom_post_types['landing-page'] = array(

            'labels'             => $labels,            
            'public'             => true,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => ['slug' => 'services' ],
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => [ 'title']
        ); 
        
        $labels = array(
            'name'               => _x( 'Blog Posts', 'post type general name', 'codemyviews' ),
            'singular_name'      => _x( 'Blog Post', 'post type singular name', 'codemyviews' ),
            'menu_name'          => _x( 'Blog Posts', 'admin menu', 'codemyviews' ),
            'name_admin_bar'     => _x( 'Blog Post', 'add new on admin bar', 'codemyviews' ),
            'add_new'            => _x( 'Add New Blog Post', 'service', 'codemyviews' ),
            'add_new_item'       => __( 'Add New Blog Post', 'codemyviews' ),
            'new_item'           => __( 'New Blog Post', 'codemyviews' ),
            'edit_item'          => __( 'Edit Blog Post', 'codemyviews' ),
            'view_item'          => __( 'View Blog Post', 'codemyviews' ),
            'all_items'          => __( 'All Blog Posts', 'codemyviews' ),
            'search_items'       => __( 'Search Blog Posts', 'codemyviews' ),
            'parent_item_colon'  => __( 'Parent Blog Posts:', 'codemyviews' ),
            'not_found'          => __( 'No Blog Posts found.', 'codemyviews' ),
            'not_found_in_trash' => __( 'No Blog Posts found in Trash.', 'codemyviews' )
        );
        
        $this->custom_post_types['blog-post'] = array(

            'labels'             => $labels,            
            'public'             => true,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => ['slug' => 'blog' ],
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'taxonomies'         => ['category'],
            'supports'           => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments']
        
        ); 

    }


    public function load_custom_taxonomies()
    {

        // Sample Custom Taxonomy - Add as many as you'd like 

        /*

        $this->custom_taxonomies['testimonial-category'] = array(

            'belongs_to_post_type' => 'testimonial',
            'label' => 'Testimonial Categories',
            'description' => 'These are the categories used to sort testimonials',
            'public' => true,
            'hierarchical' => false

            // any additional options can be added as defined in WP codex: https://codex.wordpress.org/Function_Reference/register_taxonomy
        );

        */
    }

    public function load_shortcodes()
    {

        //This is a sample shortcode.  Please see full shortcode documentation. 
        
        /* */

        add_shortcode( 'contact_form', function($atts) {

            return view('forms/contact-form')->with(array(

                'form_title' => 'Contact Us',
                'atts' => $atts

            ));

        });

       

    }



    public function load_sidebars()
    {

        /*register_sidebar(array(
            'name'          => 'Primary',
            'id'            => 'sidebar-primary',
            'before_widget' => '<section class="widget %1$s %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>',
        ));*/

        
    }

    public function load_options_panel()
    {

        acf_add_options_page(array(
            'page_title'    => 'Theme Options',
            'menu_title'    => 'Options',
            'menu_slug'     => 'theme-options-settings',
            'capability'    => 'edit_posts',
            'redirect'      => true
        ));

        acf_add_options_sub_page(array(
            'page_title'    => 'Header & Footer Options',
            'menu_title'    => 'Header / Footer',
            'parent_slug'   => 'theme-options-settings',
        ));

        acf_add_options_sub_page(array(
            'page_title'    => 'JavaScript & CSS Options',
            'menu_title'    => 'Javascript / CSS',
            'parent_slug'   => 'theme-options-settings',
        ));

        

    }

    public function set_menus()
    {

        $this->menus = array(
            'main_nav' => 'Main Navigation', 
            'footer_nav' => 'Footer Navigation'
        );
        
    }

    /**
    * Set the image size array.
    *
    * $image_sizes[] = array('name' => 'image-size-name', 'width' => 600, 'height' => 400, 'crop' => true)  
    * set width/height to 9999 to not force that size.
    * set crop to false to not force the size.
    */
    public function set_image_sizes()
    {

        $this->image_sizes[] = array(
            'name' => 'facebook_image_size',
            'width' => 470,
            'height' => 246,
            'crop' =>true
        );

        $this->image_sizes[] = array(
            'name' => 'square',
            'width' => 500,
            'height' => 500,
            'crop' =>true
        );
    }

}

$theme = new \BaseTheme\Theme;

