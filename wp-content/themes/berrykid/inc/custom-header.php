<?php
/**
 * Implement Custom Header functionality for berrykid
 *
 * @package WpOpal
 * @subpackage berrykid
 * @since berrykid 1.0
 */

/**
 * Set up the WordPress core custom header settings.
 *
 * @since berrykid 1.0
 *
 * @uses berrykid_fnc_header_style()
 * @uses berrykid_fnc_admin_header_style()
 * @uses berrykid_fnc_admin_header_image()
 */
function berrykid_fnc_custom_header_setup() {
	/**
	 * Filter berrykid custom-header support arguments.
	 *
	 * @since berrykid 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type bool   $header_text            Whether to display custom header text. Default false.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 1260.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 240.
	 *     @type bool   $flex_height            Whether to allow flexible-height header images. Default true.
	 *     @type string $admin_head_callback    Callback function used to style the image displayed in
	 *                                          the Appearance > Header screen.
	 *     @type string $admin_preview_callback Callback function used to create the custom header markup in
	 *                                          the Appearance > Header screen.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'berrykid_fnc_custom_header_args', array(
		'default-text-color'     => 'fff',
		'width'                  => 1260,
		'height'                 => 240,
		'flex-height'            => true,
		'wp-head-callback'       => 'berrykid_fnc_header_style',
		'admin-head-callback'    => 'berrykid_fnc_admin_header_style',
		'admin-preview-callback' => 'berrykid_fnc_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'berrykid_fnc_custom_header_setup' );

if ( ! function_exists( 'berrykid_fnc_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see berrykid_fnc_custom_header_setup().
 *
 */
function berrykid_fnc_header_style() {  
	$text_color = get_header_textcolor(); 

	// If no custom color for text is set, let's bail.
	

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="berrykid-header-css">
		<?php 
		$page_bg = get_option('page_bg');
		if( !empty($page_bg) && preg_match("#\##", $page_bg) ) :  ?>
		#page, #main > .container{
			background-color:<?php echo trim($page_bg); ?>;
		}
		<?php endif; ?>
		
		<?php 
		$footer_bg = get_option('footer_bg');
		if( !empty($footer_bg) && preg_match("#\##", $footer_bg) ) :  ?>
		#opal-footer {
			background-color:<?php echo trim($footer_bg); ?> ;
		}
		<?php endif; ?>
		<?php 
		$footer_color = get_option('footer_color');
		if( !empty($footer_color) && preg_match("#\##", $footer_color) ) :  ?>
		#opal-footer , #opal-footer a{
			color: <?php echo trim($footer_color); ?>
		}
		<?php endif; ?>
		<?php
		$footer_color = get_option('footer_heading_color');
		if( !empty($footer_color) && preg_match("#\##", $footer_color) ) :  ?>
		#opal-footer h2, #opal-footer h3, #opal-footer h4{
			color: <?php echo trim($footer_color); ?>
		}
		<?php endif; ?>
		<?php $topbar_bg = get_option('topbar_bg'); if( !empty($topbar_bg) && preg_match("#\##", $topbar_bg) ) :  ?>
		#opal-topbar, .site-header {
			background-color:<?php echo trim($topbar_bg); ?> ;
		}
		<?php endif; ?>
		<?php $topbar_color = get_option('topbar_color'); if( !empty($topbar_color) && preg_match("#\##", $topbar_color) ) :  ?>
		#opal-topbar , #opal-topbar a{
			color: <?php echo trim($topbar_color); ?>
		}
		<?php endif; ?>

		<?php  $fixedhead_bg = get_option( 'fixedhead_bg' ); if( !empty($fixedhead_bg) ):  ?>
			#opal-mainmenu.keeptop{ background-color: <?php echo trim($fixedhead_bg); ?> !important; }
		<?php endif; ?>

		<?php $theme_color = get_option('theme_color'); if( !empty($theme_color) && preg_match("#\##", $theme_color) ) :  ?>
		a:hover, a:focus,.woocommerce a.add_to_cart_button:hover,
		.navbar-mega .navbar-nav > li .dropdown-menu li a:hover,		
		.feature-box .fbox-icon,
		.lists.list-primary li i,.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus,
		.testimonial-collection .testimonials-description:before,.opal-footer a:hover, .btn-link:hover, .btn-link:focus,
		.opal-breadscrumb .breadcrumb li:last-child,
		ul.product-categories li.current-cat > a, ul.product-categories li.current-cat-parent > a,
		.products-top-wrap .display-mode .btn.active, .navbar-mega .navbar-nav li.active > a, .product-block .price > *,
		.navbar-mega .navbar-nav li.active > a .caret:before,
		.button-action > div.add-cart a.button:hover i,
		.button-action > div.yith-wcwl-add-to-wishlist a.add_to_wishlist:hover i,
		.button-action > div.quick-view a.quickview:hover i,
		.navbar-mega .navbar-nav > li > a:hover .caret:before, .navbar-mega .navbar-nav > li > a:focus .caret:before,
		.navbar-mega .navbar-nav > li > a:hover, .navbar-mega .navbar-nav > li > a:focus,
		.button-action > div.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:hover i,
		.opal-category-subs ul li a:hover,
		.widget_archive a:before, .widget_recent_entries a:before, .widget_recent_comments a:first-child:before, .widget_layered_nav a:before, .widget_categories a:before,
		.searchform .opal-search .btn-search .fa,article .entry-title a:hover,
		.navbar-mega .navbar-nav li a:hover, .navbar-mega .navbar-nav li a:active, .navbar-mega .navbar-nav li a:focus,
		.products-list .product-block .price > *, .list .product-block .price > *
		{
			color: <?php echo trim($theme_color); ?>;
		}
		<?php endif; ?>
	
		 
		<?php $theme_color = get_option('theme_color'); if( !empty($theme_color) && preg_match("#\##", $theme_color) ) :  ?>
		.box-primary,.btn-primary, .blog-post .entry-category a,.pricing.pricing-v2.pricing-highlight .btn,
		.feature-box-nostyle > a, .feature-box-v1 .fbox-back, .single-product.woocommerce div.product form.cart .button,
		.sidebar .widget .widget-title:before, .sidebar .widget .widgettitle:before, .product-block:hover .caption,
		.kc_tabs.group > .ui-tabs > ul.ui-tabs-nav > li.ui-tabs-active a,
		.brands-collection .carousel-control,
		.kc_tabs.group > .ui-tabs > ul.ui-tabs-nav > li a:hover,
		.wc-tabs-wrapper > ul.wc-tabs > li.reviews_tab.active a, .wc-tabs-wrapper > ul.wc-tabs li.description_tab.active a, .wc-tabs-wrapper > ul.wc-tabs li.additional_information_tab.active a,
		.wc-tabs-wrapper > ul.wc-tabs > li.reviews_tab a:hover, .wc-tabs-wrapper > ul.wc-tabs li.description_tab a:hover, .wc-tabs-wrapper > ul.wc-tabs li.additional_information_tab a:hover,
		.product-info .product-topinfo .product-nav p a,
		.widget_tag_cloud .tagcloud > a:hover,.tag-links a
		{
			background-color: <?php echo trim($theme_color); ?> !important;
		}
		<?php endif; ?>
		 
		<?php $theme_color = get_option('theme_color'); if( !empty($theme_color) && preg_match("#\##", $theme_color) ) :  ?>
		.box-primary,.btn-primary, .blog-post .entry-category a,.pricing.pricing-v2.pricing-highlight .btn,
		.feature-box-nostyle > a, .feature-box-v1 .fbox-back, .single-product.woocommerce div.product form.cart .button,
		.sidebar .widget .widget-title:before, .sidebar .widget .widgettitle:before{
			border-color: <?php echo trim($theme_color); ?> !important;
		}
		<?php endif; ?>

	</style>

	<?php if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
		return; ?>
	<?php
}
endif; // berrykid_fnc_header_style


