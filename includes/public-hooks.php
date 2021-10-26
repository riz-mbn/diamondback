<?php

/**
 * Add custom body class
**/
function mbn_body_class($classes){
    // code here ...

    return $classes;
}
add_filter('body_class', 'mbn_body_class');



/*
** Submenu Classes
*/
function mbn_submenu_classes($classes, $args){
    // code here ...
    
    return $classes;
}
//add_filter('wp_nav_menu_items', 'mbn_submenu_classes', 10, 2);

add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    return "<button class='button primary large gform_button' id='gform_submit_button_{$form['id']}'>{$form['button']['text']}</button>";
}

