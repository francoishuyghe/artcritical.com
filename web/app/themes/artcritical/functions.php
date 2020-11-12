<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
//include 'lib/side_widgets.php';
include 'lib/functions.php';
include 'lib/customadmin.php';
add_theme_support( 'post-thumbnails' );
add_image_size('featured_inside', 275, 205, true);
add_image_size('featured_front', 370, 324, true);

// add_filter('query_vars', 'parameter_queryvars' );
// function parameter_queryvars( $qvars ){
// 	$qvars[] = 'tag';
// 	return $qvars;
// }

update_option('image_default_link_type','file');


function my_scripts() {
	
	
}

add_action( 'wp_enqueue_scripts', 'my_scripts' );


//Link Review Panel Widget to categories
function add_template_category($t){
	foreach( (array) get_the_category() as $cat ) { 
		$tempcat = $cat->slug;
		$trpcategories = array('podcast', 'latest-podcast', 'the-review-panel', 'review-panel-news', 'review-panel-special');
		if ( in_array($tempcat, $trpcategories) ) 
				return TEMPLATEPATH . "/single-cat-reviewpanel.php"; } 
		return $t;
}
add_filter('single_template', 'add_template_category');


function get_menu(){
	global $wpdb;
	$options = unserialize(get_option('top_menu_options'));
	?>
	<div id="menu">
		<ul>
            <li class="color_thelist menuitem-listing" id="thelist-ddheader" onmouseover="ddMenu('thelist',1)" onmouseout="ddMenu('thelist',-1)">The List</li>
			<li class="color_criticism" id="criticism-ddheader" onmouseover="ddMenu('criticism',1)" onmouseout="ddMenu('criticism',-1)">Criticism</li>
			<li class="color_features" id="features-ddheader" onmouseover="ddMenu('features',1)" onmouseout="ddMenu('features',-1)">Features</li>
			<li class="color_artworld" id="artworld-ddheader" onmouseover="ddMenu('artworld',1)" onmouseout="ddMenu('artworld',-1)">Art World</li>
			<li class="color_departments" id="departments-ddheader" onmouseover="ddMenu('departments',1)" onmouseout="ddMenu('departments',-1)">Departments</li>
			<li class="color_reviewpanel" id="reviewpanel-ddheader" onmouseover="ddMenu('reviewpanel',1)" onmouseout="ddMenu('reviewpanel',-1)">The Review Panel</li>
		</ul>
        <div class="tl_dropdown" id="thelist-ddcontent" onmouseover="cancelHide('thelist')" onmouseout="ddMenu('thelist',-1)" >
			<a href="https://list.artcritical.com">Week at a Glance</a>
            <a href="https://list.artcritical.com/current">Current</a>
            <a href="https://list.artcritical.com/events">Lectures/Events</a>
		</div>
	
		<div class="cr_dropdown" id="criticism-ddcontent" onmouseover="cancelHide('criticism')" onmouseout="ddMenu('criticism',-1)">
			<?
			$cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=11&echo=0');
			$cats = str_replace("<br />","",$cats);
			echo $cats;
			?>
			<div class="subhead">Regular writers include:</div>
			<div class="submenu">
			<?php
			//CAST(`pm`.`meta_value` AS UNSIGNED)
			$ud = $wpdb->get_results("SELECT * FROM $wpdb->users INNER JOIN $wpdb->usermeta ON ($wpdb->users.ID = $wpdb->usermeta.user_id) WHERE $wpdb->usermeta.meta_key = 'on_menu' AND $wpdb->usermeta.meta_value = 'on' ORDER BY $wpdb->usermeta.meta_value ASC");
			foreach($ud as $user){
				$userdata = get_userdata($user->ID);
				if ($userdata->last_name != ""){
					echo "<a href=\"".get_myauthor_link($userdata->user_nicename)."\">".$userdata->display_name."</a>";
				}
			}
			
			?>
			<a href="http://artcritical.com/browse/?tab=byauthor">More...</a>
			</div>
		</div>
		<div class="fe_dropdown" id="features-ddcontent" onmouseover="cancelHide('features')" onmouseout="ddMenu('features',-1)" >
			<?
			$cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=12&echo=0');
			$cats = str_replace("<br />","",$cats);
			echo $cats;
			?>
		</div>
		<div class="aw_dropdown" id="artworld-ddcontent" onmouseover="cancelHide('artworld')" onmouseout="ddMenu('artworld',-1)" >
			<?
			$cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=13&echo=0');
			$cats = str_replace("<br />","",$cats);
			echo $cats;
			?>
		</div>
		<div class="de_dropdown" id="departments-ddcontent" onmouseover="cancelHide('departments')" onmouseout="ddMenu('departments',-1)" >
			<?
			$cats = wp_list_categories('orderby=&title_li=&style=none&hide_empty=0&child_of=14&echo=0');
			$cats = str_replace("<br />","",$cats);
			echo $cats;
			?>
			<a href="<?php bloginfo('url')?>/listings-week">The List</a>
		</div>
		<div class="rp_dropdown" id="reviewpanel-ddcontent" onmouseover="cancelHide('reviewpanel')" onmouseout="ddMenu('reviewpanel',-1)" >
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
        
	<?
}
function new_excerpt_more($more) {
	return '...';
}

