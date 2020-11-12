<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
global $wp_query;
$mypage = get_query_var('paged');
if($mypage == 0){
	$mypage = 1;
}
?>
	<?php if (have_posts()) : ?>
 	  <?php 
	
		$post = $posts[0]; // Hack. Set $post so that the_date() works. 
		if(isset($_GET['author_name'])) :
			$curauth = get_userdatabylogin(get_the_author_login());
		else :
			$curauth = get_userdata(intval($author));
		endif;
		
		?>
		<div id="main">
		<?php
		if($curauth->user_level < 2 && $mypage == 1){?>
		<div id="user_profile">
			<h2><?php echo $curauth->display_name; ?></h2>
			<div id="user_thumb">
			<?php the_author_image(); ?>
			</div>
			<div id="user_description">
				<?php echo nl2br($curauth->description); ?>
			</div>
			
		</div>	
		<br style="clear:both">
		<hr>
			<?php
			$args = array(
				'post_type' => 'post',
				'post_status'  => 'publish',
				'meta_key' => 'featured',
				'meta_value'  => 'on',
				'author' => $curauth->ID,
				'orderby' => 'date',
				'order' => 'DESC',
				'posts_per_page' => 3
			);	

			$author_featured = new WP_Query($args);
			$n_posts = array();
			if ($author_featured->have_posts()) : ?>
			<div id="author_featured" class="author_sidebar">
			<h2>Featured Articles by <?php echo $curauth->display_name;?></h2>
			<?php
			while ($author_featured->have_posts()) : $author_featured->the_post();
				?>
				<div class="article">
					<!-- <div id="date"><?php the_time('l, F jS, Y') ?></div> -->
					<br style="clear:both">
					<?php if (postimage()!== false){?><div class="alignleft"><?php echo postimage('featured_inside', 'image'); ?></div><?php }?><h1 class="textcolor_<?php echo $categoryparent?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<div id="date" style="padding-bottom:15px; float:none"><strong><?php the_time('l, F jS, Y') ?></strong></div>
					<div id="body" >
						<?php the_excerpt(); ?>
					<!-- <div class="dottedline">&nbsp;</div> -->
					</div>
					<br style="clear:both">
				</div>	
				<?php
				$n_posts[] = get_the_ID();
			endwhile;
			?>
			</div><hr>
			<?php
			endif;
			?>
	
		<div class="author_sidebar">
			<?php
			$args = array(
				'post_type' => 'post',
				'post_status'  => 'publish',
				'post__not_in' => $n_posts,
				'author' => $curauth->ID,
				'orderby' => 'date',
				'order' => 'DESC',
				'posts_per_page' => 7
			);	

			$author_more = new WP_Query($args);
			?>
			<?php if($author_more->have_posts()):?>
				<h2>More Articles by <?php echo $curauth->display_name;?></h2>
			<?php while ($author_more->have_posts()): $author_more->the_post(); ?>
				<div class="article author_featured">
					<!-- <div id="date"><?php the_time('l, F jS, Y') ?></div> -->
					<br style="clear:both">
					<?php if (postimage()!== false){?><div class="alignleft"><?php echo postimage('thumbnail', 'image'); ?></div><?php }?><h1 class="textcolor_<?php echo $categoryparent?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<div id="date" style="padding-bottom:15px"><strong><?php the_time('l, F jS, Y') ?></strong></div>
					<br style="clear:both">
					<div>
						<?php the_excerpt(); ?>
					<!-- <div class="dottedline">&nbsp;</div> -->
					</div>
					
				</div>
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<br style="clear:both">
		<?php
		if(function_exists('wp_paginate')) {
		    wp_paginate();
		}
		}else{
		?>
		<span class="futura">Writings by <?php echo $curauth->display_name; ?></span>
		<hr class="color_<?php echo $categoryparent?>">
		<?php while (have_posts()) : the_post(); ?>
			<div class="article">
				<!-- <div id="date"><?php the_time('l, F jS, Y') ?></div> -->
				<br style="clear:both">
				<?php if (postimage()!== false){?><div class="alignleft"><?php echo postimage('thumbnail', 'image'); ?></div><?php }?><h1 class="textcolor_<?php echo $categoryparent?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
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
		} 
		}
		?>
		<br>
	<?php else :
	
		echo("<div><h2>Sorry, but there aren't any posts with this date.</h2>");
		get_search_form();
		?>

		<?php
	endif;
?>

	</div>

<?php get_sidebar('author'); ?>

<?php get_footer(); ?>
