<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php echo bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="icon" type="image/png" href="<?php echo MBN_ASSETS_URI ?>/img/favicon.png"> -->
    <!-- <title><?php bloginfo('title') ?></title> -->

    <?php 
    wp_head();
    global $template;
     ?>


</head>
<body <?php body_class() ?>>

<div id="wrapper">       
    
        <header id="header" data-sticky-container data-toggler=".show-menu">
            <div class="hsnav-s5 sticky" data-sticky data-options="marginTop:0">
                <div class="navbar">
                    <div class="grid-container">
                        <a class="navlogo" href="#">
                            <figure class="logo-white"><img src="<?php echo MBN_ASSETS_URI ?>/img/logo-white.png" alt="" width="262" height="96"></figure>
                            <figure class="logo-colored"><img src="<?php echo MBN_ASSETS_URI ?>/img/logo-coloured.png" alt="" width="262" height="96"></figure>
                        </a>                
                        <nav class="navmenu">
                            <ul class="menu align-right dropdown" data-dropdown-menu>
                                <li class="nav-cta">
                                    <a href="#contact" class="button primary medium">
                                        <i class="far fa-calendar-alt"></i>
                                        <span class="show-for-large">Schedule Your Free Estimate!</span>
                                    </a>
                                </li>
                                <li class="navutil">
                                    <a href="tel:6024482899" class="button hollow clear">
                                        <i class="fas fa-phone-alt"></i>
                                        <span class="show-for-large">Call Now</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>            
        </header>
    <main id="content" class="content">