<?php
/**
 * @package Temptation
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">	
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'temptation' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-meta">
			<?php temptation_posted_on(); ?>
	</div><!-- .entry-meta -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'temptation' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'temptation' ) );

			if ( ! temptation_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( '<span class="single-tags"> <i class="fa fa-tags"> </i> %2$s <span class="single-tags">', 'temptation' );
				} else {
					$meta_text = __( '', 'temptation' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( '<i class="fa fa-folder-open"> </i> %1$s <span class="single-tags"> <i class="fa fa-tags"> </i> %2$s <span class="single-tags">', 'temptation' );
				} else {
					$meta_text = __( '<i class="fa fa-folder-open"> </i> %1$s', 'temptation' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list
			);
		?>

		<?php edit_post_link( __( 'Edit', 'temptation' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"> </i> ', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