if ( ! function_exists( 'berrykid_fnc_admin_header_style' ) ) :
/**
 * Style the header image displayed on the Appearance > Header screen.
 *
 * @see berrykid_fnc_custom_header_setup()
 *
 * @since berrykid 1.0
 */
function berrykid_fnc_admin_header_style() {  
?>
	<style type="text/css" id="berrykid-admin-header-css">
	.appearance_page_custom-header #headimg {
		background-color: #000;
		border: none;
		max-width: 1260px;
		min-height: 48px;
	}
	#headimg h1 {
		font-family: Lato, sans-serif;
		font-size: 18px;
		line-height: 48px;
		margin: 0 0 0 30px;
	}
	.rtl #headimg h1  {
		margin: 0 30px 0 0;
	}
	#headimg h1 a {
		color: #fff;
		text-decoration: none;
	}
	#headimg img {
		vertical-align: middle;
	}

<?php
}
endif; // berrykid_fnc_admin_header_style

if ( ! function_exists( 'berrykid_fnc_admin_header_image' ) ) :
/**
 * Create the custom header image markup displayed on the Appearance > Header screen.
 *
 * @see berrykid_fnc_custom_header_setup()
 *
 * @since berrykid 1.0
 */
function berrykid_fnc_admin_header_image() {
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
		<h1 class="displaying-header-text"><a id="name" style="<?php echo esc_attr( sprintf( 'color: #%s;', get_header_textcolor() ) ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>" tabindex="-1"><?php bloginfo( 'name' ); ?></a></h1>
	</div>
<?php
}
endif; // berrykid_fnc_admin_header_image