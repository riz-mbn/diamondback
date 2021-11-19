<?php

define('MBN_DIR_URI', get_template_directory_uri());
define('MBN_DIR_PATH', get_template_directory());
define('MBN_ASSETS_URI', MBN_DIR_URI.'/resources');
define('MBN_MAP_API_KEY',"AIzaSyDac2mOtJr_IktjUhiLZYRL_xHzxRbodRE");

/**
 * Theme setup
**/
function mbn_theme_setup(){

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style('editor.css');
    
    // add_theme_support( 'woocommerce');
    // show_admin_bar(false);
    // set_post_thumbnail_size(1568, 9999);
    // add_image_size('small-thumbnail', '150', '100');

    // add_theme_support('custom-logo',array(
    //     'height'      => 190,
    //     'width'       => 190,
    //     'flex-width'  => false,
    //     'flex-height' => false
    // ));

    // add_theme_support('customize-selective-refresh-widgets');
    // add_theme_support('wp-block-styles');
    

    register_nav_menus(array(
        'main-menu'   => 'Main Menu',
    ));

}
add_action('after_setup_theme', 'mbn_theme_setup');


/**
 * Enqeueue stylesheets and scripts
**/
function mbn_enqueue_scripts(){
    global $wp_version;
    global $template;

    // Global CSS
    wp_enqueue_style('mbn-style', get_stylesheet_uri());

    // unneccessary scripts
    wp_deregister_script('wp-embed');
    wp_deregister_style('wp-block-library');


    // dummy handler - for using inline-css
    wp_register_style('inlinecss-handle', false);
    wp_enqueue_style('inlinecss-handle');

    //fonts
    wp_enqueue_style_deferred('font-poppins', 'https://fonts.googleapis.com/css?family=Poppins:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap', [], $wp_version, 'all');
    
    //fontawesome    
    // wp_enqueue_style_deferred(
    //     'font-awesome',
    //     "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css", [], $wp_version,'all'
    // );


	//Global JS
	wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', MBN_ASSETS_URI.'/vendor/jquery-3.4.1.min.js', [], $wp_version,'all');
    //wp_enqueue_style_deferred( 'jquery' );

    wp_deregister_script( 'jquery-migrate' );
    wp_enqueue_script_special( 'jquery-migrate', MBN_ASSETS_URI.'/vendor/jquery-migrate-3.min.js', [], $wp_version,'all','defer');
    //wp_enqueue_style_deferred( 'jquery-migrate' );
    

    // Foundation JS
    //wp_enqueue_script_special('foundation', MBN_ASSETS_URI.'/vendor/foundation/js/foundation.min.js', [], $wp_version,'all','defer');

    // slick
    // wp_enqueue_style('slick', MBN_ASSETS_URI.'/vendor/slick/slick.css', [], $wp_version);
    // wp_enqueue_script('slick', MBN_ASSETS_URI.'/vendor/slick/slick.min.js', [], $wp_version);

    // Nicescroll
    // wp_enqueue_script('nicescroll', MBN_ASSETS_URI.'/vendor/jquery.nicescroll.min.js', [], $wp_version);

    // Fancybox
    //wp_enqueue_style('fancybox', MBN_ASSETS_URI.'/vendor/fancybox/jquery.fancybox.min.css', [], $wp_version);
    //wp_enqueue_script('fancybox', MBN_ASSETS_URI.'/vendor/fancybox/jquery.fancybox.min.js', [], $wp_version);

    
    // App
    wp_enqueue_style_deferred('app', MBN_ASSETS_URI.'/css/app.css', [], '1.4.5','all');
    wp_enqueue_script_special('app', MBN_ASSETS_URI.'/js/app.js', [], '1.2.0', true,'defer');
    

    // localize objects
    wp_localize_script('app', 'main_obj', array(
        'ajax_url'  => admin_url('admin-ajax.php'),
        'home_url'  => home_url(),
        'theme_url' => MBN_DIR_URI,
        'nonce'     => wp_create_nonce('mbn-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'mbn_enqueue_scripts', 20);


// remove wp emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');


/**
 * Register sidebars
**/
function mbn_register_sidebars(){
    // footer menus
    for($i=1;$i<=5;$i++){
        register_sidebar(array(
            'name'          => __('Footer Column '.$i),
            'id'            => 'footer-col-'.$i,
            'before_widget' => false,
            'after_widget'  => false,
            'before_title'  => false,
            'after_title'   => false,
        ));
    }
}
//add_action('widgets_init', 'mbn_register_sidebars');


/**
 * Allow SVG
**/
function mbn_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter('upload_mimes', 'mbn_myme_types');


require MBN_DIR_PATH."/mbn-login/setup.php";
require MBN_DIR_PATH.'/includes/post-types.php';
require MBN_DIR_PATH.'/includes/shortcodes.php';
require MBN_DIR_PATH.'/includes/public-hooks.php';
require MBN_DIR_PATH.'/includes/admin-hooks.php';
include_once(MBN_DIR_PATH . '/includes/custom-image-module.php');

/**
 * Reusable loaders
 */
$specialLoadHnds = (object) array(
    'scripts' => (object) array(
        'async' => array(),
        'defer' => array()
    ),
    'styles' => (object) array(
        'async' => array(),
        'asyncPreload' => array()
    )
);
// Same signature as wp_enqueue_style, + $loadMethod as last arg
function wp_enqueue_style_special($handle, $srcString, $depArray, $version, $media, $loadMethod){
    global $specialLoadHnds;
    array_push($specialLoadHnds->styles->{$loadMethod},$handle);
    wp_enqueue_style($handle, $srcString, $depArray, $version, $media);
}
// Same signature as wp_enqueue_script, + $loadMethod as last arg
// Reminder - $inFooter should probably be false for both async and defer
function wp_enqueue_script_special($handle, $srcString, $depArray, $version, $inFooter, $loadMethod){
    global $specialLoadHnds;
    array_push($specialLoadHnds->scripts->{$loadMethod},$handle);
    wp_enqueue_script($handle, $srcString, $depArray, $version, $inFooter);
}
// Identical signature to wp_enqueue_style
function wp_enqueue_style_deferred($handle, $srcString, $depArray, $version, $media){
    wp_enqueue_style_special($handle, $srcString, $depArray, $version, $media, 'async');
}

/**
 * Custom Script and Style Enqueued stuff
 */
/**
 * Callback for WP to hit before echoing out an enqueued resource
 * @param {string} $tag - Will be the full string of the tag (`<link>` or `<script>`)
 * @param {string} $handle - The handle that was specified for the resource when enqueuing it
 * @param {string} $src - the URI of the resource
 * @param {string|null} $media - if resources is style, should be the target media, else null
 * @param {boolean} $isStyle - If the resource is a stylesheet
 */
function scriptAndStyleTagCallback($tag, $handle, $src, $media, $isStyle){
    global $specialLoadHnds;
    $finalTag = $tag;
    if ($isStyle){
        // Async loading via invalid mediaquery switching
        if (in_array($handle, $specialLoadHnds->styles->async, true)){
            // Do not touch if already modified
            if (!preg_match('/\sonload=|\smedia=["\']none["\']/',$tag)){
                // Lazy load with JS, but also but noscript in case no JS
                $noScriptStr = '<noscript>' . $tag . '</noscript>';
                // Add onload and media="none" attr, and put together with noscript
                $matches = array();
                preg_match('/(<link[^>]+)>/',$tag,$matches);
                $finalTag = preg_replace('/\/$/','',$matches[1],1) . ' media="none" onload="if(media!=\'all\')media=\'all\'"' . ' />' . $noScriptStr;
            }
        }
        // Async loading via preload and loadCSS - https://github.com/filamentgroup/loadCSS/
        else if (in_array($handle, $specialLoadHnds->styles->asyncPreload, true)){
            // Do not touch if already modified
            if (!preg_match('/\srel=["\']preload|\sonload=["\']/',$tag)){
                // Lazy load with JS, but also but noscript in case no JS
                $noScriptStr = '<noscript>' . $tag . '</noscript>';
                // Strip rel="" & as="" portion, if exist
                $tag = preg_replace('/\srel=["\'][^"\']*["\']|\sas=["\'][^"\']*["\']/', '', $tag, -1);
                // Add onload, rel="preload", as="style", and put together with noscript
                $matches = array();
                preg_match('/(<link[^>]+)>/',$tag,$matches);
                $finalTag = preg_replace('/\/$/','',$matches[1],1) . ' rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"' . ' />' . $noScriptStr;
            }
        }
    }
    else {
        // Async
        if (in_array($handle, $specialLoadHnds->scripts->async, true)){
            // Do not touch if already modified, or missing src attr
            if (!preg_match('/\sasync/', $tag) && preg_match('/src=/', $tag)){
                // Add async attr
                $matches = array();
                preg_match('/(<script[^>]+)>/',$tag,$matches);
                $finalTag = $matches[1] . ' async="true"' . '></script>';
            }
        }
        // Defer
        else if (in_array($handle, $specialLoadHnds->scripts->defer, true)){
            // Do not touch if already modified, or missing src attr
            if (!preg_match('/\sdefer/', $tag) && preg_match('/src=/', $tag)){
                // Add defer attr
                $matches = array();
                preg_match('/(<script[^>]+)>/',$tag,$matches);
                $finalTag = $matches[1] . ' defer' . '></script>';
            }
        }
    }
    return $finalTag;
}
// BE CAREFUL OF PRIORITY
add_filter('script_loader_tag',function($tag, $handle, $src){
    return scriptAndStyleTagCallback($tag, $handle, $src, null, false);
},10,4);
add_filter('style_loader_tag',function($tag, $handle, $src, $media){
    return scriptAndStyleTagCallback($tag, $handle, $src, $media, true);
},10,4);