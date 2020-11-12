<?php
register_sidebar(array(
	'name' => 'Front Page / Column 1', 
	'description' => 'This is to organize the front page column #1 (1st column from the left).', 
	'before_widget' => '<div id="%1$s" class="frontwidget %2$s">',
	'after_widget' => "</div>",
	'before_title' => '<div id="sidebarheader"><h2>',
	'after_title' => '</h2></div>')
);
register_sidebar(array(
	'name' => 'Front Page / Column 2', 
	'description' => 'This is to organize the front page column #2 (2nd column from the left).', 
	'before_widget' => '<div id="%1$s" class="frontwidget %2$s">',
	'after_widget' => "</div>",
	'before_title' => '<div class="frontheader"><h2>',
	'after_title' => '</h2></div>')
);

$ad = "<div id=\"vulture300x250\">
<script language=\"JavaScript\" type=\"text/javascript\">
window.dctile = Number(window.dctile) + 1 || 1;
window.dc_ord = Number(window.dc_ord) || Math.floor(Math.random() * 1E10);
if (dctile==1) {var vdcopt = 'ist';} else {vdcopt = '';}
if (17>dctile) document.write('<script type=\"text/javascript\" src=\"http://ad.doubleclick.net/adj/nym.vulturenetwork.artcritical/Homepage;dcopt=' + vdcopt + ';tile=' + dctile + ';sz=300x250;ord=' + dc_ord + '?\"><\/script>\n');
</script>
<noscript><a href=\"http://ad.doubleclick.net/jump/nym.vulturenetwork.artcritical/Homepage;sz=300x250;ord=123456789?\"><img src=\"http://ad.doubleclick.net/ad/nym.vulturenetwork.artcritical/Homepage;sz=300x250;ord=123456789?\" border=\"0\"></a></noscript>
</div>";

register_sidebar(array(
	'name' => 'Front Page / Column 3', 
	'description' => 'This is to organize the front page column #3 (3rd column from the left).', 
	'before_widget' => '<div id="%1$s" class="frontwidget %2$s">',
	'after_widget' => "</div>",
	'before_title' => '<div class="frontheader"><h2>',
	'after_title' => '</h2></div>')
);
register_sidebar(array(
	'name' => 'Single Sidebar', 
	'description' => 'This is the sidebar for the single story page.', 
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => "</div>",
	'before_title' => '<div id="sidebarheader"><h2>',
	'after_title' => '</h2></div>')
);
register_sidebar(array(
	'name' => 'Review Panel Sidebar', 
	'description' => 'This is the sidebar for the single story page.', 
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => "</div>",
	'before_title' => '<div id="sidebarheader"><h2>',
	'after_title' => '</h2></div>')
);
register_sidebar(array(
	'name' => 'Conduit Sidebar', 
	'description' => 'This is the sidebar that will appear on sub category pages archive, About Us page, search results, author pages, etc.', 
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => "</div>",
	'before_title' => '<div id="sidebarheader"><h2>',
	'after_title' => '</h2></div>')
);
register_sidebar(array(
	'name' => 'Listings Sidebar', 
	'description' => 'This is the sidebar that will appear on the Listings and Calendar Page.', 
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => "</div>",
	'before_title' => '<div id="sidebarheader"><h2>',
	'after_title' => '</h2></div>')
);

// register_sidebar(array(
// 	'name' => 'Index Sidebar', 
// 	'description' => 'This is the sidebar for the site front page.', 
// 	'before_widget' => '<div id="%1$s" class="widget %2$s">',
// 	'after_widget' => "</div>",
// 	'before_title' => '<div id="sidebarheader"><h2>',
// 	'after_title' => '</h2></div>')
// );
// register_sidebar(array(
// 	'name' => 'Search Sidebar', 
// 	'description' => 'This is the sidebar that will appear on the search page.', 
// 	'before_widget' => '<div id="%1$s" class="widget %2$s">',
// 	'after_widget' => "</div>",
// 	'before_title' => '<div id="sidebarheader"><h2>',
// 	'after_title' => '</h2></div>')
// );
// register_sidebar(array(
// 	'name' => 'Author Sidebar', 
// 	'description' => 'This is the sidebar that will appear on the author homepage.', 
// 	'before_widget' => '<div id="%1$s" class="widget %2$s">',
// 	'after_widget' => "</div>",
// 	'before_title' => '<div id="sidebarheader"><h2>',
// 	'after_title' => '</h2></div>')
// );
// register_sidebar(array(
// 	'name' => 'Listings Sidebar', 
// 	'description' => 'This is the sidebar that will appear on the listings page.', 
// 	'before_widget' => '<div id="%1$s" class="widget %2$s">',
// 	'after_widget' => "</div>",
// 	'before_title' => '<div id="sidebarheader"><h2>',
// 	'after_title' => '</h2></div>')
// );

