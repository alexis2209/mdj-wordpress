<?php
 /**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WpOpal Team <opalwordpress@gmail.com>
 * @copyright  Copyright (C) 2016 http://www.wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */

/**
 * Prestabrain Category Drop Down List Class
 * modified dropdown-pages from wp-includes/class-wp-customize-control.php
 *
 * @since Prestabrain v1.0
 */
function berrykid_fnc_cst_customizer($wp_customize){
	
	$wp_customize->add_section('pbr_cst_general_settings', array(
        'title'      => esc_html__('General Settings', 'berrykid'),
        'description'    => esc_html__('Website General Settings', 'berrykid'),
        'transport'  => 'postMessage',
        'priority'   => 10,
    ));

    if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
        //add custom config woocommerce product thumnail
        $wp_customize->add_setting( 'wpopal_theme_options[product-image-thumnail]', array(
                'capability' => 'edit_theme_options',
                'type'       => 'option',
                'default'   => '5',
                'sanitize_callback' => 'sanitize_text_field'
        ) );
        
        $wp_customize->add_control( 'wpopal_theme_options[product-image-thumnail]', array(
            'label'      => esc_html__( 'Product image thumnail', 'berrykid' ),
            'section'    => 'wc_product_settings',
            'type'       => 'select',
            'choices'     => array(
                '2' => esc_html__('2 Items', 'berrykid' ),
                '3' => esc_html__('3 Items', 'berrykid' ),
                '4' => esc_html__('4 Items', 'berrykid' ),
                '5' => esc_html__('5 Items', 'berrykid' ),
                '6' => esc_html__('6 Items', 'berrykid' )
            ),
            'priority' => 6
        ) );


         $wp_customize->add_setting('wpopal_theme_options[show_breadcrumb_woo]', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'   => 1,
            'checked' => 1,
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control('wpopal_theme_options[show_breadcrumb_woo]', array(
            'settings'  => 'wpopal_theme_options[show_breadcrumb_woo]',
            'label'     =>  esc_html__( 'Show Breadcrumb in woocommerce', 'berrykid' ),
            'section'   => 'wc_general_settings',
            'type'      => 'checkbox',
            'transport' => 4, 
            'priority' => 3
        ) );  

       
    }
}
add_action( 'customize_register', 'berrykid_fnc_cst_customizer' );

function berrykid_fnc_customize_register( $wp_customize ) {
    // Add postMessage support for site title and description.
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    // Rename the label to "Site Title Color" because this only affects the site title in this theme.
    $wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'berrykid' );

    // Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
    $wp_customize->get_control( 'display_header_text' )->label = esc_html__( 'Display Site Title &amp; Tagline', 'berrykid' );

    // Add custom description to Colors and Background controls or sections.
    if ( property_exists( $wp_customize->get_control( 'background_color' ), 'description' ) ) {
        $wp_customize->get_control( 'background_color' )->description = esc_html__( 'May only be visible on wide screens.', 'berrykid' );
        $wp_customize->get_control( 'background_image' )->description = esc_html__( 'May only be visible on wide screens.', 'berrykid' );
    } else {
        $wp_customize->get_section( 'colors' )->description           = esc_html__( 'Background may only be visible on wide screens.', 'berrykid' );
        $wp_customize->get_section( 'background_image' )->description = esc_html__( 'Background may only be visible on wide screens.', 'berrykid' );
    } 

    // // / // 
    $wp_customize->add_setting('theme_color', array( 
        'default'    => get_option('theme_color'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('theme_color', array( 
        'label'    => esc_html__('Theme Color', 'berrykid'),
        'section'  => 'colors',
        'type'      => 'color',
    ) ); 


    $wp_customize->add_setting('fixedhead_bg', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 0,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('fixedhead_bg', array(
        'settings'  => 'fixedhead_bg',
        'label'     =>  esc_html__( 'Keep Header Background', 'berrykid' ),
        'section'   => 'ts_general_settings',
        'type'      => 'color',
        'transport' => 4,
    ) );

       
}

add_action( 'customize_register', 'berrykid_fnc_customize_register' ,100);