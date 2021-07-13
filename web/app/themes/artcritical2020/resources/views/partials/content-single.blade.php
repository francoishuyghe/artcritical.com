<?php
			$thepostid = $post->ID;
			$category = get_the_category(); 
			$categoryparent = App\get_cat_slug($category[0]->parent);
			?>

<article @php post_class() @endphp>
  <header>
    <span class="futura"><?php echo $categoryparent?></span><span class="arrow"> &#x25B6; </span><span class="futura"><a href="<?= App\get_archive_link($category[0]) ?>"><?php echo $category[0]->name?></a></span>  
			<hr class="color_<?php echo $categoryparent?>">
    <div id="date"><?php the_time('l, F jS, Y') ?></div> 
			<div id="tools"> 
					<span class='st_facebook_buttons' st_title='{{ get_the_title() }}' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_twitter_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_email_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_plusone_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='print'><a href="#" onclick="window.print();return false;">print</a> </span>
			</div>
			<div id="share"></div>
				<h1 class="textcolor_<?php echo $categoryparent?>">{!! get_the_title() !!}</h1>
			<div id="date" style="padding-bottom:15px"><strong>by <?php the_author_posts_link(); ?></strong></div>
  </header>

  <div class="entry-content">
    @php the_content() @endphp
    <span class='st_facebook_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_twitter_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_email_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='st_plusone_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><span class='print'><a href="#" onclick="window.print();return false;">print</a> </span>
			<div class="dottedline">&nbsp;</div>
  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>