// WIDGETS!

class authorWidget extends WP_Widget {
    /** constructor */
    function authorWidget() {
		$widget_ops = array('description' => 'This widget will display the 4 most recent posts by the same author on a single article page.');
        $this->WP_Widget(false, __('Posts by author (article page)'), $widget_ops);	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
		global $theauthor, $categoryparent, $thepostid, $post;
		$post->ID = $thepostid;
		extract( $args ); // extract arguments
		echo $before_widget;
		echo $before_title . "More articles by ".$theauthor->display_name . $after_title;
		echo "<hr class=\"color_$categoryparent\">";
	
		$args = array(
			'author' => $theauthor->ID,
			'post_type' => 'post',
			'post_status'  => 'publish',
			'post__not_in' => array($post->ID),
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => 4
		);	
		$authors = new WP_Query($args);
		if ($authors->have_posts()) : while ($authors->have_posts()) : $authors->the_post();
			?>
			<a href="<?php the_permalink(); ?>"><?php echo strip_tags(get_the_title()); ?></a>
			<?php
			
		endwhile;
		endif;
		echo $after_widget;
    }
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
		?>
		This widget will display the 4 most recent posts by the same author on a single article page.
		<?php 
	}
	
}
class categoryWidget extends WP_Widget {
    /** constructor */
    function categoryWidget() {
		$widget_ops = array('description' => 'This widget will display the 4 most recent posts in the same category as the article on a single article page.');
		$this->WP_Widget(false, __('Posts in category'), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
		global $authordata, $categoryparent, $category, $thepostid, $post;
		$post->ID = $thepostid;
		extract( $args ); // extract arguments
		echo $before_widget;
		echo $before_title . "Other articles in \"".$category[0]->name."\"".$after_title;
		echo "<hr class=\"color_$categoryparent\">";
	
		$args = array(
			'post_type' => 'post',
			'post_status'  => 'publish',
			'post__not_in' => array($post->ID),
			'cat' => $category[0]->cat_ID,
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => 4
		);	
		$thecategory = new WP_Query($args);
		
		if ($thecategory->have_posts()) : while ($thecategory->have_posts()) : $thecategory->the_post();
			?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php
			
		endwhile;
		endif;
		echo $after_widget;
    }
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function form($instance) {				
		?>
		This widget will display the 4 most recent posts in the same category as the article on a single article page.
		<?php 
	}
	
}
class frontCategoryWidget extends WP_Widget {
    /** constructor */
    function frontCategoryWidget() {
		$widget_ops = array('description' => 'This widget will display the most recent posts in the category chosen.');
		$this->WP_Widget(false, __('Front Category'), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
		$title = esc_attr($instance['title']);
		$num_posts = esc_attr($instance['num_posts']);
		$suggested = esc_attr($instance['suggested']);
		$cat = get_cat_ID($title);
		$color = get_category_parents($cat, FALSE, ".", TRUE);
		$color = explode(".", $color);
		extract( $args );
		echo $before_widget;
		echo $before_title . $title. $after_title;
		echo "<hr class=\"color_$color[0]\">";
	
		$args = array(
			'post_type' => 'post',
			'post_status'  => 'publish',
			'cat' => $cat,
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => $num_posts
		);	
		
		$frontcategory = new WP_Query($args);
		
		if ($frontcategory->have_posts()) : while ($frontcategory->have_posts()) : $frontcategory->the_post();
			?>
			<!-- <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> -->
			<div class="smallpost">
				<div class="thumb">
						<?php if (postimage()!== false){?><div class="alignleftfront"><?php echo postimage('thumbnail', 'image'); ?></div><?php }?>
				</div>
				<div class="snippet">
					<div class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<div class="date"><?php the_time('F jS, Y') ?> | <span class="author"><?php the_author();?></span></div>
					<?php if (postimage()!== false){?><div class="excerpt"><?php echo get_fronttop3_excerpt(18);?></div><?php }?>
				</div>
				<br style="clear:both;height:0px">
			</div>
			<?php
			
		endwhile;
		endif;
		echo $after_widget;
    }
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function form($instance) {				
		$title = esc_attr($instance['title']);
		$titleid = $this->get_field_id('title');
		$num_posts = esc_attr($instance['num_posts']);
		$suggested = esc_attr($instance['suggested']);
		$allcategories = get_categories();
        ?>
			<p style="display:none"><label for="<?php echo $this->get_field_id('title'); ?>">Title<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Category:</label><br>
				<select name="<?php echo $this->get_field_name('title'); ?>">
					<option>Please choose a category</option>
					<?php
					foreach($allcategories as $category){
						$title == $category->cat_name ? $selected = "selected='selected'" : $selected = "";
						echo "<option $selected>".$category->cat_name."</option>";
					}
					?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('num_posts'); ?>">Number of posts to display:</label>
				<input id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" type="text" value="<?php echo $num_posts; ?>" length="2"/>
			</p>
			<!-- <p>
							<label for="<?php echo $this->get_field_id('suggested'); ?>">Only display suggested posts?</label>
							<input id="<?php echo $this->get_field_id('suggested'); ?>" name="<?php echo $this->get_field_name('suggested'); ?>" type="checkbox" <?= $suggested == true ? "checked" : "" ; ?> value="true"/>
						</p> -->
        <?php
	}
	
}
class messageWidget extends WP_Widget {
    /** constructor */
    function messageWidget() {
		$widget_ops = array('description' => 'This is used display a custom message (announcements, updates, etc).');
		$this->WP_Widget(false, __('Message'), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
		$title = $instance['title'];
		$message = $instance['message'];
		?>
		<div id="message_<?=$instance['title']?>" class="widget messagewidget">
			<h2><?= $title; ?></h2>
			<hr><div class="themessage">
				<?= $message; ?>
			</div>
		</div> 
	        <?php
	    }

	    /** @see WP_Widget::update */
	    function update($new_instance, $old_instance) {				
	        return $new_instance;
	    }

	    /** @see WP_Widget::form */
	    function form($instance) {				
	        $title = esc_attr($instance['title']);
			$message = esc_attr($instance['message']);
	        ?>
	            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
				<p><label for="<?php echo $this->get_field_id('message'); ?>">Message<input class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" type="text" value="<?php echo $message; ?>" /></label></p>
	        <?php 
	    }

	}
class tabWidget extends WP_Widget {
    /** constructor */
    function tabWidget() {
		$widget_ops = array('description' => 'This widget will display related posts (calculated by tags) and suggested posts (set manually by editor/poster).');
		$this->WP_Widget(false, __('Related / Suggested / Recent'), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
		global $category, $categoryparent, $thepostid, $post;
		$post->ID = $thepostid;
		extract( $args ); // extract arguments
		echo $before_widget;
		echo $before_title . "<div class=\"selected tab\" id=\"tab_related\" onclick=\"relatedsuggested_tab()\">Related</div> &nbsp; <div class=\" tab\" id=\"tab_suggested\" onclick=\"relatedsuggested_tab()\">Suggested</div>".$after_title;
		echo "<hr class=\"color_$categoryparent\">";
		
		//related
		$relatedposts = get_related_posts();
		if($relatedposts !== "<li>No Related Post</li>"){
			echo "<div id=\"related\">".$relatedposts."</div>";
		}else{
			echo "<div id=\"related\"><a href='#'>No related posts found</a></div>";
		}
		
		
		//suggested
		$args = array(
			'meta_key' => 'suggested',
			'meta_value'  => 'on',
			'post__not_in' => array($post->ID),
			'cat' => $category[0]->cat_ID,
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => 4
		);
		
		$tab = new WP_Query($args); 
		
		echo '<div id="suggested" style="display:none">';
		if ($tab->have_posts()) : while ($tab->have_posts()) : $tab->the_post();
			
			?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php
			
		endwhile;
		else :
			echo "<a href='#'>No suggested posts found</a>";
		endif;
		echo '&nbsp;</div>';
		echo $after_widget;
    }
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function form($instance) {				
		?>
		This widget will display related posts (calculated by tags) and suggested posts (set manually by editor/poster).
		<?php 
	}
	
}
class archivetabWidget extends WP_Widget {
    /** constructor */
    function archivetabWidget() {
		$widget_ops = array('description' => 'This widget will display recent posts in the same category and suggested posts (set manually by editor/poster).');
		$this->WP_Widget(false, __('Recent / Suggested (archive)'), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
		global $category, $categoryparent, $thepostid, $post;
		$post->ID = $thepostid;
		extract( $args ); // extract arguments
		echo $before_widget;
		echo $before_title . "<div class=\"selected tab\" id=\"tab_recent\" onclick=\"recentsuggested_tab()\">Recent</div> &nbsp; <div class=\" tab\" id=\"tab_suggested\" onclick=\"recentsuggested_tab()\">Suggested</div>".$after_title;
		echo "<hr class=\"color_$categoryparent\">";
		
		//recent
		$args = array(
			'cat' => $category->cat_ID,
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => 15
		);
		
		if(is_author()){
			$args['author'] = get_the_author_meta('ID');
		}
		
		$archivetab = new WP_Query($args);
		
		echo '<div id="recent">';
		if ($archivetab->have_posts()) : while ($archivetab->have_posts()) : $archivetab->the_post();
			
			?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php
			
		endwhile;
		endif;
		echo '&nbsp;</div>';
		//suggested
		$args = array(
			'meta_key' => 'suggested',
			'meta_value'  => 'on',
			'post__not_in' => array($post->ID),
			'cat' => $category->cat_ID,
			'orderby' => 'date',
			'order' => 'DESC',
			'posts_per_page' => 15
		);
		
		$archivetabsuggested = new WP_Query($args); 
		
		echo '<div id="suggested" style="display:none">';
		if ($archivetabsuggested->have_posts()) : while ($archivetabsuggested->have_posts()) : $archivetabsuggested->the_post();
			
			?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php
			
		endwhile;
		else :
			echo "<a href='#'>No suggested posts found</a>";
		endif;
		echo '&nbsp;</div>';
		echo $after_widget;
    }
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function form($instance) {				
		?>
		This widget will display recent posts in the same category and suggested posts (set manually by editor/poster).
		<?php 
	}
	
}
class authortabWidget extends WP_Widget {
    /** constructor */
    function authortabWidget() {
		$widget_ops = array('description' => 'This widget will display recent posts in the same category and suggested posts.');
		$this->WP_Widget(false, __('Recent / Suggested (author)'), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
		global $curauth;
		extract( $args ); // extract arguments
		echo $before_widget;
		echo $before_title . "<div class=\"selected tab\" id=\"tab_recent\" onclick=\"recentsuggested_tab()\">Recent</div> &nbsp; <div class=\" tab\" id=\"tab_suggested\" onclick=\"recentsuggested_tab()\">Suggested</div>".$after_title;
		echo "<hr class=\"color_$categoryparent\">";
		
		//recent
		$args = array(
			'cat' => $category->cat_ID,
			'orderby' => 'date',
			'order' => 'DESC',
			'author' => $curauth->ID,
			'posts_per_page' => 15
		);
		
		$archivetab = new WP_Query($args);
		
		echo '<div id="recent">';
		if ($archivetab->have_posts()) : while ($archivetab->have_posts()) : $archivetab->the_post();
			
			?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php
			
		endwhile;
		endif;
		echo '&nbsp;</div>';
		//suggested
		$args = array(
			'meta_key' => 'suggested',
			'meta_value'  => 'on',
			'post__not_in' => array($post->ID),
			'cat' => $category->cat_ID,
			'orderby' => 'date',
			'order' => 'DESC',
			'author' => $curauth->ID,
			'posts_per_page' => 15
		);
		
		$archivetabsuggested = new WP_Query($args); 
		
		echo '<div id="suggested" style="display:none">';
		if ($archivetabsuggested->have_posts()) : while ($archivetabsuggested->have_posts()) : $archivetabsuggested->the_post();
			
			?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php
			
		endwhile;
		else :
			echo "<a href='#'>No suggested posts found</a>";
		endif;
		echo '&nbsp;</div>';
		echo $after_widget;
    }
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function form($instance) {				
		?>
		This widget will display recent posts in the same category and suggested posts (set manually by editor/poster).
		<?php 
	}
	
}
function acWidgetsInit(){
 	register_widget('authorWidget');
	register_widget('categoryWidget');
	register_widget('tabWidget');
	register_widget('archivetabWidget');
	register_widget('authortabWidget');
	register_widget('messageWidget');
	register_widget('frontCategoryWidget');
}

add_action('widgets_init', 'acWidgetsInit');

function unregister_default_wp_widgets() {
 
	unregister_widget('WP_Widget_Pages');
 
	unregister_widget('WP_Widget_Calendar');
 
	unregister_widget('WP_Widget_Archives');
 
	unregister_widget('WP_Widget_Links');
 
	unregister_widget('WP_Widget_Meta');
 
	unregister_widget('WP_Widget_Search');
 
	unregister_widget('WP_Widget_Text');
 
	unregister_widget('WP_Widget_Categories');
 
	unregister_widget('WP_Widget_Recent_Posts');
 
	unregister_widget('WP_Widget_Recent_Comments');
 
	unregister_widget('WP_Widget_RSS');
 
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('widget_sidebar_wp_related_posts');
}
 
add_action('widgets_init', 'unregister_default_wp_widgets', 1);
?>