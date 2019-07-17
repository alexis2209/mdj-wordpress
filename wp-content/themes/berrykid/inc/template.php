<?php 
//////// Template HOOKS ////////////////////
/**
 * Remove javascript and css files not use
 */
if( is_admin() ){
	function berrykid_setup_admin_setting(){

		global $pagenow; 
		if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
			/**
			 *
			 */
			$pts = array( 'brands', 'footer', 'megamenu', 'testimonials', 'team' ,'portfolio');

			$options = array();	

			foreach( $pts as $key ){
				$options['enable_'.$key] = 'on'; 
			}
		
			update_option( 'wpopal_themer_posttype', $options );

			do_action( 'berrykid_setup_theme_actived' );
		}
	}
	add_action( 'init', 'berrykid_setup_admin_setting'  );
}

/**
 * Hoo to top bar layout
 */
function berrykid_fnc_topbar_layout(){
	$layout = berrykid_fnc_get_header_layout();
	get_template_part( 'page-templates/parts/topbar', $layout );
	get_template_part( 'page-templates/parts/topbar', 'mobile' );
}

add_action( 'berrykid_template_header_before', 'berrykid_fnc_topbar_layout' );

/**
 * Hook to select header layout for archive layout
 */
function berrykid_fnc_get_header_layout( $layout='' ){
	global $post; 

	$layout = $post && get_post_meta( $post->ID, 'berrykid_header_layout', 1 ) ? get_post_meta( $post->ID, 'berrykid_header_layout', 1 ) : berrykid_fnc_theme_options( 'headerlayout' );
	 
 	if( $layout ){
 		return trim( $layout );
 	}elseif ( $layout = berrykid_fnc_theme_options('header_skin','') ){
 		return trim( $layout );
 	}

	return $layout;
} 

add_filter( 'berrykid_fnc_get_header_layout', 'berrykid_fnc_get_header_layout' );

/**
 * Hook to select header layout for archive layout
 */
function berrykid_fnc_get_footer_profile( $profile='default' ){

	global $post; 

	$profile =  $post? get_post_meta( $post->ID, 'berrykid_footer_profile', 1 ):null ;

 	if ( $profile && $profile != 'global' ) {
 		return trim( $profile );
 	} elseif ( $profile = berrykid_fnc_theme_options('footer-style', $profile ) ) {
 		return trim( $profile );
 	}

	return $profile;
} 

add_filter( 'berrykid_fnc_get_footer_profile', 'berrykid_fnc_get_footer_profile' );


/**
 * Hook to show breadscrumbs
 */
function berrykid_fnc_render_breadcrumbs(){
	
	global $post;

	if( is_object($post) ){
		$disable = get_post_meta( $post->ID, 'berrykid_disable_breadscrumb', 1 );  
		if(  $disable || is_front_page() ){
			return true; 
		}
		$bgimage = get_post_meta( $post->ID, 'berrykid_image_breadscrumb', 1 );  
		$color 	 = get_post_meta( $post->ID, 'berrykid_color_breadscrumb', 1 );  
		$bgcolor = get_post_meta( $post->ID, 'berrykid_bgcolor_breadscrumb', 1 );  
		$style = array();

		if( $bgcolor  ){
			$style[] = 'background-color:'.$bgcolor;
		}

		if( $bgimage  ){ 
			$style[] = 'background-image:url(\''.wp_get_attachment_url($bgimage).'\')';
		}else{
			$bgimage = berrykid_fnc_theme_options( 'breadcrumb-bg' );
			$style[] =  $bgimage  ? 'background-image:url(\''.$bgimage.'\')' : "";
		}

		if( $color  ){ 
			$style[] = 'color:'.$color;
		}

		$estyle = !empty($style)? 'style="'.implode(";", $style).'"':"";
	} else {

		$bgimage = berrykid_fnc_theme_options( 'breadcrumb-bg' );
		if( !empty($bgimage)  ){ 
			$style[] = 'background-image:url(\''.$bgimage.'\')';
		}
		$estyle = !empty($style)? 'style="'.implode(";", $style).'"':"";
	}
	
	echo '<section id="opal-breadscrumb" class="opal-breadscrumb" '.$estyle.'><div class="container">';
			berrykid_fnc_breadcrumbs();
	echo '</div></section>';

}

add_action( 'berrykid_template_main_before', 'berrykid_fnc_render_breadcrumbs' ); 

 
/**
 * Main Container
 */

