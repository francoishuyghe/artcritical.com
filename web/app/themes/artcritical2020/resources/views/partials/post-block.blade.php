@php $categoryparent = App\get_cat_slug(get_the_category()); @endphp

<div class="article">
    <div class="row">
    <div class="col-md-4">
        @if (App::postimage()!== false)
        {!! App::postimage('medium', 'image') !!}
        @endif
    </div>
    <div class="col-md-8">
        <div class="date"><?php the_time('l, F jS, Y') ?></div>
        <h1 class="textcolor_{{ $categoryparent }}"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <div class="author"><strong>by <?php the_author_posts_link(); ?> </strong></div>
        <div class="blurb">
            <?php the_excerpt(); ?>
        </div>
    </div>
</div>
</div>