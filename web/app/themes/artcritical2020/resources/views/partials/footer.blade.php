<footer class="content-info">
  <div class="container">
    <div id="footer">
      <script type="text/javascript">
    
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-16940579-1']);
        _gaq.push(['_trackPageview']);
    
        (function() {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    
      </script>
      <hr class="color_artworld">
      <hr class="color_departments">
      
      <div id="footer_info">
        <div id="logo"><a href="<?= site_url() ?>"><img src="@asset('images/logo-red.png')"></div>
        <div id="footermenu">
          <div id="criticism" class="block">
            <strong>Criticism</strong>
            <?php
            $cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=11&echo=0');
            $cats = str_replace("<br />","",$cats);
            echo $cats;
            ?>
          </div>
          <div id="features" class="block">
            <strong>Features</strong>
            <?php
            $cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=12&echo=0');
            $cats = str_replace("<br />","",$cats);
            echo $cats;
            ?>
          </div>
          <div id="artworld" class="block">
            <strong>Artworld</strong>
            <?php
            $cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=13&echo=0');
            $cats = str_replace("<br />","",$cats);
            echo $cats;
            ?>
          </div>
          <div id="artworld" class="block">
            <strong>Departments</strong>
            <?php
            $cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=14&echo=0');
            $cats = str_replace("<br />","",$cats);
            echo $cats;
            ?>
          </div>
          <div id="reviewpanel" class="block">
            <strong>The Review Panel</strong>
            <?$args = array(
              'orderby' => 'date',
              'order' => 'DESC',
              'post_type' => 'post',
              'post_status' => 'publish',
              'category_name' => 'The Review Panel',
              'posts_per_page' => 1
            );
            $reviewpanel = new WP_Query($args);
    
            if ($reviewpanel->have_posts()) : while ($reviewpanel->have_posts()) : $reviewpanel->the_post();
              ?>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              <?php
    
            endwhile;
            endif;
            ?>
            <a href="http://testingartcritical.com/category/departments/the-review-panel">Archive</a>
          </div>
          <div id="etc" class="block" style="margin-right:0">
            <strong>Etc.</strong>
            <a href="<?php bloginfo('url')?>/browse">Archive</a>
            <a href="<?php bloginfo('url')?>/calendar">Listings</a>
            <a href="<?php bloginfo('url')?>/bulletin">Bulletin</a>
            <a href="<?php bloginfo('url')?>/about">About Us</a> 
            <a href="<?php bloginfo('url')?>/advertise" >Advertise</a>
          </div>
          <br style="clear:both">
        </div>
        <div id="feeds">
          <ul>
            <li><strong>RSS</strong></li><br>
            <li><a href="<?php bloginfo('url')?>/feed/">Main Feed</a></li>
            <li><a href="<?php bloginfo('url')?>/category/criticism/exhibitions/feed/">Exhibition Reviews</a></li>
            <li><a href="http://feeds.soundcloud.com/users/soundcloud:users:147412095/sounds.rss">Podcast</a></li>
          <ul>
        </div>
        <div id="info">
          For letters to the editor and all other correspondence, please write to editorial@artcritical.com
          "artcritical," "artcritical.com" and "The Review Panel" (c) artcritical, LLC 2003-2010
        </div>
      </div>
    </div>
  </div>
</footer>
