@extends('layouts.app')

@section('content')
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
        <?php $coverpicurl = get_the_post_thumbnail_url() ?>
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

{{-- Featured Posts --}}
<div id="threefeatured">
	<div class="row">
		<div class="col-md-9">
		@if($featured_posts)
			<div id="images">
				@foreach($featured_posts as $featutred_post)
				<div class="image" 
				id="feature_image_{{ $loop->iteration }}" 
				style="background:url(<?php echo App::postimage('featured_front'); ?>) center center;"></div>
				@endforeach
			</div>
		<div id="excerpts">
			@foreach($featured_posts as $featured_post)
			<div class="theexcerpt @if($loop->iteration == 1) selected @endif" id="feature_excerpt_{{ $loop->iteration}}" 
				onmouseover="feature_tab_quick({{ $loop->iteration}}, '{{ get_the_permalink($featured_post->ID) }}');">
				<div class="title_excerpt">
					<div class="title">
						<a href="{{ get_the_permalink($featured_post->ID) }}">{!! get_the_title($featured_post->ID) !!}</a>
					</div>
					<div class="author">by {{ get_the_author_meta('display_name', $featured_post->post_author) }}</div>
					<div class="excerpt">
						<?php echo App\get_fronttop3_excerpt(); ?>
					</div>
				</div>
				<div id="read_more_{{ $loop->iteration }}" class="read_more">
					<a href="{{ get_the_permalink($featured_post->ID) }}">Read more..</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="col-md-3">
		<div id="cover_info">
			<div id="coverdescription">
				<div id="cover_image" style="background-image: url('{{ $coverpicurl }}')"></div>
				{!! nl2br($coverdescription) !!}
			</div>
			<a href="javascript:expand_cover();" id="fullimage">View Full Image &#x25B6;</a>
		</div>
	</div>
	</div>
	</div>
	<hr class="color_artworld thick"/>
	<hr class="color_departments thick"/>
<?php endif;?>
<div id="columns">
	<div class="row">
		<div class="col-md-4">
			<?php dynamic_sidebar('column1'); ?>
		</div>
		<div class="col-md-4">
			<?php dynamic_sidebar('column2'); ?>
		</div>
		<div class="col-md-4">
			<?php dynamic_sidebar('column3'); ?>
		</div>
	</div>
</div>
@endsection
