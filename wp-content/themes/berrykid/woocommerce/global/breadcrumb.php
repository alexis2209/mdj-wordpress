<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version       3.5.5
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( berrykid_fnc_theme_options('show_breadcrumb_woo', 1) ){	
	if ( ! empty( $breadcrumb ) ) {

		echo trim($wrap_before);

		echo '<h2>'.esc_html__('Shop Product', 'berrykid').'</h2>';

		$end = '' ;
		foreach ( $breadcrumb as $key => $crumb ) {

			echo trim($before);

			if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
				echo '<li><a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a></li>';
			} else {
				echo '<li>'.esc_html( $crumb[0] ).'</li>';
			}

			echo trim( $after );


			$end = esc_html( $crumb[0] );
		}


		echo trim($wrap_after);

	}
}
?>
