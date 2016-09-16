<?php
/**
 * @package Temptation
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("row archive col-md-6 col-sm-6 homepage-article gridt"); ?>>	
	<div class="featured-thumb col-md-12 col-xs-12">
	<div class="gridt-meta">
		<div class="gridt-date"><?php the_time('M j, Y'); ?></div>
		<div class="meta-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></div>		
	</div>
	<a href="<?php the_permalink(); ?>">
	<?php if (has_post_thumbnail()) :
		the_post_thumbnail('gridt-thumb');
		else: ?>
	      <img height="275" src="<?php echo get_template_directory_uri() ?>/images/gtthumb.jpg">
	<?php				
	endif; 
	?>
	</a>
	</div>
</article><!-- #post-## -->