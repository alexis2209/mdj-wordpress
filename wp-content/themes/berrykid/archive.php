<?php
/**
 * The template for displaying Category pages
 *
 * @link http://www.wpopal.com/theme/berrykid/
 *
 * @package WpOpal
 * @subpackage berrykid
 * @since berrykid 1.0
 */

$berrykid_page_layouts = apply_filters( 'berrykid_fnc_get_archive_sidebar_configs', null );

get_header( apply_filters( 'berrykid_fnc_get_header_layout', null ) ); ?>
<?php do_action( 'berrykid_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters('berrykid_template_main_container_class','container');?> inner <?php echo berrykid_fnc_theme_options('blog-archive-layout') ; ?>">
	<div class="row">

		<?php if( isset($berrykid_page_layouts['sidebars']) && !empty($berrykid_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
		
		<div id="main-content" class="main-content  col-sm-12 <?php echo esc_attr($berrykid_page_layouts['main']['class']); ?>">
			<div id="primary" class="content-area">
			 <div id="content" class="site-content" role="main">

					<?php if ( have_posts() ) : ?>

						<header class="page-header">

							<h1 class="page-title">
								<?php
									if ( is_day() ) :
										printf( esc_html__( 'Daily Archives: %s', 'berrykid' ), get_the_date() );

									elseif ( is_month() ) :
										printf( esc_html__( 'Monthly Archives: %s', 'berrykid' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'berrykid' ) ) );

									elseif ( is_year() ) :
										printf( esc_html__( 'Yearly Archives: %s', 'berrykid' ), get_the_date( _x( 'Y', 'yearly archives date format', 'berrykid' ) ) );

									else :
										esc_html_e( 'Archives', 'berrykid' );

									endif;
								?>
							</h1>

							<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="archive-description">', '</div>' );
							?>

						</header><!-- .page-header -->

						<?php
								// Start the Loop.
								while ( have_posts() ) : the_post();

									/*
									 * Include the post format-specific template for the content. If you want to
									 * use this in a child theme, then include a file called called content-___.php
									 * (where ___ is the post format) and that will be used instead.
									 */
									get_template_part( 'content', get_post_format() );

								endwhile;
								// Previous/next page navigation.
								berrykid_fnc_paging_nav();

							else :
								// If no content, include the "No posts found" template.
								get_template_part( 'content', 'none' );

							endif;
						?>
					</div><!-- #content -->

				
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
		</div><!-- #main-content -->


 
	</div>	
</section>
<?php
get_footer();
 
