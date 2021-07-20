@php $categoryparent = App\get_cat_slug(get_the_category()); @endphp

<div class=" textcolor_{{ $categoryparent }} suggested_post">
    <div id="date">{{ the_time('l, F jS, Y') }}</div>
    <div class="title"><a href="{{ the_permalink() }}">{{ the_title() }}</a></div>
    <div id="date"><strong>by {{ the_author_posts_link() }}</strong></div>
    <div class="excerpt">
            <div class="thumb">{{ the_post_thumbnail('featured_inside') }}</div>
            {{App\get_top3_excerpt() }}
    </div>
</div>