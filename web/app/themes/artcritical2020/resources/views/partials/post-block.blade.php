@php $categoryparent = App\get_cat_slug(get_the_category()); @endphp

<div class="article">
    <div id="date" style="margin-bottom:10px;"><?php the_time('l, F jS, Y') ?></div>
    @if (App::postimage()!== false)
        <div class="alignleft">{!! App::postimage('thumbnail', 'image') !!}</div>
    @endif
    <h1 class="textcolor_{{ $categoryparent }}"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <div id="date" style="padding-bottom:15px"><strong>by <?php the_author_posts_link(); ?> </strong></div>
    <div id="body">
        <?php the_excerpt(); ?>
    </div>
</div>