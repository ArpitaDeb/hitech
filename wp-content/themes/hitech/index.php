<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="slider" class="flexslider">
				<ul class="slides">
					<?php 
						$args = array( 'post_type' => 'slider', 'posts_per_page' => 3 );
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
						$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
						?>
					<li>
						<img src="<?php echo $featured_img_url; ?>">
						<div class="bannerTxtBox">
							<h2><?php the_title(); ?></h2>
							<p><?php the_content(); ?></p>
						</div>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<section class="services">
				<h2 class="hide">&nbsp;</h2>
				<div class="wrapper">
					<h2 class="sec-tl item_bottom">Our Services</h2>
					<div class="servicesList item_zoom">
						<div class="rw">
						<?php 
						$args = array( 'post_type' => 'service', 'posts_per_page' => 3 );
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
						$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
						?>
							<div class="colm">
								<div class="serviceBox">
									<img src="<?php echo $featured_img_url; ?>" alt=""/>
									<h3><?php the_title(); ?></h3>
									<p><?php the_content(); ?></p>
								</div>
							</div>
						<?php endwhile; ?>	
						</div>
					</div>
				</div>
			</section>
			<section class="ourServices">
				<h2 class="hide">&nbsp;</h2>
				<div class="wrapper">
					<h2 class="sec-tl-2 item_bottom">we bring our services to <span>you!</span></h2>
					<span class="sm-tl item_bottom">with over +12 years of experience in the field, we are happy to provide you with our services and solutions! </span>
					<div class="ourServiceList">
						<div class="rw">
							<?php 
						$args = array( 'post_type' => 'service-box', 'posts_per_page' => 10 );
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
						$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
						?>
							<div class="colm">
								<div class="ourServiceBox item_zoom">
									<img src="<?php echo $featured_img_url; ?>" alt=""/>
									<span class="t"><?php the_title(); ?></span>
								</div>
							</div>
						<?php endwhile; ?>	
						</div>
					</div>
					<div class="buttonset align-center">
						<a href="javascript:void(0);" class="button button-xl text-uppercase item_zoom">Request a Uuote</a>
					</div>
				</div>
			</section>
			<section class="aboveFooter">
				<h2 class="hide">&nbsp;</h2>
				<div class="wrapper">
					<div class="rw">
					<?php
							$about_post_id = 45;
							$queried_post = get_post($about_post_id);
							//print_r($queried_post);
						?>
						<div class="colm item_left">
							<p><?php echo $queried_post->post_content; ?></p>
						</div>
						<div class="colm item_right">
							<div class="map">
								<img src="<?php echo bloginfo('template_url'); ?>/assets/images/map.png" class="map-image"/>
							</div>
						</div>
					</div>
				</div>
			</section>

<?php get_footer();
