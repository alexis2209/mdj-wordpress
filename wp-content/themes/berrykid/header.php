<?php
/**
 * The Header for our theme: Main Darker Background. Logo left + Main menu and Right sidebar. Below Category Search + Mini Shopping basket.
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WpOpal
 * @subpackage berrykid
 * @since berrykid 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site"><div class="opal-page-inner row-offcanvas row-offcanvas-left">
	<?php if ( get_header_image() ) : ?>
	<div id="site-header" class="hidden-xs hidden-sm">
		<a href="<?php echo esc_url( get_option('header_image_link','#') ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		</a>
	</div>
	<?php endif; ?>
	<?php get_template_part( 'page-templates/parts/topbar', 'mobile' ); ?>
	<header id="opal-masthead" class="site-header" role="banner">
	<div class="header-main">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-lg-4">
			 			<?php get_template_part( 'page-templates/parts/logo' ); ?>
					</div>
					<div class="col-md-4 col-lg-4 hidden-sm hidden-xs">
						<div class="search-box search-box-simple radius-2x">
							<?php berrykid_fnc_categories_searchform() ?>
						</div>
					</div>
					<div class="col-md-4 col-lg-4 setting hidden-sm hidden-xs">
		                <?php do_action( "berrykid_template_header_right" ); ?>
		                <div class="mini-account dropdown hidden-xs hidden-sm pull-right">
		                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0"><?php esc_html_e('My account','berrykid'); ?><i class="fa fa-sort-desc radius-x" aria-hidden="true"></i>
							</a>                                                               
		                    <ul class="pull-right dropdown-menu">

		                        <?php if( !is_user_logged_in() ){ ?>
		                            <?php do_action( 'opal-account-buttons' ); ?>
		                        <?php }else{ ?>
		                            <?php $current_user = wp_get_current_user(); ?>
		                          <li><span class="hidden-xs"><?php esc_html_e('Welcome ','berrykid'); ?><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php echo esc_html( $current_user->display_name); ?> !</a></span></li>
		                          <li></li>
		                          <li><a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><?php esc_html_e('Logout', 'berrykid'); ?></a></li>
		                        <?php } ?>

		                    </ul>
		                </div>
	                </div>
				</div>						
			</div>
		</div>
		<section id="opal-mainmenu" class="opal-mainmenu mainmenu-absolute <?php echo berrykid_fnc_theme_options('keepheader') ? 'has-sticky' : ''; ?>">	
			<div class="container">	
				<div class="inner navbar-mega-simple pull-left"><?php get_template_part( 'page-templates/parts/vertical' ); ?></div>					
				<div class="inner navbar-mega-simple pull-left"><?php get_template_part( 'page-templates/parts/nav' ); ?></div>	
			</div>									
		</section>
	</div>	
	</header><!-- #masthead -->	
		
	<?php do_action( 'berrykid_template_header_after' ); ?>
	
	<section id="main" class="site-main">
