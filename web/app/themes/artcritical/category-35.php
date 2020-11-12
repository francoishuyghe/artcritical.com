<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
remove_podpress_from_automatic_excerpts();
get_header();
global $wp_query; 
$mypage = get_query_var('paged');
if($mypage == 0){
	$mypage = 1;
}
$cat_id = get_cat_ID(str_replace("-", " ", $wp_query->query_vars['category_name']));
$args = array(
	'meta_key' => 'featured',
	'meta_value'  => 'on',
	'cat' => $cat_id,
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => 3
);
$count = 0;
$category = &get_category($cat_id);
$categoryparent = "reviewpanel";
$n_posts = array();
query_posts($args);
?>

<?php if (have_posts() && $wp_query->post_count > 2)  : ?>
	
<div id="top3">
	<span class="futura"><?php echo $categoryparent?></span><span class="arrow"> &#x25B6; </span><span class="futura"><a href="<?= get_archive_link($category) ?>"><?php echo $category->name?></a></span>
	<hr class="color_<?php echo $categoryparent?>">
	<?php while (have_posts()) : the_post(); ?>
		<div class=" textcolor_<?php echo $categoryparent?> suggested_post <?= $count == 2 ? "no_right_border" : "" ; ?>">
			
			<div class="title"><a href="<?php the_permalink() ?>"><?php the_title();?></a></div>
			<div style="clear:both">&nbsp;</div>
			<div class="excerpt"><div class="thumb"><?php the_post_thumbnail('featured_inside');?></div><?php echo get_top3_excerpt(); ?></div>
			<?php
			$top3 = true;
			$n_posts[] = get_the_ID();
			$count++;
			?>
		</div>
	<?php endwhile;?>
	<div style="clear:both">&nbsp;</div>
	<hr class="color_<?php echo $categoryparent?>">
</div>
<?php endif; ?>
	<div id="main">
		<?php 
		//print_r($n_posts);
		$args2 = array(
			'cat' => $cat_id,
			'post__not_in' => $n_posts,
			'orderby' => 'date',
			'order' => 'DESC',
			'paged' => $mypage
		);
		$wp_query = new WP_Query();  
		$wp_query->query($args2);
		if ($wp_query->have_posts()) : ?>
 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { 
		if($top3 !== true){	
		?>
		<span class="futura"><?php echo $category->name?></span>
		<hr class="color_reviewpanel">
		<?php
		}
		?>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle">Author Archive</h2>
 	  <?php /* If this is a paged archive */ } ?>

		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
			<div class="article">
				<div id="date" style="margin-bottom:10px;"><?php the_time('l, F jS, Y') ?></div>
				<br style="clear:both">
				<?php if (postimage()!== false){?><div class="alignleft"><?php echo postimage('thumbnail', 'image'); ?></div><?php }?><h1 class="textcolor_reviewpanel"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<div id="date" style="padding-bottom:15px"><strong>by <?php the_author_posts_link(); ?> </strong></div>
				<br style="clear:both">
				<div id="body">
					<?php echo get_top3_excerpt(); ?>
				<!-- <div class="dottedline">&nbsp;</div> -->
			</div>
		</div>
		<?php endwhile; ?>

		<?php if(function_exists('wp_paginate')) {
		    wp_paginate();
		} ?>
		
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form();

	endif;
?>

	</div>

<?php get_sidebar('category'); ?>

<?php get_footer(); ?>
