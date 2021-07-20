<header class="banner">
  <div id="topmenucontainer">
      <div class="container">
        <div class="row">
        <div id="logo" class="col">
          <a href="<?php bloginfo('url')?>"><img src="@asset('images/logo.png')"></a>
        </div>

      <div id="hamburgerWrap" class="col">
        <button class="hamburger hamburger--squeeze" type="button">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>
      </div>
      <div id="vulture728x90" class="ad-space col">
        @if(is_home())
          <!-- BANNER AD FOR HOME PAGE -->
          <script language="JavaScript" type="text/javascript">
          window.dctile = Number(window.dctile) + 1 || 1;
          window.dc_ord = Number(window.dc_ord) || Math.floor(Math.random() * 1E10);
          if (dctile==1) {var vdcopt = 'ist';} else {vdcopt = '';}
          if (17>dctile) document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/nym.vulturenetwork.artcritical/Homepage;dcopt=' + vdcopt + ';tile=' + dctile + ';sz=728x90;ord=' + dc_ord + '?"><\/script>\n');
          </script>
          <noscript><a href="http://ad.doubleclick.net/jump/nym.vulturenetwork.artcritical/Homepage;sz=728x90;ord=123456789?"><img src="http://ad.doubleclick.net/ad/nym.vulturenetwork.artcritical/Homepage;sz=728x90;ord=123456789?" border="0"></a></noscript>
          <!-- END BANNER AD FOR HOME PAGE -->
        @else
          <!-- BANNER AD FOR INSIDE PAGE -->
          <script language="JavaScript" type="text/javascript">
          window.dctile = Number(window.dctile) + 1 || 1;
          window.dc_ord = Number(window.dc_ord) || Math.floor(Math.random() * 1E10);
          if (dctile==1) {var vdcopt = 'ist';} else {vdcopt = '';}
          if (17>dctile) document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/nym.vulturenetwork.artcritical/ros;dcopt=' + vdcopt + ';tile=' + dctile + ';sz=728x90;ord=' + dc_ord + '?"><\/script>\n');
          </script>
          <noscript><a href="http://ad.doubleclick.net/jump/nym.vulturenetwork.artcritical/ros;sz=728x90;ord=123456789?"><img src="http://ad.doubleclick.net/ad/nym.vulturenetwork.artcritical/ros;sz=728x90;ord=123456789?" border="0"></a></noscript>
          <!-- END BANNER AD FOR INSIDE PAGE -->
        @endif
        </div>
      </div>
    </div>
  </div>

  <div id="bottommenucontainer">
    <div class="container">
      <div class="row">
      @php $options = unserialize(get_option('top_menu_options')); @endphp
      <div id="menu">
        <ul>

          <li class="ddheader color_thelist menuitem-listing" id="thelist">
            {{-- The List --}}
            The List
            <div class="ddcontent tl_dropdown" id="thelist-ddcontent" >
              <a href="https://list.artcritical.com">Week at a Glance</a>
              <a href="https://list.artcritical.com/current">Current</a>
              <a href="https://list.artcritical.com/events">Lectures/Events</a>
            </div>
          </li>

          <li class="ddheader color_criticism" id="criticism" >
            {{-- Criticism --}}
            Criticism
            <div class="ddcontent cr_dropdown" id="criticism-ddcontent">
              @php
              $cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=11&echo=0');
              $cats = str_replace("<br />","",$cats);
              @endphp
              {!! $cats !!}

              <div class="subhead">Regular writers include:</div>
              <div class="submenu">
              @php
              global $wpdb;
              $ud = $wpdb->get_results("SELECT * FROM $wpdb->users 
                            INNER JOIN $wpdb->usermeta 
                            ON ($wpdb->users.ID = $wpdb->usermeta.user_id) 
                            WHERE $wpdb->usermeta.meta_key = 'on_menu' 
                            AND $wpdb->usermeta.meta_value = 'on' 
                            ORDER BY $wpdb->usermeta.meta_value ASC"
                          );
              @endphp
              @foreach($ud as $user)
                @php $userdata = get_userdata($user->ID) @endphp
                @if($userdata->user_nicename != "")
                  <a href="{{App::get_myauthor_link($userdata->user_nicename) }}">{{ $userdata->display_name }}</a>
                @endif
              @endforeach
              <a href="http://artcritical.com/browse/?tab=byauthor">More...</a>
              </div>
            </div>
          </li>


          <li class="ddheader color_features" id="features" >
            {{-- Features --}}
            Features
            <div class="ddcontent fe_dropdown" id="features-ddcontent" >
              @php
              $cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=12&echo=0');
              $cats = str_replace("<br />","",$cats);
              @endphp
              {!! $cats !!}
            </div>
          </li>


          <li class="ddheader color_artworld" id="artworld" >
            {{-- Art World --}}
            Art World
            <div class="ddcontent aw_dropdown" id="artworld-ddcontent">
              @php
              $cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=13&echo=0');
              $cats = str_replace("<br />","",$cats);
              @endphp
              {!! $cats !!}
            </div>
          </li>


          <li class="ddheader color_departments" id="departments">
            {{-- Departments --}}
            Departments
            <div class="ddcontent de_dropdown" id="departments-ddcontent">
              @php
              $cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=14&echo=0');
              $cats = str_replace("<br />","",$cats);
              @endphp
              {!! $cats !!}
              <a href="<?php bloginfo('url')?>/listings-week">The List</a>
            </div>
          </li>


          <li class="ddheader color_reviewpanel" id="reviewpanel">
            {{-- The Review Panel --}}
            The Review Panel
            <div class="ddcontent rp_dropdown" id="reviewpanel-ddcontent">
              <a href="<?php bloginfo('url')?>/subscribe">Newsletter</a>
        @php
        $args = array(
          'orderby' => 'date',
          'order' => 'DESC',
          'post_type' => 'post',
          'post_status' => 'publish',
          'category_name' => 'The Review Panel',
          'posts_per_page' => 1
        );
        $reviewpanel = new WP_Query($args);
        @endphp
        
        @if($reviewpanel->have_posts())
          @while ($reviewpanel->have_posts()) @php $reviewpanel->the_post() @endphp
          <a href="{{ the_permalink() }}">{{ the_title() }}</a>
          @endwhile
        @endif
        
        <a href="http://artcritical.com/category/departments/the-review-panel">Archive</a>
        <?= empty($options['next_review_panel_link']) ? '' : '<a href="'.$options['next_review_panel_link'].'">' ;  ?>
          <?php echo $options['next_review_panel_text']?> - <?php echo $options['next_review_panel']?>
        <?= empty($options['next_review_panel_link']) ? '' : '</a>' ;  ?>
      </div>
          </li>
        </ul>
        </div>

        <div id="rightSection">
          <div id="search_follow">
            {!! get_search_form() !!} 
          </div>

          <div id="submenu">
            <h2><a href="<?php bloginfo('url')?>/browse">Archive</a></h2> |  
            <h2><a href="<?php bloginfo('url')?>/subscribe">Subscribe</a></h2> | 
            <h2><a href="<?php bloginfo('url')?>/about">About Us</a></h2> | 
            <h2><a href="<?php bloginfo('url')?>/support">Advertise/Support</a></h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
