@extends('layouts.app')
@section('content')

@php
global $wp_query;
$mypage = get_query_var('paged');
if($mypage == 0){
	$mypage = 1;
}
@endphp
	
@if (have_posts())
		@php 
		$curauth = (isset($_GET['author_name'])) 
			? get_user_by('slug', $_GET['author_name']) 
			: get_userdata($post->post_author);
		@endphp 
		
	<div id="main">
		<div id="user_profile">
			<h2>{{ $curauth->display_name}}</h2>
			<div id="user_thumb">{!! get_avatar($curauth) !!}</div>
			<div id="user_description">{{ nl2br($curauth->description) }}</div>
		</div>

		<br style="clear:both">
		<hr>
			@php
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
			@endphp

			@if ($author_featured->have_posts())
				<div id="author_featured" class="author_sidebar">
				<h2>Featured Articles by <?php echo $curauth->display_name;?></h2>
				<div class="row">
				@while ($author_featured->have_posts()) @php $author_featured->the_post() @endphp
					<div class="col-md-4">
						@include('partials.post-block-featured')
					</div>
					@php $n_posts[] = get_the_ID() @endphp
				@endwhile
				</div>
				</div>
				<hr>
			@endif
	
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

			@if($author_more->have_posts())
				<h2>More Articles by <?php echo $curauth->display_name;?></h2>
				@while ($author_more->have_posts()) @php $author_more->the_post() @endphp
					@include('partials.post-block')
				@endwhile
			@endif
		</div>
		
		@if(function_exists('wp_paginate'))
			{!! wp_paginate() !!}
		@endif
	@endif

	</div>

@endsection
