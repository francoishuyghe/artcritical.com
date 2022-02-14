@php $categoryparent = App\get_cat_slug(get_the_category()); @endphp

<div class="suggested_post">
    <div class="date">{{ the_time('l, F jS, Y') }}</div>
    <div class="title textcolor_{{ $categoryparent }}"><a href="{{ the_permalink() }}">{{ the_title() }}</a></div>
    <div class="author"><strong>by {{ the_author_posts_link() }}</strong></div>
    <div class="thumb">{{ the_post_thumbnail('featured_inside') }}</div>
    <div class="excerpt">
            {!!App\get_top3_excerpt() !!}
    </div>
</div>