<?php

function mbn_shortcode_home_url($atts = null, $content = null){
    return home_url();
}
add_shortcode('home_url', 'mbn_shortcode_home_url');

function mbn_testimonials_shortcode($atts){

    
    $cat = (isset($atts['category'])) ? $atts['category'] : '';    
    $cat = get_term_by('name', $cat, 'testimonial_cats' );
    $returnhtml = '';

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

function hero_steps_shortcode(){
    $returnhtml = '<div class="hero-steps">
            <div class="step">
                <figure><img src="'. MBN_ASSETS_URI .'/img/icon/icn-step-1.svg" alt="" width="85" height="85" ></figure>
                <div class="step_text">
                    <figure><img src="'. MBN_ASSETS_URI . '/img/icon/icn-schedule.svg" alt="" width="48" height="48" ></figure>
                    <span class="step_label">Schedule Your Free <span class="break">Estimate</span></span>
                </div>
            </div>
            <div class="step">
                <figure><img src="'. MBN_ASSETS_URI . '/img/icon/icn-step-2.svg" alt="" width="85" height="85" ></figure>
                <div class="step_text">
                    <figure><img src="'. MBN_ASSETS_URI . '/img/icon/icn-choose.svg" alt="" width="43" height="47" ></figure>
                    <span class="step_label">Choose Which Flooring Samples You <span class="break">Want Brought To Your Home for the</span> <span class="break">In-Home Shopping Experience</span></span>
                </div>
            </div>
            <div class="step">
                <figure><img src="'. MBN_ASSETS_URI . '/img/icon/icn-step-3.svg" alt="" width="85" height="85" /></figure>
                <div class="step_text">
                    <figure><img src="'. MBN_ASSETS_URI . '/img/icon/icn-thumbsup.svg" alt="" width="48" height="48" /></figure>
                    <span class="step_label">Professional Installation <span class="break">Satisfaction Guaranteed!</span></span>
                </div>
            </div>
        </div>';
    return $returnhtml;
}
add_shortcode('hero_steps', 'hero_steps_shortcode');