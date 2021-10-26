<?php
// Register Testimonials Post Type
function testimonials_post() {
    register_post_type( 'testimonials_type',
        array(
            'labels'    => array(
                'name' => __( 'Testimonials' ),
                'singular_name' => __('Testimonial')
            ),
            'public'        => true,
            'publicly_queryable'  => false,
            'has_archive'   => false,
            'show_in_rest'  => false,
            'menu_position' => 20,
            'supports'      =>  array('title', 'editor', 'page-attributes'),
            'menu_icon'     => 'dashicons-format-quote',
            'rewrite' => array(
                'slug' => 'testimonials_type',
                'with_front' => false  
            )
        )
    );

    register_taxonomy(  
        'testimonial_cats',
        'testimonials_type',
        array(
            'hierarchical' => true,         
            'has_archive' => true,
            'label' => 'Categories',            
            'query_var' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
            'rewrite' => array(
                'slug' => 'testimonial_cats',
                'with_front' => false  
            )
        )
    );
}
add_action( 'init', 'testimonials_post' ); 
