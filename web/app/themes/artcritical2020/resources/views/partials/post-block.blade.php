<div class="article">
    <div id="date" style="margin-bottom:10px;"><?php the_time('l, F jS, Y') ?></div>
    <br style="clear:both">
    @if (App::postimage()!== false)
        <div class="alignleft">{!! App::postimage('thumbnail', 'image') !!}</div>
    @endif
    <h1 class="textcolor_{{ $categoryparent }}"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <div id="date" style="padding-bottom:15px"><strong>by <?php the_author_posts_link(); ?> </strong></div>
    <br style="clear:both">
    <div id="body">
        <?php the_excerpt(); ?>
</div>