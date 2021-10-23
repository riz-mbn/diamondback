<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php echo bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="icon" type="image/png" href="<?php echo MBN_ASSETS_URI ?>/img/favicon.png"> -->
    <!-- <title><?php bloginfo('title') ?></title> -->

    <?php wp_head() ?>

</head>
<body <?php body_class() ?>>

<div id="wrapper"> 
    <header id="header" >

            <a class="logo" href="<?php echo get_home_url(); ?>">
                <img src="<?php echo MBN_ASSETS_URI ?>/img/logo.png" alt="">
            </a>
                
            <div class="menu">    
                <?php
                    wp_nav_menu( array( 
                        'theme_location' => 'main-menu',
                        'menu'       => '',
                        'container'  => '',
                        'items_wrap' => '<ul class="menu align-center dropdown" data-dropdown-menu>%3$s</ul>' 
                    ));
                ?>     
            </div>        
    </header>
    <main id="content" class="content">