function berrykid_template_main_container_class( $class ){
	global $post; 
	global $berrykid_wpopconfig;

	if(is_object($post) && !empty($post)){
		$layoutcls = get_post_meta( $post->ID, 'jets_enable_fullwidth_layout', 1 );
		
		if( $layoutcls ) {
			$berrykid_wpopconfig['layout'] = 'fullwidth';
			return 'container-fluid';
		}
	}
	return $class;
}
add_filter( 'berrykid_template_main_container_class', 'berrykid_template_main_container_class', 1 , 1  );
add_filter( 'berrykid_template_main_content_class', 'berrykid_template_main_container_class', 1 , 1  );



/**
 * Get Configuration for Page Layout
 *
 */
function berrykid_fnc_get_page_sidebar_configs( $configs='' ){

	global $post; 

	$left  =  get_post_meta( $post->ID, 'berrykid_leftsidebar', 1 );
	$right =  get_post_meta( $post->ID, 'berrykid_rightsidebar', 1 );

	return berrykid_fnc_get_layout_configs( $left, $right );
}

add_filter( 'berrykid_fnc_get_page_sidebar_configs', 'berrykid_fnc_get_page_sidebar_configs', 1, 1 );


function berrykid_fnc_get_single_sidebar_configs( $configs='' ){

	global $post; 

	$left  =  get_post_meta( $post->ID, 'berrykid_leftsidebar', 1 );
	$right =  get_post_meta( $post->ID, 'berrykid_rightsidebar', 1 );

	if ( empty( $left ) ) {
		$left  =  berrykid_fnc_theme_options( 'blog-single-left-sidebar' ); 
	}

	if ( empty( $right ) ) {
		$right =  berrykid_fnc_theme_options( 'blog-single-right-sidebar' ); 
	}

	return berrykid_fnc_get_layout_configs( $left, $right );
}

add_filter( 'berrykid_fnc_get_single_sidebar_configs', 'berrykid_fnc_get_single_sidebar_configs', 1, 1 );

function berrykid_fnc_get_archive_sidebar_configs( $configs='' ){

	global $post; 


	$left  =  berrykid_fnc_theme_options( 'blog-archive-left-sidebar' ); 
	$right =  berrykid_fnc_theme_options( 'blog-archive-right-sidebar' ); 
 
	return berrykid_fnc_get_layout_configs( $left, $right );
}

add_filter( 'berrykid_fnc_get_archive_sidebar_configs', 'berrykid_fnc_get_archive_sidebar_configs', 1, 1 );
add_filter( 'berrykid_fnc_get_category_sidebar_configs', 'berrykid_fnc_get_archive_sidebar_configs', 1, 1 );

/**
 *
 */
function berrykid_fnc_get_layout_configs( $left, $right ){
	$configs = array();
	$configs['main'] = array( 'class' => 'col-lg-9 col-md-9' );

	$configs['sidebars'] = array( 
		'left'  => array( 'sidebar' => $left, 'active' => is_active_sidebar( $left ), 'class' => 'col-lg-3 col-md-3'  ),
		'right' => array( 'sidebar' => $right, 'active' => is_active_sidebar( $right ), 'class' => 'col-lg-3 col-md-3' ) 
	); 

	if( $left && $right ){
		$configs['main'] = array( 'class' => 'col-lg-6 col-md-6' );
	} elseif( empty($left) && empty($right) ){
		$configs['main'] = array( 'class' => 'col-lg-12 col-md-12' );
	}
	return $configs; 
}


function berrykid_fnc_sidebars_others_configs(){
	
	global $berrykid_page_layouts;
	
	return $berrykid_page_layouts; 
}

add_filter("berrykid_fnc_sidebars_others_configs", "berrykid_fnc_sidebars_others_configs");


/**
 * function to integrate with WPML which will display languages as buttons
 */

if( !function_exists("berrykid_fnc_wpml_language_buttons") ){
   function berrykid_fnc_wpml_language_buttons(){
     if( function_exists( 'icl_get_languages' ) ){
       $languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
       if( is_array( $languages ) ){
          
          foreach( $languages as $lang_k=>$lang ){
              if( $lang['active'] ){
                  $active_lang = $lang;
                  unset( $languages[$lang_k] );
              }
          }

          // disabled
          if( count( $languages ) ){
              $lang_status = 'enabled';
          } else {
              $lang_status = 'disabled';
          }
          
          echo '<div class="language wpml-languages quick-button '. $lang_status .'">';
          
              echo '<div class="heading active" href="'. esc_url( $active_lang['url'] ).'" ontouchstart="this.classList.toggle(\'hover\');">';
                  echo '<img src="'. esc_url( $active_lang['country_flag_url'] ) .'" alt="'. esc_attr( $active_lang['translated_name'] ) .'"/>';
                  echo esc_attr( $active_lang['translated_name'] );
                  if( count( $languages ) ) echo '<i class="icon-down-open-mini"></i>';
              echo '</div>';
              
              if( count( $languages ) ){
                  echo '<ul class="wpml-lang-dropdown list">';
                      foreach( $languages as $lang ){
                          echo '<li><a href="'. esc_url( $lang['url'] ) .'"><img src="'. esc_url( $lang['country_flag_url'] ) .'" alt="'. esc_attr( $lang['translated_name'] ) .'"/>'. esc_attr( $lang['translated_name'] ) .'</a></li>';
                      }
                  echo '</ul>';
              }
              
          echo '</div>';
        }
      } 
   }
}
 

