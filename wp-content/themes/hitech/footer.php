<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>
<footer id="footer">
				<div class="footerTop">
					<div class="wrapper">
						<div class="rw">
							<div class="colm item_left">
								<ul class="footerNav">
									<?php wp_nav_menu( array(
									'menu' => 'Header Menu'
								) ); ?>
								</ul>
							</div>
							<div class="colm item_bottom">
								<div class="footerAddress">
									<img src="<?php echo bloginfo('template_url'); ?>/assets/images/location-icon.png" alt=""/>
									<p><?php echo get_option( 'caddress' ); ?></p>
								</div>
							</div>
							<div class="colm item_right">
								<div class="followUs">
									<h3>Follow Us<h3>
									<div class="socialLinks">
										<a href="<?php echo get_option( 'fblink' ); ?>"><i class="fa fa-facebook-f"></i></a>
										<a href="<?php echo get_option( 'tlink' ); ?>"><i class="fa fa-twitter"></i></a>
										<a href="<?php echo get_option( 'glink' ); ?>"><i class="fa fa-google-plus"></i></a>
										<a href="<?php echo get_option( 'inlink' ); ?>"><i class="fa fa-linkedin"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="copyright item_bottom">
					<div class="wrapper">
						<?php echo get_option( 'copyright' ); ?>
					</div>
				</div>
			</footer>
		</div>
		
		<script src="<?php echo bloginfo('template_url'); ?>/assets/js/jquery-1.11.1.min.js"></script>
		<script src="<?php echo bloginfo('template_url'); ?>/assets/js/jquery.appear.js"></script>
		<script src="<?php echo bloginfo('template_url'); ?>/assets/js/scripts.js"></script>
		<script src="<?php echo bloginfo('template_url'); ?>/assets/slider/jquery.flexslider.js"></script>
		<script>
			$(window).load(function(){
			  $('#slider').flexslider({
				animation: "slide",
				controlNav: false,
				directionNav: false,
				animationLoop: true,
				slideshow: true,
				animationSpeed: 1600,
				slideshowSpeed: 8000,
			  }); 			
			});
		</script>		
		<script src="<?php echo bloginfo('template_url'); ?>/assets/js/custom.js" type="text/javascript"></script>
<?php wp_footer(); ?>

</body>
</html>