add_filter('excerpt_more', 'new_excerpt_more');

function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS ['comment'] = $comment; ?>
	<?php if ( '' == $comment->comment_type ) : ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'twentyten' ), get_comment_author_link() ); ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ),'  ','' ); ?></div>

		<div class="comment-body"><?php comment_text(); ?></div>
		
		
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
	</div>

	<?php else : ?>
	<li class="post pingback">
		<p><?php _e( 'Pingback: ', 'twentyten' ); ?><?php comment_author_link(); ?><?php edit_comment_link ( __('edit', 'twentyten'), '&nbsp;&nbsp;', '' ); ?></p>
	<?php endif;
}

function remove_podpress_from_automatic_excerpts() {
    /* This function removes podPress elements from post content on the homepage of the blog. It helps especially if the home page shows only excerpts of the posts.*/
        global $podPress;
            remove_filter('the_content', array(&$podPress, 'insert_content'));
}

add_filter('relevanssi_modify_wp_query', 'rlv_meta_fix', 99);
function rlv_meta_fix($q) {
	$q->set('meta_query', '');
	return $q;
}

add_filter('relevanssi_match', 'rlv_author_boost', 11, 2);
function rlv_author_boost($match, $idf) {
	$title_boost = floatval(get_option('relevanssi_title_boost'));
	$link_boost = floatval(get_option('relevanssi_link_boost'));
	$comment_boost = floatval(get_option('relevanssi_comment_boost'));

	$match->tf =
		$match->title * $title_boost +
		$match->content +
		$match->comment * $comment_boost +
		$match->link * $link_boost +
		$match->author * 100 +
		$match->excerpt +
		$match->taxonomy_score +
		$match->customfield +
		$match->mysqlcolumn;
	$match->weight = $match->tf * $idf;
	return $match;
}

/**
 * Enables the Author box in listings
 */
function wpcodex_add_authors_for_listings() {
	add_post_type_support( 'listing', 'author' );
    add_post_type_support( 'venue', 'author' );
}
add_action( 'init', 'wpcodex_add_authors_for_listings' );






// filter for tags with comma
//  replace '|' with ', ' in the output - allow tags with comma this way
//  e.g. save tag as "Fox|Peter" but display thx 2 filters like "Fox, Peter"
// NOTE: Disabled for now. Inline code seperates the fake commas currently
/*if(!is_admin()){ // make sure the filters are only called in the frontend
    function comma_tag_filter($tag_arr){
        $tag_arr_new = $tag_arr;
        if($tag_arr->taxonomy == 'post_tag' && strpos($tag_arr->name, '|')){
            $tag_arr_new->name = str_replace('|',', ',$tag_arr->name);
        }
        return $tag_arr_new;    
    }
    add_filter('get_post_tag', 'comma_tag_filter');

    function comma_tags_filter($tags_arr){
        $tags_arr_new = array();
        foreach($tags_arr as $tag_arr){
            $tags_arr_new[] = comma_tag_filter($tag_arr);
        }
        return $tags_arr_new;
    }
    add_filter('get_terms', 'comma_tags_filter');
    add_filter('get_the_terms', 'comma_tags_filter');
}*/



/**
 * Allow hypenated usernames
 *
 * @wp-hook wpmu_validate_user_signup
 * @param   array $result
 * @return  array
 */
function wpse_59760_allow_hyphenated_usernames( $result ) {
  $error_name = $result[ 'errors' ]->get_error_message( 'user_name' );
  if ( ! empty ( $error_name ) 
      && $error_name == __( 'Only lowercase letters (a-z) and numbers are allowed.' ) 
      && $result['user_name'] == $result['orig_username'] 
      && ! preg_match( '/[^-a-z0-9]/', $result['user_name'] ) 
  ) {
    unset ( $result[ 'errors' ]->errors[ 'user_name' ] );
    return $result;
  }
  else {
    return $result;
  }
}
add_filter( 'wpmu_validate_user_signup', 'wpse_59760_allow_hyphenated_usernames' );


?>
