<?php 
	$atts  = array_merge( array(
		'per_page'  => 8,
		'columns'	=> 4,
		'type'		=> 'recent_products',
		'category'	=> '',
		'woocategory' => '',
	), $atts); 
	extract( $atts );	
	if( empty($type) ){
		return ;
	}

	if($columns==5) $columns = 4;

	switch ($columns) {
        case '4':
            $class_column='col-sm-6 col-md-3';
            break;
        case '3':
            $class_column='col-sm-4';
            break;
        case '2':
            $class_column='col-sm-6';
            break;
        default:
            $class_column='col-sm-12';
            break;
    }

	if ( isset($woocategory) && !empty($woocategory) ){
		$categories = wpopal_themer_autocomplete_options_helper( $woocategory );
		$categories = 'category="'.implode( ',', array_keys($categories)).'"'; 
	}else {
		$categories = '';
	}

	$loop = wpopal_themer_woocommerce_query($type, $per_page, $categories);
	$style = ($style=='grid')? 'inner' : 'list';
	$_count = 0;

?>

 <div class="widget_products">
    <div class="row products-<?php echo esc_attr($style); ?>">
        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <div class="product-wrapper product <?php echo esc_attr( $class_column );?> <?php echo ($_count%$columns==0)? 'first' : ''; ?>">
                   <?php wc_get_template_part( 'content', 'product-'.$style ); ?>
                </div>
                <?php $_count++; ?>
    	<?php endwhile; ?>
    	<?php wp_reset_postdata(); ?>
    </div>
</div> 
