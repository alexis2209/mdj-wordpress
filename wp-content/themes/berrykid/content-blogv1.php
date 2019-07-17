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
	<?php berrykid_fnc_post_thumbnail(); ?>

	<div class="bottom blogv1">
		<header class="entry-header">
			<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && berrykid_fnc_categorized_blog() ) : ?>
	<!-- 		<div class="cat-links-meta">
				<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'berrykid' ) ); ?></span>
			</div> -->
			<div class="entry-meta">
				<?php
					if ( 'post' == get_post_type() )
						berrykid_fnc_posted_on();

					if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
				?>
				<div class="comments-link"><?php comments_popup_link( esc_html__( 'Leave a comment', 'berrykid' ), esc_html__( '1 Comment', 'berrykid' ), esc_html__( '% Comments', 'berrykid' ) ); ?></div>
				<?php
					endif;

					edit_post_link( esc_html__( 'Edit', 'berrykid' ), '<div class="edit-link">', '</div>' );
				?>
			</div><!-- .entry-meta -->
			<?php
				endif;

				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				endif;
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				echo berrykid_fnc_excerpt( 20, '...' );
			?>
		</div><!-- .entry-content -->
	</div>
 
	<?php //the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
</article><!-- #post-## -->