/**
 * Footer builder profile is custom post type, its content is shortcode rendering with visual composer 
 *
 * @param $footer 
 * 
 */

function berrykid_fnc_get_footer_profile_postdata( $footer ){
  if( empty( $footer) || $footer == 'default' ){
    return ;
  }
  if( is_numeric($footer) ){
      $post = get_post( $footer );
  }else {
      $post =  get_posts( array( 
          'name' =>  $footer, 
          'numberposts' => 1,
          'post_type' => 'footer' ) );
       $post = count($post) && $post?$post[0] :null;
  }
  wp_reset_postdata();
  return $post; 
}

/**
 *
 */
function berrykid_display_footer_content(){
	$footer_profile =  apply_filters( 'berrykid_fnc_get_footer_profile', 'default' );
	 
	$footer_data = berrykid_fnc_get_footer_profile_postdata( $footer_profile ); 
	if( $footer_data &&  $footer_data->post_content && $footer_profile ): 
 	?>
	<div class="opal-footer-profile clearfix">
		<?php  echo do_shortcode( $footer_data->post_content ); ; ?>
	</div>
	<?php else: ?>
	<?php get_sidebar( 'footer' ); ?>
	<?php endif; ?>

<?php 
}

/**
 * create a random key to use as primary key.
 */
if(!function_exists('berrykid_fnc_makeid')){
    function berrykid_fnc_makeid($length = 5){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}



if(!function_exists('berrykid_fnc_excerpt')){
    //Custom Excerpt Function
    function berrykid_fnc_excerpt($limit,$afterlimit='[...]') {
        $excerpt = get_the_excerpt();
        if( $excerpt != ''){
           $excerpt = explode(' ', strip_tags( $excerpt ), $limit);
        }else{
            $excerpt = explode(' ', strip_tags(get_the_content( )), $limit);
        }
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).' '.$afterlimit;
        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return strip_shortcodes( $excerpt );
    }
}


