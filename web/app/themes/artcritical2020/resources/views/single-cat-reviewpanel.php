<?php
get_header();

?>
	<div id="main">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php
			$thepostid = $post->ID;
			$category = get_the_category(); 
			$categoryparent = "reviewpanel";
			?>
			<span class="futura"><a href="http://artcritical.com/category/departments/the-review-panel"><?php echo $category[0]->name?></a></span>
			<hr class="color_<?php echo $categoryparent?>">
			<div id="article">
				<div id="date"><?php the_time('l, F jS, Y') ?></div>
				<div id="tools">
						<span class='st_facebook_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_twitter_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_email_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_plusone_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='print'><a href="#" onclick="window.print();return false;">print</a> </span>
					
						<?php if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) { ADDTOANY_SHARE_SAVE_KIT(); } ?><span style="margin-top:3px"><?php if(function_exists('wp_print')) { print_link(); } ?></span></div>
				<div id="share"></div>
				<br style="clear:both">
				<h1 class="textcolor_<?php echo $categoryparent?>"><?php the_title(); ?></h1>
				<div id="date" style="padding-bottom:15px"><strong>by <?php the_author_posts_link(); ?></strong></div>
				<br style="clear:both">
				<div id="body">
					<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
				<div class="dottedline">&nbsp;</div>
			</div>
		</div>
		<?php comments_template(); ?>
		</div>
		<?php endwhile; else: ?>

			<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>
		<!-- sidebar -->
		<?php get_sidebar('reviewpanel'); ?>
		<br style="clear:both">
		<!-- footer -->
		<?php get_footer(); ?>
<?php die();?>