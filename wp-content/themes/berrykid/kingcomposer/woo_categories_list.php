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

 
extract( $atts );


if( $term_id && !empty($term_id) ){ 
    $terms = explode(',',$term_id); 

    // $term = get_term_by( 'slug', $term_id, 'product_cat' );
    // if( empty($term) ){ return ; }
    // $term_id = $term->term_id; 
    // $args = array(
    //           'taxonomy'     => 'product_cat',
    //           'child_of'     => 0,
    //           'number'       => $number,
    //         );
    // $sub_cats = get_categories( $args );
    // if( $image_cat && !empty( $image_cat ))
    //     $image = wp_get_attachment_image_src( $image_cat, 'postthumb-grid');
    // else {
    //     $thumbnail_id = get_woocommerce_term_meta( $term_id, 'thumbnail_id', true );
    //     $image = wp_get_attachment_image_src( $thumbnail_id, 'full');
    // }
    
?>
<?php if($terms):?>
    <div class="opal-category-subs woocommerce <?php echo (($el_class!='')?' '.esc_attr( $el_class ):''); ?>">
        <div class="inner nopadding">
            <?php if($style ==  'style1') { ?>
                <div class="category-filter-v1">
                    <div class="category-filter-content">
                        <?php
                        if( $terms && !empty($terms)) { ?>
                            <ul class="list-unstyled category-filter-list">
                                <?php
                                    foreach( $terms as $slug){
                                        $cat = get_term_by( 'slug', $slug, 'product_cat' );
                                        $cat_link = get_term_link( $cat->slug, 'product_cat');
                                        $cat_name = $cat->name ;// .' ('. $cat->count .')';
                                        $icon_id = absint( get_woocommerce_term_meta( $cat->term_id, 'icon_id', true ) );
                                            if ( $icon_id ) {
                                                $icon = wp_get_attachment_thumb_url( $icon_id );
                                            } else {
                                                $icon = wc_placeholder_img_src();
                                            }
                                    ?>
                                    <li class="category-filter-list-item">
                                        <img src="<?php echo esc_url( $icon ); ?>" alt="" width="60" height="60" />
                                        <a href="<?php echo esc_url( $cat_link ); ?>">
                                            <?php echo trim( $cat_name ); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>

            <?php } else { ?>
                <div class="category-filter-default">
                    <div class="category-filter-content">
                        <?php
                        if( $terms && !empty($terms)) { ?>
                            <ul class="list-unstyled category-filter-list">
                                <?php
                                    foreach( $terms as $slug){
                                        $cat = get_term_by( 'slug', $slug, 'product_cat' );
                                        $cat_link = get_term_link( $cat->slug, 'product_cat');
                                        $cat_name = $cat->name ;// .' ('. $cat->count .')';
                                        $icon_id = absint( get_woocommerce_term_meta( $cat->term_id, 'icon_id', true ) );
                                            if ( $icon_id ) {
                                                $icon = wp_get_attachment_thumb_url( $icon_id );
                                            } else {
                                                $icon = wc_placeholder_img_src();
                                            }
                                    ?>
                                    <li class="category-filter-list-item">
                                        <img src="<?php echo esc_url( $icon ); ?>" alt="" width="60" height="60" />
                                        <a href="<?php echo esc_url( $cat_link ); ?>">
                                            <?php echo trim( $cat_name ); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php endif; ?>
<?php } ?>    
