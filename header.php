<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beverage
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,600,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	 <?php if(is_front_page()) {
	 	$main = 'main-content';
	 	$layer = 'layer';
	 } else {
	 	$main = 'main-content-not-homepage';
	 	$layer = 'layer-not-homepage';
	 } 

	 if(has_post_thumbnail()){
	 	$style = get_the_post_thumbnail_url();
	 } else {
	 	$style = get_template_directory_uri() . '/assets/images/banner1.jpg';
	 }

     if (is_archive()) {
        $style = get_template_directory_uri() . '/assets/images/banner1.jpg';
     }

     ?>
<div id="page" class="site">
	<div class="<?php echo $main?>" id="home" style="background: url(<?php echo $style?>) no-repeat center center; background-size:cover;transition: ease 1s;">
        <div class="<?php echo $layer?>">
            <!-- header -->
            <header>
                <div class="container-fluid px-lg-5">
                    <!-- nav -->
                    <nav class="py-4 d-lg-flex">
                        <div id="logo">
                            <?php if(vp_option('b_option.c_logo') != null) :?>
                                <a href="<?php echo home_url('/') ?>"><img src="<?php echo vp_option('b_option.c_logo')?>"></a>
                            <?php else: ?>
                            <h1> <a href="<?php echo home_url('/') ?>"><span class="fa fa-align-center" aria-hidden="true"></span><?php echo bloginfo()?></a></h1>
                            <?php endif; ?>
                        </div>
                        <label for="drop" class="toggle">Menu</label>
                        <input type="checkbox" id="drop" />
                        <?php 
                        	wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'container'		 => 'ul',
								'menu_class'	 => 'menu mt-2 ml-auto'
							));
                        ?>
                        
                    </nav>
                    <!-- //nav -->
                </div>
            </header>
            <!-- //header -->
            <?php if(is_front_page()) : ?>
            <div class="container">
                <!-- /banner -->
                <div class="banner-info-w3layouts text-center">
                    <h3><?php echo vp_option('b_option.h_text')?></h3>
                    <div class="read-more">
                        <a href="#menu" class="read-more scroll">Lihat semua produk </a> </div>
                </div>
                <div class="row order-info">
                    <div class="middle mt-3 col-md-6 text-left">
                        <ul class="social mb-4">
                            <li><a href="<?php echo vp_option('b_option.facebook')?>"><span class="fa fa-facebook icon_facebook"></span></a></li>
                            <li><a href="<?php echo vp_option('b_option.twitter')?>"><span class="fa fa-twitter icon_twitter"></span></a></li>
                            <li><a href="<?php echo vp_option('b_option.instagram')?>"><span class="fa fa-instagram"></span></a></li>
                            <li><a href="mailto:<?php echo vp_option('b_option.email')?>"><span class="fa fa-envelope"></span></a></li>
                        </ul>

                    </div>
                    <div class="middle-right mt-md-3 col-md-6 text-right">
                        <h6><span class="fa fa-phone"></span> Pesan sekarang : <?php echo vp_option('b_option.contact')?></h6>
                    </div>
                </div>
            </div>
            <?php else :?>
            <div class="container">
                <!-- /banner -->
                <div class="banner-info text-center">
                    <?php if(is_archive()) :?>
                        <h3>Archive</h3>
                    <?php elseif(is_404()) :?>
                        <h3>404</h3>
                    <?php else :?> 
                        <h3><?php the_title(); ?></h3>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            <!-- //banner -->
        </div>
    </div>

	<div id="content" class="site-content container">
