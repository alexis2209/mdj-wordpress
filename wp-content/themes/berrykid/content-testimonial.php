<?php
    $link = get_post_meta( get_the_ID(), 'testimonials_link', true );
    $job = get_post_meta( get_the_ID(), 'testimonials_job', true );
    $excerpt = explode(' ', strip_tags(get_the_content( )), 100);
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);

?>
<div class="testimonials">
    <div class="testimonials-body">                            
        <ul class="testimonials-avatar list-unstyled">
            <li class="active">
                 <div><?php the_post_thumbnail('widget');?></div>
            </li>                       
        </ul>   
        <p class="testimonials-description"><?php echo get_the_content(); ?></p>                     
        <h3 class="testimonials-name">
            <?php the_title(); ?>
        </h3>  
        <p class="text-muted testimonials-position">
            <a href="<?php echo empty($link) ? '#' : esc_url( $link ); ?>">
                <?php echo empty($job) ? '' : trim( $job ); ?>
            </a>
        </p>  
    </div>                      
</div>