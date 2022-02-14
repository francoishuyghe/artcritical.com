@extends('layouts.app')

@section('content')
@php
  global $wp_query, $post; 
@endphp

{{-- Featured Posts --}}
<div id="threefeatured">
	<div class="row">
		@if($featured_posts)
		<div class="col-md-5">
			<div id="images">
				@foreach($featured_posts as $post)
				@php setup_postdata($post) @endphp
				<div class="image" 
				id="feature_image_{{ $loop->iteration }}" 
				style="background-image:url(<?php echo App::postimage('featured_front'); ?>);"></div>
				@php wp_reset_postdata() @endphp
				@endforeach
			</div>
		</div>
		<div class="col-md-7">
		<div id="excerpts">
			@foreach($featured_posts as $featured_post)
			<div class="theexcerpt @if($loop->iteration == 1) selected @endif" id="feature_excerpt_{{ $loop->iteration}}" 
				onmouseover="window.feature_tab_quick({{ $loop->iteration}}, '{{ get_the_permalink($featured_post->ID) }}');">
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
	@endif
	</div>
	</div>

	<hr class="color_artworld thick"/>
	
	{{-- Featured Exhibition --}}
	@php
$cover = get_option('latest_cover');
$args = array(
	'orderby' => 'date',
	'order' => 'DESC',
	'post_type' => 'cover',
	'posts_per_page' => 1
);
query_posts($args);
@endphp

@if(have_posts())
	@while(have_posts()) @php the_post() @endphp
		@php 
			$coverpicurl = get_the_post_thumbnail_url();
			$coverdescription = App\get_fronttop3_excerpt(55);
		@endphp

		<div id="cover">
			<div class="row">
				<div class="col-md-5">
					<div id="cover_full"><?php the_post_thumbnail();?></div>
				</div>
				<div class="col-md-7">
					<div id="cover_feature"><?php the_title();?></div>
					<div id="cover_caption"><?php the_content(); ?></div>
				</div>
			</div>
		</div>
	@endwhile
@endif

<hr class="color_artworld thick"/>
<hr class="color_departments thick"/>

{{-- Columns --}}
<div id="columns">
	<div class="row">
		<div class="col-lg-4">
			<?php dynamic_sidebar('column1'); ?>
		</div>
		<div class="col-lg-4">
			<?php dynamic_sidebar('column2'); ?>
		</div>
		<div class="col-lg-4">
			<?php dynamic_sidebar('column3'); ?>
		</div>
	</div>
</div>
@endsection
