<?php   global $woocommerce; ?>
<div class="opal-topcart pull-right">
 <div id="cart" class="dropdown version-1 box-top">
        <a class="dropdown-toggle mini-cart box-wrap" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="#" title="<?php esc_html_e('View your shopping cart', 'berrykid'); ?>">
            <span class="icon-cart">
                
            </span>
            <span class="box-title total">
                <span class="title-cart">
                   <?php esc_html_e('SHOPPING BAG','berrykid'); ?>
                </span>
                <span><?php echo sprintf(_n(' <span class="mini-cart-items"> %d item</span> ', ' <span class="mini-cart-items"> %d item </span> ', $woocommerce->cart->cart_contents_count, 'berrykid'), $woocommerce->cart->cart_contents_count);?> <?php echo trim( $woocommerce->cart->get_cart_total() ); ?></span>
            </span>
        </a>            
        <div class="dropdown-menu"><div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div></div>
    </div>
</div> 
