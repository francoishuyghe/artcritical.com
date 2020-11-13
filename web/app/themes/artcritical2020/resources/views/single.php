<?php
if (in_category('p4a')) {
	include (TEMPLATEPATH . '/single-p4a.php');
}else if(in_category('the-review-panel')) {
	include (TEMPLATEPATH . '/single-reviewpanel.php');
}else{
get_header();

?>
	<div id="main">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php
			$thepostid = $post->ID;
			$category = get_the_category(); 
			$categoryparent = get_cat_slug($category[0]->parent);
			?>
			<span class="futura"><?php echo $categoryparent?></span><span class="arrow"> &#x25B6; </span><span class="futura"><a href="<?= get_archive_link($category[0]) ?>"><?php echo $category[0]->name?></a></span>  
			<hr class="color_<?php echo $categoryparent?>">
	<div id="article">
				<div id="date"><?php the_time('l, F jS, Y') ?></div> 
				<!-- <div id="date">&nbsp;| <a href="<?php comments_link(); ?>">Comments (<?php comments_number('0', '1', '%');?>)</a></div> -->
				<div id="tools"> 
					<span class='st_facebook_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_twitter_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_email_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_plusone_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='print'><a href="#" onclick="window.print();return false;">print</a> </span>
			</div>
				<div id="share"></div>
				<br style="clear:both">
				<h1 class="textcolor_<?php echo $categoryparent?>"><?php the_title(); ?></h1>
				<div id="date" style="padding-bottom:15px"><strong>by <?php the_author_posts_link(); ?></strong></div>
				<br style="clear:both">
				<div id="body">
					<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
					<br style="clear:both">	
							<span class='st_facebook_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_twitter_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_email_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_plusone_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='print'><a href="#" onclick="window.print();return false;">print</a> </span>
					<br style="clear:both">
				<div class="dottedline">&nbsp;</div>
			</div>
		</div>
		<?php comments_template(); ?>
		</div>
		
		
		<?php endwhile; else: ?>

			<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>
		<!-- sidebar -->
		<?php get_sidebar('single'); ?>
		<br style="clear:both">
		<!-- footer -->
		<?php get_footer(); ?>
		
<?php } ?>