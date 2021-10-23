<?php
function mbn_login_enqueue_scripts(){  
?>
<link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700" rel="stylesheet">
    <?php
    wp_enqueue_style( 'style-mbn-login', get_template_directory_uri()."/mbn-login/css/login.css" );
    wp_enqueue_script( 'script-mbn-login-jquery', get_template_directory_uri()."/mbn-login/js/jquery.js" );
    wp_enqueue_script( 'script-mbn-login-app', get_template_directory_uri()."/mbn-login/js/app.js" );
}

function mbn_login_footer(){
    ?>
    <?php if(!isset($_REQUEST['novideo'])):?>
    <video autoplay loop id="vb" muted plays-inline>
  <source src="<?php echo get_template_directory_uri()."/mbn-login/video/wp-login-bg.mp4";?>" type="video/mp4">
</video>
<?php endif;?>
<p id="backtoblog2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php

		printf( _x( 'Back to %s', 'site' ), get_bloginfo( 'title', 'display' ) );
    ?></a></p>
    <ul class="social-media-links">
        <li><a href="https://www.mybizniche.com" class="site" target="_blank"></a></li>
        <li><a href="https://www.facebook.com/mybizniche/" class="fb" target="_blank"></a></li>
        <li><a href="https://twitter.com/mybizniches" class="tw" target="_blank"></a></li>
        <li><a href="https://www.instagram.com/mybizniche/" class="ig" target="_blank"></a></li>
        <li><a href="https://www.pinterest.ph/mybizniche/" class="pn" target="_blank"></a></li>
        <li><a href="https://www.linkedin.com/company/my-biz-niche" class="in" target="_blank"></a></li>
       
    </ul>
    <p id="company_footer"><?php bloginfo("site_name")?> © <?php echo date("Y");?> | <a href="https://www.mybizniche.com" target="_blank">Website Designed</a> and Powered by:<span> My Biz Niche</span></p>
    <?php
}
add_action("login_footer","mbn_login_footer");
add_action("login_enqueue_scripts", "mbn_login_enqueue_scripts",99);
?>