function berrykid_fnc_get_widget_block_styles(){
   return array(  'default' , 'primary', 'danger' , 'success', 'warning', 'coffe', 'bluesky' );
}

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since berrykid 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function berrykid_fnc_body_classes( $classes ) {
	global $post;

	$additionclass = (is_object($post) ? get_post_meta( $post->ID, 'berrykid_additionclass', 1 ) : '');
	if ( !empty($additionclass) ) {
		$classes[] = $additionclass;
	}

	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} elseif ( ! in_array( $GLOBALS['pagenow'], array( 'wp-activate.php', 'wp-signup.php' ) ) ) {
		$classes[] = 'masthead-fixed';
	}

	 
	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	$currentSkin = str_replace( '.css','',berrykid_fnc_theme_options('skin','default') ); 
	
	if( $currentSkin ){
		$class[] = 'skin-'.$currentSkin;
	}

	return $classes;
}
add_filter( 'body_class', 'berrykid_fnc_body_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since berrykid 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function berrykid_fnc_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'berrykid' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'berrykid_fnc_wp_title', 10, 2 );

 
/**
 * upbootwp_breadcrumbs function.
 * Edit the standart breadcrumbs to fit the bootstrap style without producing more css
 * @access public
 * @return void
 */
function berrykid_fnc_breadcrumbs() {

	$delimiter = '';
	$_title = '';
	$breadcrumbs = '';
	$home = esc_html__('Home', 'berrykid');
	$before = '<li class="active">';
	$after = '</li>';

	if (!is_home() && !is_front_page() || is_paged()) {

		global $post;
		$homeLink = esc_url( home_url() );
		$breadcrumbs .= '<li><a href="' . ( $homeLink ) . '">' . $home . '</a> ' . $delimiter . '</li> ';

		if (is_category()) {

			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) $breadcrumbs .=(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			$breadcrumbs .= trim($before) . single_cat_title('', false) . $after;
			$_title = esc_html__('Blog', 'berrykid');

		} elseif (is_day()) {
			$breadcrumbs .= '<li><a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			$breadcrumbs .= '<li><a href="' . esc_url( get_month_link(get_the_time('Y'),get_the_time('m')) ) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
			$breadcrumbs .= trim($before) . get_the_time('d') . $after;
			$_title = esc_html__('Archive Blog', 'berrykid');

		} elseif (is_month()) {
			$breadcrumbs .= '<li><a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			$breadcrumbs .= trim($before) . get_the_time('F') . $after;
			$_title = esc_html__('Archive Blog', 'berrykid');

		} elseif (is_year()) {
			$breadcrumbs .= trim($before) . get_the_time('Y') . $after;
			$_title = esc_html__('Archive Blog', 'berrykid');

		} elseif (is_single() && !is_attachment()) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				if(is_object( $post_type)){
					$slug = $post_type->rewrite;
					$breadcrumbs .= '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
					$breadcrumbs .= trim($before) . get_the_title() . $after;
					$_title = get_post_type().esc_html__(' single ', 'berrykid');
				}
					
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$breadcrumbs .= '<li>'.get_category_parents($cat, TRUE, ' ' . $delimiter . ' ').'</li>';
				$breadcrumbs .= trim($before) . get_the_title() . $after;
				$_title = esc_html__('Blog single ', 'berrykid');
			}

		} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());
			if ( is_object($post_type) && isset($post_type->labels->singular_name) ) {
				$breadcrumbs .= trim($before) . $post_type->labels->singular_name . $after;
				$_title = get_post_type();
			}
		} elseif (is_attachment()) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$breadcrumbs .= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			$breadcrumbs .= '<li><a href="' . esc_url( get_permalink($parent) ) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
			$breadcrumbs .= trim($before) . get_the_title() . $after;
			$_title = get_the_title();

		} elseif ( is_page() && !$post->post_parent ) {
			$breadcrumbs .= trim($before) . get_the_title() . $after;
			$_title = get_the_title();

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$_breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$_breadcrumbs[] = '<li><a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a></li>';
				$parent_id  = $page->post_parent;
			}
			$_breadcrumbs = array_reverse($_breadcrumbs);
			foreach ($_breadcrumbs as $crumb) $breadcrumbs .= trim($crumb) . ' ' . $delimiter . ' ';
			$breadcrumbs .= trim($before) . get_the_title() . $after;
			$_title = get_the_title();

		} elseif ( is_search() ) {
			$breadcrumbs .= trim($before) . esc_html__('Search results for "', 'berrykid') . get_search_query() . '"' . $after;
			$_title = esc_html__('Search results', 'berrykid');

		} elseif ( is_tag() ) {
			$breadcrumbs .= trim($before) . esc_html__('Posts tagged "', 'berrykid') . single_tag_title('', false) . '"' . $after;
			$_title = esc_html__('Posts tagged', 'berrykid');

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			$breadcrumbs .= trim($before) . esc_html__('Articles posted by ', 'berrykid') . $userdata->display_name . $after;
			$_title = esc_html__('Articles posted', 'berrykid');

		} elseif ( is_404() ) {
			$breadcrumbs .= trim($before) . esc_html__('Error 404', 'berrykid') . $after;
			$_title = esc_html__('Error 404', 'berrykid');
		}

		echo '<ol class="breadcrumb">';
			echo '<h2>'.trim($_title).'</h2>';
			echo trim($breadcrumbs);
		echo '</ol>';
	}
}

function berrykid_display_footer_copyright(){
	$copyright_text =  berrykid_fnc_theme_options('copyright_text', '');
	if(!empty($copyright_text)){
		echo do_shortcode($copyright_text);
	}else{
		$devby = '<a target="_blank" href="'.esc_url('http://themelexus.com').'">LexusThemes Team</a>';
		printf( esc_html__( 'Proudly powered by %s. Developed by %s', 'berrykid' ), 'WordPress', trim($devby) );   
	}
}
 
if(!function_exists('berrykid_wpopal_categories_searchform')){
    function berrykid_fnc_categories_searchform(){
        if( class_exists('WooCommerce') ){
		global $wpdb;
			$dropdown_args = array(
			    'show_counts'        => false,
			    'hierarchical'       => true,
			    'show_uncategorized' => 0
			);
		?>
		<form method="get" class="input-group search-category" action="<?php echo esc_url( home_url('/') ); ?>">
		<input name="s" maxlength="60" class="form-control search-category-input" type="text" size="20" placeholder="<?php esc_html_e('Search...', 'berrykid'); ?>"> 

		<div class="input-group-btn radius-2x">
		    <label class="btn btn-link btn-search">
		      <span class="title-search hidden"><?php esc_html_e('Search', 'berrykid') ?></span>
		      <input type="submit" class="fa searchsubmit" value="&#xf002;"/>
		    </label>
		    <input type="hidden" name="post_type" value="product"/>
		</div>
		</form>
		<?php
		}else{
			get_search_form();
		}
    }
}