<?php

function berrykid_fnc_import_remote_demos() { 
	return array(
		'berrykid' => array( 
			'name' 		=> 'berrykid', 
		 	'source'	=> esc_url('http://wpsampledemo.com/berrykid/berrykid.zip'),
		 	'preview'   => esc_url('http://wpsampledemo.com/berrykid/preview.jpg')
		),
	);
}

add_filter( 'wpopal_themer_import_remote_demos', 'berrykid_fnc_import_remote_demos' );



function berrykid_fnc_import_theme() {
	return 'berrykid';
}
add_filter( 'wpopal_themer_import_theme', 'berrykid_fnc_import_theme' );

function berrykid_fnc_import_demos() {
	$folderes = glob( get_template_directory() .'/inc/import/*', GLOB_ONLYDIR ); 

	$output = array(); 

	foreach( $folderes as $folder ){
		$output[basename( $folder )] = basename( $folder );
	}
 	
 	return $output;
}
add_filter( 'wpopal_themer_import_demos', 'berrykid_fnc_import_demos' );

function berrykid_fnc_import_types() {
	return array(
			'all'          => esc_html__( 'All' , 'berrykid' ),
			'content'      =>  esc_html__( 'Content', 'berrykid' ),
			'widgets'      => esc_html__( 'Widgets', 'berrykid' ) ,
			'page_options' => esc_html__( 'Theme + Page Options', 'berrykid' ) ,
			'menus'        => esc_html__( 'Menus', 'berrykid' ),
			'rev_slider'   => esc_html__( 'Revolution Slider', 'berrykid' ),
			'vc_templates' => esc_html__( 'VC Templates', 'berrykid' )
		);
}
add_filter( 'wpopal_themer_import_types', 'berrykid_fnc_import_types' );

/**
 * Matching and resizing images with url.
 *
 *  $ouput = array(
 *        'allowed' => 1, // allow resize images via using GD Lib php to generate image
 *        'height'  => 900,
 *        'width'   => 800,
 *        'file_name' => 'blog_demo.jpg'
 *   ); 
 */
function berrykid_import_attachment_image_size( $url ){  

   $name = basename( $url );   
 
   $ouput = array(
         'allowed' => 0
   );     
   
   if( preg_match("#product#", $name) ) {
      $ouput = array(
         'allowed' => 1,
         'height'  => 600,
         'width'   => 600,
         'file_name' => 'product_demo.jpg'
      ); 
   }
   elseif( preg_match("#blog#", $name) ){
      $ouput = array(
         'allowed' => 1,
         'height'  => 593,
         'width'   => 890,
         'file_name' => 'blog_demo.jpg'
      ); 
   }
   return $ouput;
}

add_filter( 'pbrthemer_import_attachment_image_size', 'berrykid_import_attachment_image_size' , 1 , 999 );