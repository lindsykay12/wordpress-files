<?php
/**
 * @package Temptation
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("row archive"); ?>>
	<header class="entry-header col-md-12">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php temptation_posted_on(); ?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"> <?php comments_popup_link(__( '<i class="fa fa-comment"> </i> Leave a comment', 'coller' ), __( '<i class="fa fa-comment"> </i> 1 Comment', 'coller' ), __( '<i class="fa fa-comments"> </i> % Comments', 'coller' ) ); ?></span>
		<?php endif; ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="article-rest col-md-12">

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
	<?php if ( of_get_option('excerpt1', true) == 0 ) : ?>
		<?php the_content( __( 'Contine reading <span class="meta-nav">&rarr;</span>', 'temptation' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages: ', 'temptation' ),
				'after'  => '</div>',
			) );
		else :
			the_excerpt();
		endif;		
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>
	</div>
</article><!-- #post-## -->