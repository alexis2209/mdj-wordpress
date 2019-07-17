<section id="opal-topbar" class="opal-topbar hidden-xs hidden-sm">
    <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <div class="hidden-xs hidden-sm">
                
                <?php 
                     // WPML - Custom Languages Menu
                    berrykid_fnc_wpml_language_buttons();
                ?>
                <?php if(has_nav_menu( 'topmenu' )): ?>
     
                <nav class="opal-topmenu" role="navigation">
                    <?php
                        $args = array(
                            'theme_location'  => 'topmenu',
                            'menu_class'      => 'opal-menu-top list-inline',
                            'fallback_cb'     => '',
                            'menu_id'         => 'main-topmenu'
                        );
                        wp_nav_menu($args);
                    ?>
                </nav>
       
                <?php endif; ?>
            </div>
        </div>  
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <ul class="list-style  pull-right">
                <li><?php do_action( "berrykid_template_header_right" ); ?></li>
                <?php if( !is_user_logged_in() ){ ?>
                    <?php
            do_action( 'opal-account-buttons' );
        ?>
                <?php }else{ ?>
                    <?php $current_user = wp_get_current_user(); ?>
                  <li>  <span class="hidden-xs"><?php esc_html_e('Welcome ','berrykid'); ?>
                  <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php echo esc_html( $current_user->display_name); ?> !</a>
                  </span></li>
                <?php } ?>
            </ul>
        </div>                                 
    </div>   
</section>