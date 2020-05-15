<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_url'); ?>/assets/slider/flexslider.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_url'); ?>/assets/css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_url'); ?>/assets/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_url'); ?>/assets/css/animations.css" />
<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_url'); ?>/assets/css/responsive.css" />
<?php wp_head(); ?>
</head>
	<body>		 
		<div class="pageContainer">
			<header id="header">
				<div class="headerTop item_fade_in">
					<div class="wrapper">
						<div class="topNo">
							<img src="<?php echo bloginfo('template_url'); ?>/assets/images/contact-icon.png" alt=""/> Call Us Now! <?php echo get_option( 'sitephone' ); ?> or <?php echo get_option( 'sitephonealt' ); ?>
						</div>
						<div class="topSocial">
							<a href="<?php echo get_option( 'fblink' ); ?>"><i class="fa fa-facebook-f"></i></a>
							<a href="<?php echo get_option( 'tlink' ); ?>"><i class="fa fa-twitter"></i></a>
							<a href="<?php echo get_option( 'glink' ); ?>"><i class="fa fa-google-plus"></i></a>
							<a href="<?php echo get_option( 'inlink' ); ?>"><i class="fa fa-linkedin"></i></a>
						</div>
						<div class="spacer"></div>
					</div>
				</div>
				<div class="headerBottom">
					<div class="wrapper">
						<div class="logo item_left">
							<a href="<?php echo site_url(); ?>">
								<img src="<?php echo bloginfo('template_url'); ?>/assets/images/logo.png" alt=""/>
							</a>
						</div>
						<div class="headerNav item_right">
							<?php wp_nav_menu( array(
									'menu' => 'Header Menu'
								) ); ?>
						</div>
						<div class="spacer"></div>
					</div>					
				</div>
			</header>
