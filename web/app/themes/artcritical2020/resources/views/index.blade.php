@extends('layouts.app')

@section('content')
  @include('partials.page-header')
<?php
  // App\remove_podpress_from_automatic_excerpts();
  global $wp_query; 
$cover = get_option('latest_cover');
$args = array(
	'orderby' => 'date',
	'order' => 'DESC',
	'post_type' => 'cover',
	'posts_per_page' => 1
);
query_posts($args);
?>
<?php if (have_posts())  : ?>
	<?php while (have_posts()) : the_post(); ?>
			<script>
				document.observe("dom:loaded", function() {
					setTimeout(expand_cover_cookie, 600);
				});	
			</script>
		<?php $coverid = $post->ID;?>
        <?php $coverpicurl = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
		<?php ?>
		<?php $coverdescription = App\get_fronttop3_excerpt(55);?>
		<div id="cover" style="display:none">
			<div id="cover_feature"><?php the_title();?></div>
			<div id="close_cover"><a href="javascript:expand_cover();">(close)</a></div>
			<div id="cover_full"><?php the_post_thumbnail();?></div>
			<div id="cover_caption"><?php the_content(); ?></div>
			<hr>
		</div>
	<?php endwhile;?>
<?php endif;?>
<?php
$args = array(
	'meta_key' => 'featured_front',
	'meta_value'  => 'on',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => 3
);
query_posts($args);
$count = 1;
?>
<?php if (have_posts() && $wp_query->post_count > 2)  : ?>
	<script>
	/*if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
		 if (document.cookie.indexOf("iphone_redirect=false") == -1) window.location = window.location + 'feed/';
	}*/
		//setInterval(tab_rotate, 10000);
	</script>
	<div id="threefeatured">
		<div id="images">
		<?php while (have_posts()) : the_post(); ?>
			<div class="image" id="feature_image_<?php echo $count?>" style="background:url(<?php echo App::postimage('featured_front'); ?>) center center; <?= $count == 1 ? '':'display:none'?> "></div>
			<?php
			$count++;
			?>
		<?php endwhile;?>
		</div>
		<?php
		$count = 1;
		?>
		<div id="excerpts">
		<?php while (have_posts()) : the_post(); ?>
			<div class="theexcerpt <?= $count == 1 ? 'selected':''?>" id="feature_excerpt_<?php echo $count?>" onmouseover="feature_tab_quick(<?php echo $count?>, '<?php the_permalink(); ?>');">
				<div class="title_excerpt">
					<div class="title"><a href="<?php the_permalink()?>"><?php the_title(); ?></a></div>
					<div class="author">by <?php the_author(); ?></div>
					<div class="excerpt">
						<?php echo App\get_fronttop3_excerpt(); ?>
					</div>
				</div>
				
				<div id="read_more_<?php echo $count?>" class="read_more"><a href="<?php the_permalink()?>">Read more..</a></div>
			</div>
			<?php 
			$count++;
			?>
		<?php endwhile;?>
		</div>
		<div id="cover_info">
			<div id="coverdescription">
				<div id="cover_image" style="background-image: url('<?php echo "$coverpicurl[0]";?>');"></div>
				<?php echo nl2br($coverdescription)?><br><br>
			</div>
			<a href="javascript:expand_cover();" id="fullimage">View Full Image &#x25B6;</a>
		</div>
	</div>
	<div style="clear:both">&nbsp;</div>
	<hr class="color_artworld thick"/>
	<hr class="color_departments thick"/>
<?php endif;?>
<div id="columns">
	<?php dynamic_sidebar('column1'); ?>

	<?php dynamic_sidebar('column2'); ?>

	<?php dynamic_sidebar('column3'); ?>
	<br style="clear:both">
</div>
@endsection
