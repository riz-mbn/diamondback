<?php

function mbn_shortcode_home_url($atts = null, $content = null){
    return home_url();
}
add_shortcode('home_url', 'mbn_shortcode_home_url');

function mbn_testimonials_shortcode($atts){

    
    $cat = (isset($atts['category'])) ? $atts['category'] : '';    
    $cat = get_term_by('name', $cat, 'testimonial_cats' );

    $query = array(
        'post_type'      => 'testimonials_type',
        'orderby'        => '',
        'order'          => 'asc',
        'posts_per_page' => -1,
        'tax_query'      => array(
            array (
                'taxonomy' => 'testimonial_cats',
                'field' => 'slug',
                'terms' => $cat->slug,
            )
        )
        //'category_name' => $cat->name, 
    );

    $testimonials = new WP_Query( $query );  

    $returnhtml .= '<div class="testimonials">';

    if($testimonials->have_posts()):

        while ( $testimonials->have_posts() ) : $testimonials->the_post();
        
        $testi_rating = get_field('star_rating'); 
        $excerpt = get_the_content();
        $name = get_the_title();
        
            $returnhtml .= '<div class="testi_item border">';
                $returnhtml .= '<div class="testi_inner">';
                    $returnhtml .= '<div class="testi_excerpt">'. $excerpt  .'</div>';
                    $returnhtml .= '<div class="testi_rating">'. $testi_rating .'</div>';
                    $returnhtml .= '<div class="testi_name">'. $name  .'</div>';  
                $returnhtml .= '</div>';
            $returnhtml .= '</div>';

        endwhile;
        wp_reset_postdata();
    
    endif;

    $returnhtml .= '</div>'; // testi_slick

    return $returnhtml;
}
add_shortcode('mbn_testimonials', 'mbn_testimonials_shortcode');


