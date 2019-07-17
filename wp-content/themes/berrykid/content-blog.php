<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WpOpal
 * @subpackage berrykid
 * @since berrykid 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="image-thumnail">
		<?php berrykid_fnc_post_thumbnail(); ?>
	</div>
	
	<div class="bottom-blog">
		<div class="title-post">
		<?php 
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		?>
		</div>

		<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				echo berrykid_fnc_excerpt( 10, '...' );
			?>
		</div><!-- .entry-content -->

		<div class="entry-date pull-left">
	        <span><?php the_time( 'd' ); ?></span>&nbsp;<?php the_time( 'M' ); ?>&nbsp;<?php the_time( 'Y' ); ?>
	    </div>
	</div>
	

	
 
	<?php //the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->
