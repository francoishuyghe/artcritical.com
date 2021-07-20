@extends('layouts.app')

@section('content')

@php 
	global $wp_query; 
	$mypage = get_query_var('paged');
	if($mypage == 0){
		$mypage = 1;
	}

	$category = get_queried_object();
        
    $categoryparent = App\get_cat_slug($category->parent);

	$n_posts = array();
@endphp

<span class="futura"><?php echo $categoryparent?></span><span class="arrow"> &#x25B6; </span><span class="futura"><a href="<?= App\get_archive_link($category) ?>"><?php echo $category->name?></a></span>
<hr class="color_<?php echo $categoryparent?>">

@if($featured_posts)
	<div id="top3">

		@foreach($featured_posts as $post)
		@php setup_postdata($post) @endphp
		<div class=" textcolor_{{ $categoryparent }} suggested_post">
			<div id="date">{{ the_time('l, F jS, Y') }}</div>
			<div class="title"><a href="{{ the_permalink() }}">{{ the_title() }}</a></div>
			<div id="date"><strong>by {{ the_author_posts_link() }}</strong></div>
			<div class="excerpt">
				<div class="thumb">{{ the_post_thumbnail('featured_inside') }}</div>
				{{App\get_top3_excerpt() }}
			</div>
			@php
				$top3 = true;
				$n_posts[] = get_the_ID();
			@endphp
			</div>
			@php wp_reset_postdata() @endphp
		@endforeach
		<div style="clear:both">&nbsp;</div>
		<hr class="color_<?php echo $categoryparent?>">
	</div>
@endif

	<div id="main">
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
 	  	@php $post = $posts[0]; @endphp

				@while ($wp_query->have_posts()) @php $wp_query->the_post() @endphp
					@include('partials.post-block')
				@endwhile

			@if(function_exists('wp_paginate'))
		    	{!! wp_paginate() !!}
			@endif
	@endif
	</div>


{!! get_sidebar('category') !!}

@endsection