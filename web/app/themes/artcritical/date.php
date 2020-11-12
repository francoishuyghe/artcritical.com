<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>
	<div id="main">
		<?php if (have_posts()) : ?>
 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<span class="futura">Posts from <?php the_time('F, Y'); ?></span>
		<hr class="color_<?php echo $categoryparent?>">
		<?php while (have_posts()) : the_post(); ?>
			<div class="article">
				<!-- <div id="date"><?php the_time('l, F jS, Y') ?></div> -->
				<br style="clear:both">
				<h1 class="textcolor_<?php echo $categoryparent?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<div id="date" style="padding-bottom:15px"><strong>by <?php the_author_posts_link(); ?> </strong></div>
				<br style="clear:both">
				<div id="body">
					<?php the_excerpt(); ?>
				<!-- <div class="dottedline">&nbsp;</div> -->
			</div>
		</div>
		<?php endwhile; ?>

		<?php if(function_exists('wp_paginate')) {
		    wp_paginate();
		} ?>
		
	<?php else :
		echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		get_search_form();
	endif;
?>

	</div>

<?php get_sidebar('archive'); ?>

<?php get_footer(); ?>
