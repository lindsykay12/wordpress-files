<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Temptation
 */

get_header('home'); ?>
	
	<?php get_template_part('showcase'); ?>

	<div id="primary-home" class="content-area col-md-9">
	
	<div id="primary-title"><?php
		if (of_get_option('hp-post-title')) {
			echo of_get_option('hp-post-title');
		}
		else {
			_e('Latest Articles','temptation'); 
		}
		?></div>
	
		<main id="masonry" class="site-main col-md-12" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					get_template_part( 'content', 'gridt' );
				?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
		
		<?php temptation_pagination(); ?>
		
	</div><!-- #primary -->

<?php get_sidebar('home'); ?>
<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>