<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<div id="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="article">
				<!-- <div id="date"><?php the_time('l, F jS, Y') ?></div> -->
				<br style="clear:both">
				<?php if (postimage()!== false){?><div class="alignleft"><?php echo postimage('thumbnail', 'image'); ?></div><?php }?><h1 class="textcolor_<?php echo $categoryparent?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<br style="clear:both">
				<div id="body">
					<?php the_content(); ?>
				<!-- <div class="dottedline">&nbsp;</div> -->
			</div>
		</div>
		<?php endwhile; endif; ?>
	</div>

<?php get_sidebar('archive'); ?>

<?php get_footer(); ?>
