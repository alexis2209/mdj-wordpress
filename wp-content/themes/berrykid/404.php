<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WpOpal
 * @subpackage berrykid
 * @since berrykid 1.0
 */
/*
*Template Name: 404 Page
*/

get_header( apply_filters( 'berrykid_fnc_get_header_layout', null ) ); ?>
<div id="opal-breadscrumb" <?php echo isset($estyle) ? $estyle : ''; ?>>
  <?php do_action( 'berrykid_woo_template_main_before' ); ?>
</div>

<section id="main-container" class="<?php echo apply_filters('berrykid_template_main_container_class','container');?> inner clearfix notfound-page">
	<div class="row">
		<div id="main-content" class="main-content">
			<div id="primary" class="content-area">
				 <div id="content" class="site-content" role="main">
				 	<div class="col-lg-6 col-md-6 col-sm-6 left-notfound text-right">
						<div class="title">
							<span>404</span>							
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 space-top-50">
						<span class="sub"><?php esc_html_e( 'Page Not Found !', 'berrykid' ); ?></span>
						<div class="error-description">
							<p><?php esc_html_e( 'We are sorry, but something went wrong', 'berrykid' ); ?></p>
						</div><!-- .page-content -->	
					</div>
					<div class="page-action col-lg-12 col-md-12 col-sm-12 text-center">
						<a class="btn btn-sm btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Return to homepage', 'berrykid'); ?></a>
					</div>
				</div><!-- #content -->
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
		</div><!-- #main-content -->

		 
		<?php get_sidebar(); ?>
	 
	</div>	
</section>
<?php

get_footer();

 