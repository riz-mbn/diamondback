<?php


// Register courses Post Type
function courses_post() {
    register_post_type( 'course',
        array(
            'labels'    => array(
                'name' => __( 'Courses' ),
                'singular_name' => __('Course')
            ),
            'public'        => true,
            'has_archive'   => true,
            'show_in_rest'  => true,
            'menu_position' => 20,
            'with_front' => true,
            'supports'      =>  array('title', 'editor', 'page-attributes', 'thumbnail'),
            'menu_icon'     => 'dashicons-editor-paragraph',
        )
    );

    register_taxonomy(  
        'courses',
        'course',
        array(
            'hierarchical' => true,         
            'has_archive' => true,
            'label' => 'Categories',            
            'query_var' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
            /*'rewrite' => array(
                'slug' => 'courses',
                'with_front' => true  
            )*/
        )
    );
}
//add_action( 'init', 'courses_post' ); 