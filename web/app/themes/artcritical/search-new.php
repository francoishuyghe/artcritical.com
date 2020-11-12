<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Shape
 * @since Shape 1.0
 */

get_header(); ?>

        <div id="main">
        
        
		<?php 
        
        
			//               BY ARTICLE
            
            
            if (have_posts()) :  ?>
            <?php
            $counter = 0;
            while (have_posts()) : the_post(); ?>
            <?php
				if($counter == 0){
					echo '<span class="futura">Articles matching '.get_search_query().'</span>
					<hr class="color_">';
				}
				?>
				
			<?php
		$title  = get_the_title();
		$keys= explode(" ",$s);
		$title  = preg_replace('/('.implode('|', $keys) .')/iu',
			'<strong class="search-excerpt">\0</strong>',
			 $title);
			?>
				<div class="article">
					
					<div id="date"><?php the_time('l, F jS, Y') ?></div>
					<br style="clear:both">
					<h1 class="textcolor_<?php echo $categoryparent?>"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h1>
					<div id="date" style="padding-bottom:15px"><strong>by <?php the_author_posts_link(); ?> </strong></div>
					<br style="clear:both">
					<div id="body">
						<?php the_excerpt(); ?>
					<!-- <div class="dottedline">&nbsp;</div> -->
				</div>
			</div>
		<?php
				$counter++;
			
		endwhile;
		?>
		

		<?php if(function_exists('wp_paginate')) {
		    wp_paginate();
		} ?>
		<br>
	<?php else : ?>

		<h2 class="center">No posts found. Try a different search?</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar('archive'); ?>

<?php get_footer(); ?>