<header class="banner">
  <div class="container">
    <div id="topmenucontainer">

      <div id="logo" style="padding-top:15px;float:left;height:70px"><a href="<?php bloginfo('url')?>"><img src="@asset('images/logo.png')"></a></div>







      <div id="vulture728x90" style="float:right; margin-bottom:10px;margin-top:3px;">

        <?php if (is_home()):?>









                                             <!-- BANNER AD FOR HOME PAGE -->



          <script language="JavaScript" type="text/javascript">

          window.dctile = Number(window.dctile) + 1 || 1;

          window.dc_ord = Number(window.dc_ord) || Math.floor(Math.random() * 1E10);

          if (dctile==1) {var vdcopt = 'ist';} else {vdcopt = '';}

          if (17>dctile) document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/nym.vulturenetwork.artcritical/Homepage;dcopt=' + vdcopt + ';tile=' + dctile + ';sz=728x90;ord=' + dc_ord + '?"><\/script>\n');

          </script>

          <noscript><a href="http://ad.doubleclick.net/jump/nym.vulturenetwork.artcritical/Homepage;sz=728x90;ord=123456789?"><img src="http://ad.doubleclick.net/ad/nym.vulturenetwork.artcritical/Homepage;sz=728x90;ord=123456789?" border="0"></a></noscript>

                                         <!-- END BANNER AD FOR HOME PAGE -->











        <?php else: ?>

                                        

<!-- BANNER AD FOR INSIDE PAGE -->







          <script language="JavaScript" type="text/javascript">

          window.dctile = Number(window.dctile) + 1 || 1;

          window.dc_ord = Number(window.dc_ord) || Math.floor(Math.random() * 1E10);

          if (dctile==1) {var vdcopt = 'ist';} else {vdcopt = '';}

          if (17>dctile) document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/nym.vulturenetwork.artcritical/ros;dcopt=' + vdcopt + ';tile=' + dctile + ';sz=728x90;ord=' + dc_ord + '?"><\/script>\n');

          </script>

          <noscript><a href="http://ad.doubleclick.net/jump/nym.vulturenetwork.artcritical/ros;sz=728x90;ord=123456789?"><img src="http://ad.doubleclick.net/ad/nym.vulturenetwork.artcritical/ros;sz=728x90;ord=123456789?" border="0"></a></noscript>

                                         









<!-- END BANNER AD FOR INSIDE PAGE -->







        <?php endif;?>

      </div>

      <br style="clear:both">

    </div>

    <div id="bottommenucontainer">

      <?php $options = unserialize(get_option('top_menu_options'));
      ?>
      <div id="menu">
        <ul>
                <li class="ddheader color_thelist menuitem-listing" id="thelist">The List</li>
          <li class="ddheader color_criticism" id="criticism" >Criticism</li>
          <li class="ddheader color_features" id="features" >Features</li>
          <li class="ddheader color_artworld" id="artworld" >Art World</li>
          <li class="ddheader color_departments" id="departments">Departments</li>
          <li class="ddheader color_reviewpanel" id="reviewpanel">The Review Panel</li>
        </ul>

        {{-- DROPDOWNS --}}
        <div class="ddcontent tl_dropdown" id="thelist-ddcontent" >
          <a href="https://list.artcritical.com">Week at a Glance</a>
                <a href="https://list.artcritical.com/current">Current</a>
                <a href="https://list.artcritical.com/events">Lectures/Events</a>
        </div>
      
        <div class="ddcontent cr_dropdown" id="criticism-ddcontent">
          <?
          $cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=11&echo=0');
          $cats = str_replace("<br />","",$cats);
          echo $cats;
          ?>
          <div class="subhead">Regular writers include:</div>
          <div class="submenu">
          <?php
          global $wpdb;
          $ud = $wpdb->get_results("SELECT * FROM $wpdb->users INNER JOIN $wpdb->usermeta ON ($wpdb->users.ID = $wpdb->usermeta.user_id) WHERE $wpdb->usermeta.meta_key = 'on_menu' AND $wpdb->usermeta.meta_value = 'on' ORDER BY $wpdb->usermeta.meta_value ASC");
          foreach($ud as $user){
            $userdata = get_userdata($user->ID);
            if ($userdata->user_nicename != ""){
              echo "<a href=\"".App::get_myauthor_link($userdata->user_nicename)."\">".$userdata->display_name."</a>";
            }
          }
          
          ?>
          <a href="http://artcritical.com/browse/?tab=byauthor">More...</a>
          </div>
        </div>
        <div class="ddcontent fe_dropdown" id="features-ddcontent" >
          <?
          $cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=12&echo=0');
          $cats = str_replace("<br />","",$cats);
          echo $cats;
          ?>
        </div>
        <div class="ddcontent aw_dropdown" id="artworld-ddcontent">
          <?
          $cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=13&echo=0');
          $cats = str_replace("<br />","",$cats);
          echo $cats;
          ?>
        </div>
        <div class="ddcontent de_dropdown" id="departments-ddcontent">
          <?
          $cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=14&echo=0');
          $cats = str_replace("<br />","",$cats);
          echo $cats;
          ?>
          <a href="<?php bloginfo('url')?>/listings-week">The List</a>
        </div>
        <div class="ddcontent rp_dropdown" id="reviewpanel-ddcontent">
                <a href="<?php bloginfo('url')?>/subscribe">Newsletter</a>
          <?php
          $args = array(
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
          
          <a href="http://artcritical.com/category/departments/the-review-panel">Archive</a>
          <?= empty($options['next_review_panel_link']) ? '' : '<a href="'.$options['next_review_panel_link'].'">' ;  ?>
            <?php echo $options['next_review_panel_text']?> - <?php echo $options['next_review_panel']?>
          <?= empty($options['next_review_panel_link']) ? '' : '</a>' ;  ?>
        </div>

      </div>

      <div id="search_follow">

        <?php get_search_form(); ?> 

      </div>

      <br style="clear:both">

      <div id="submenu">

        <h2><a href="<?php bloginfo('url')?>/browse">Archive</a></h2> |  

        <h2><a href="<?php bloginfo('url')?>/subscribe">Subscribe</a></h2> | 

        <h2><a href="<?php bloginfo('url')?>/about">About Us</a></h2> | 

        <h2><a href="<?php bloginfo('url')?>/support">Advertise/Support</a></h2>

      </div>

      <br style="clear:both">

    </div>

    <hr>

  </div>
  </div>
</header>
