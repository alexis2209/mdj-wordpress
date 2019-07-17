<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WpOpal
 * @subpackage berrykid
 * @since berrykid 1.0
 */
 

?>
		</section><!-- #main -->
		<?php do_action( 'berrykid_template_main_after' ); ?>
		<?php do_action( 'berrykid_template_footer_before' ); ?>
		<footer id="opal-footer" class="opal-footer" role="contentinfo">
			<div class="container">
				<div class="row">
					<?php echo berrykid_display_footer_content(); ?>
				</div>
			</div>

			<hr>
			<div class="container">
				<?php if ( is_active_sidebar( 'mass-footer-body' ) ):  ?>
					<?php get_sidebar( 'mass-footer-body' );  ?>
				<?php endif; ?>
			</div>

		

		</footer><!-- #colophon -->
		<section class="opal-copyright clearfix">
			<div class="container">
				<a href="#" class="scrollup"><span class="fa fa-angle-up"></span></a>
				<?php do_action( 'berrykid_fnc_credits' ); ?>
				<div class="copyright-link pull-right nav-menu"><?php dynamic_sidebar( 'copyright-link' ); ?></div>
				<div class="text-copyright">
					<?php 
						berrykid_display_footer_copyright();
					?>
				</div>
			</div>	
		</section>

		<?php do_action( 'berrykid_template_footer_after' ); ?>
			<?php get_sidebar( 'offcanvas' );  ?>
	</div>
</div>
	<!-- #page -->

<?php wp_footer(); ?>
</body>
</html>