@extends('layouts.app')
@section('content')

@php 
	global $post;
	global $wp_query; 
	$mypage = get_query_var('paged');
	if($mypage == 0){
		$mypage = 1;
	}

	$category = get_queried_object();
    $categoryparent = App\get_cat_slug($category->parent);
	$n_posts = array();
@endphp

<span class="futura">{{ $categoryparent }}</span><span class="arrow"> &#x25B6; </span><span class="futura"><a href="<?= App\get_archive_link($category) ?>"><?php echo $category->name?></a></span>
<hr class="color_{{ $categoryparent }}">

@if($featured_posts)
	<div id="top3">
		<div class="row">
			@foreach($featured_posts as $post)
			@php setup_postdata($post) @endphp
			<div class="col-md-4">
				@include('partials.post-block-featured')
			</div>
			@php $n_posts[] = get_the_ID(); @endphp
			@php wp_reset_postdata() @endphp
		@endforeach
		<hr class="color_<?php echo $categoryparent?>">
		</div>
	</div>
@endif

	<div id="main">
		<div class="row">
			<div class="col-md-8">
				@php 
				$args2 = array(
					'cat' => $category->term_id,
					'post__not_in' => $n_posts,
					'orderby' => 'date',
					'order' => 'DESC',
					'paged' => $mypage
				);
				$wp_query = new WP_Query();  
				$wp_query->query($args2);
				@endphp

				@if($wp_query->have_posts())
				@while ($wp_query->have_posts()) @php $wp_query->the_post() @endphp
				@include('partials.post-block')
				@endwhile

				@if(function_exists('wp_paginate'))
				{!! wp_paginate() !!}
				@endif
				@endif
			</div>
			<div class="col-md-4">
				@include('partials.sidebar-category')
			</div>
		</div>
	</div>


@endsection