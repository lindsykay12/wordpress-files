<?php if (of_get_option('showcase_enabled') != 0) { ?>
	<div id="showcase" class="row">
	<?php
			// WP_Query arguments
			$qa = array (
				'post_type'              => 'post',
				'posts_per_page'		 => 3,
				'offset'				 => 0,
				'ignore_sticky_posts'    => 1,
				'cat'				     => of_get_option('cat1')
	
			);
			
			// The Query
			$recent_articles = new WP_Query( $qa );
			if($recent_articles->have_posts()) : ?>
			<div class="showcase showcase-1 col-md-12 col-sm-12">
			<div class="sc-heading col-md-3 col-sm-12"><?php echo of_get_option('cat1_title') ?></div>
			<ul class="sc">
			<?php
				while($recent_articles->have_posts()) : 
				$recent_articles->the_post();
	         ?>
	         		 
			         <li class='sc-item col-md-3 col-sm-4'>
			         <?php if( has_post_thumbnail() ) : ?>
			         <div class='sc-thumb'><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('showcase-thumb'); ?></a></div>
			         <?php 
			         else :
			         ?>
			         <div class='sc-thumb'><a href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/nthumb.png"></a></div>
			         <?php
			         endif; ?>	
			         <div class='sc-title'><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
			         </li>      
			      
			<?php
			      endwhile;
			   else: 
			?>
			
			      Oops, there are no posts.
			
			<?php
			   endif;
			?>
			</ul>
			</div>
			
			<?php
			//Second Showcase
	
			// WP_Query arguments
			$qa = array (
				'post_type'              => 'post',
				'posts_per_page'		 => 3,
				'offset'				 => 0,
				'ignore_sticky_posts'    => 1,
				'cat'				     => of_get_option('cat2')
	
			);
			
			// The Query
			$recent_articles = new WP_Query( $qa );
			if($recent_articles->have_posts()) : ?>
			<div class="showcase showcase-2 col-md-12 col-sm-12">
			<div class="sc-heading col-md-3 col-sm-12"><?php echo of_get_option('cat2_title')?></div>
			<ul class="sc">
			<?php
				while($recent_articles->have_posts()) : 
				$recent_articles->the_post();
	         ?>
	         		 
			         <li class='sc-item col-md-3 col-sm-4'>
			         <?php if( has_post_thumbnail() ) : ?>
			         <div class='sc-thumb'><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('showcase-thumb'); ?></a></div>
			         <?php 
			         else :
			         ?>
			         <div class='sc-thumb'><a href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/nthumb.png"></a></div>
			         <?php
			         endif; ?>	
			         <div class='sc-title'><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
			         </li>      
			      
			<?php
			      endwhile;
			   else: 
			?>
			
			      Oops, there are no posts.
			
			<?php
			   endif;
			?>
			</ul>
			</div>			
	
	</div><!--#showcase-->
<?php } ?>	