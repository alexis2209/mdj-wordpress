<nav  data-duration="<?php echo berrykid_fnc_theme_options('megamenu-duration',400); ?>" class="hidden-xs hidden-sm opal-vertical-menu <?php echo berrykid_fnc_theme_options('magemenu-animation','slide'); ?> animate navbar navbar-mega" role="navigation">
        <h3 class="widget-title"></h3>
	    <?php
	        $args = array(  'theme_location' => 'secondary',
	                        'container_class' => 'collapse navbar-collapse navbar-mega-collapse vertical-menu menu-left',
	                        'menu_class' => 'nav navbar-nav megamenu',
	                        'fallback_cb' => '',
	                        'menu_id' => 'secondary'
	                    );

	        if( class_exists("Wpopal_bootstrap_navwalker") ){

	            $args['walker'] = new Wpopal_bootstrap_navwalker();
	        }
	        wp_nav_menu($args);
	    ?>
</nav>