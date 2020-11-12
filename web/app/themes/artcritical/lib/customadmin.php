<?php
function artcritical_inner_custom_box() {
	global $post;
	// Use nonce for verification
	echo '<input type="hidden" name="artcritical_noncename" id="artcritical_noncename" value="' . 
	  wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$featured = get_post_meta($post->ID, 'featured', true);
	$featured_front = get_post_meta($post->ID, 'featured_front', true);
	$suggested = get_post_meta($post->ID, 'suggested', true);
    $newsletter = get_post_meta($post->ID, 'newsletter', true);
    $newsletter_intro = get_post_meta($post->ID, 'newsletter_intro', true);
    $newsletter_cover = get_post_meta($post->ID, 'newsletter_cover', true);
	?>
	<table>
		<tr>
			<td><label for="artcritical_suggested">Suggested: </label></td>
			<td><input type="checkbox" name="artcritical_suggested" <?= $suggested == 'on' ? 'checked=checked' :  ''  ?>/></td>
		</tr>
		<tr>
			<td><label for="artcritical_featured">Featured: </label></td>
			<td><input type="checkbox" name="artcritical_featured" <?= $featured == 'on' ? 'checked=checked' :  ''  ?>/></td>
		</tr>
		<tr>
			<td><label for="artcritical_featured">Featured (front page): </label></td>
			<td><input type="checkbox" name="artcritical_featured_front" <?= $featured_front == 'on' ? 'checked=checked' :  ''  ?>/></td>
		</tr>
        <tr>
			<td><label for="artcritical_newsletter">Newsletter: </label></td>
			<td><input type="checkbox" name="artcritical_newsletter" <?= $newsletter == 'on' ? 'checked=checked' :  ''  ?>/></td>
		</tr>
        <tr>
			<td><label for="artcritical_newsletter_cover">Newsletter Cover: </label></td>
			<td><input type="checkbox" name="artcritical_newsletter_cover" <?= $newsletter_cover == 'on' ? 'checked=checked' :  ''  ?>/></td>
		</tr>
        <tr>
			<td><label for="artcritical_newsletter_intro">Newsletter Intro: </label></td>
			<td><input type="checkbox" name="artcritical_newsletter_intro" <?= $newsletter_intro == 'on' ? 'checked=checked' :  ''  ?>/></td>
		</tr>
	</table>
	<?php
}
function artcritical_inner_notes() {
	global $post;
	// Use nonce for verification
	echo '<input type="hidden" name="artcritical_noncename" id="artcritical_noncename" value="' . 
	  wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$notes = get_post_meta($post->ID, 'notes', true);
	?>
	<textarea name="ac_notes" rows="8" cols="28"><?= $notes; ?></textarea>
	<?php
}

function artcritical_save_postdata( $post_id ) {
	
	$thepost = get_post($post_id);
	
	if($thepost->post_type == "cover"){
		update_option('latest_cover', $post_id);
	}

	//if ( !wp_verify_nonce( $_POST['artcritical_noncename'], plugin_basename(__FILE__) )) {
	  return $post_id;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
	  return $post_id;

	if ( !current_user_can( 'edit_post', $post_id ) )
	    return $post_id;
	
	$featured = $_POST['artcritical_featured'];
	if($featured == 'on'){
		update_post_meta($post_id, 'featured', 'on');
	}else{
		if(get_post_meta($post_id, 'featured', true) == 'on')
			delete_post_meta($post_id, 'featured');
	}
	$featured_front = $_POST['artcritical_featured_front'];
	if($featured_front == 'on'){
		update_post_meta($post_id, 'featured_front', 'on');
	}else{
		if(get_post_meta($post_id, 'featured_front', true) == 'on')
			delete_post_meta($post_id, 'featured_front');
	}
	$suggested = $_POST['artcritical_suggested'];
	if($suggested == 'on'){
		update_post_meta($post_id, 'suggested', 'on');
	}else{
		if(get_post_meta($post_id, 'suggested', true) == 'on')
			delete_post_meta($post_id, 'suggested');
	}
    $newsletter = $_POST['artcritical_newsletter'];
	if($newsletter == 'on'){
		update_post_meta($post_id, 'newsletter', 'on');
	}else{
		if(get_post_meta($post_id, 'newsletter', true) == 'on')
			delete_post_meta($post_id, 'newsletter');
	}
    $newsletter_intro = $_POST['artcritical_newsletter_intro'];
	if($newsletter_intro == 'on'){
		update_post_meta($post_id, 'newsletter_intro', 'on');
	}else{
		if(get_post_meta($post_id, 'newsletter_intro', true) == 'on')
			delete_post_meta($post_id, 'newsletter_intro');
	}
    $newsletter_cover = $_POST['artcritical_newsletter_cover'];
    if($newsletter_cover == 'on'){
		update_post_meta($post_id, 'newsletter_cover', 'on');
	}else{
		if(get_post_meta($post_id, 'newsletter_cover', true) == 'on')
			delete_post_meta($post_id, 'newsletter_cover');
	}
	$featured = $_POST['artcritical_featured_calendar'];
	if($featured == 'on'){
		update_post_meta($post_id, 'featured_calendar', 'on');
        update_post_meta($post_id, 'featured_date', $_POST['artcritical_featured_date']);
	}else{
		if(get_post_meta($post_id, 'featured_calendar', true) == 'on')
			delete_post_meta($post_id, 'featured_calendar');
            delete_post_meta($post_id, 'featured_date');
	}
	$featured = $_POST['artcritical_featured_show'];
	if($featured == 'on'){
		update_post_meta($post_id, 'featured_show', 'on');
	}else{
		if(get_post_meta($post_id, 'featured_show', true) == 'on')
			delete_post_meta($post_id, 'featured_show');
	}
	$featured = $_POST['artcritical_featured_venue'];
	if($featured == 'on'){
		update_post_meta($post_id, 'featured_venue', 'on');
	}else{
		if(get_post_meta($post_id, 'featured_venue', true) == 'on')
			delete_post_meta($post_id, 'featured_venue');
	}
	$featured = $_POST['artcritical_featured_neighborhood'];
	if($featured == 'on'){
		update_post_meta($post_id, 'featured_neighborhood', 'on');
	}else{
		if(get_post_meta($post_id, 'featured_neighborhood', true) == 'on')
			delete_post_meta($post_id, 'featured_neighborhood');
	}
	$featured = $_POST['artcritical_featured_events'];
	if($featured == 'on'){
		update_post_meta($post_id, 'featured_events', 'on');
	}else{
		if(get_post_meta($post_id, 'featured_events', true) == 'on')
			delete_post_meta($post_id, 'featured_events');
	}
	$notes = $_POST['ac_notes'];
	if($notes !== ''){
		update_post_meta($post_id, 'notes', $notes);
	}
	
}



function ac_front_page(){
	if(!empty($_POST['next_review_panel'])){
		update_option('top_menu_options', serialize($_POST));
		$options = get_option('top_menu_options');
	}else{
		$options = unserialize(get_option('top_menu_options'));
	}
	
	?>
	<link type="text/css" rel="stylesheet" href="<?php echo get_option('siteurl').'/wp-content/plugins/events-calendar/css/';?>/ui.datepicker.css" />
	
	<div class="wrap">
		<h2>Artcritical Theme Options</h2>
		<form method="post">	
			<table>
				<tr>
					<td><label for="artcritical_featured">Review Panel Link Text: </label></td>
					<td><input type="text" name="next_review_panel_text" value="<?php echo $options['next_review_panel_text']; ?>" size="60"></td>
				</tr>
				<tr>
					<td><label for="artcritical_featured">Review Panel On: </label></td>
					<td><input type="text" id="datepickerstart" name="next_review_panel" value="<?php echo $options['next_review_panel']; ?>" size="60"></td>
				</tr>
				<tr>
					<td><label for="artcritical_featured">Review Panel Link: </label></td>
					<td><input type="text" name="next_review_panel_link" value="<?php echo $options['next_review_panel_link']; ?>" size="60"></td>
				</tr>
			</table>
		<input type="submit" value="Save Changes">
		</form>
	<?php
	echo '</div>';
}

add_action('save_post', 'artcritical_save_postdata');

$coverargs = array(
	'label' => __('Cover Images'),
	'singular_label' => __('Cover Image'),
	'public' => true,
	'show_ui' => true,
	'_edit_link' => 'post.php?post=%d',
	'capability_type' => 'page',
	'hierarchical' => false,
	'rewrite' => true,
	'query_var' => 'cover',
	'supports' => array('title', 'thumbnail', 'editor', 'excerpt')
);
$listingargs = array(
	'label' => __('Listings'),
	'singular_label' => __('Listing'),
	'public' => true,
	'show_ui' => true,
	'_edit_link' => 'post.php?post=%d',
	'capability_type' => 'page',
	'hierarchical' => false,
	'rewrite' => true,
	'query_var' => 'listing',
	'supports' => array('title', 'thumbnail', 'excerpt')
);
$venueargs = array(
	'label' => __('Venues'),
	'singular_label' => __('Venue'),
	'public' => true,
	'show_ui' => true,
	'_edit_link' => 'post.php?post=%d',
	'capability_type' => 'page',
	'hierarchical' => false,
	'rewrite' => true,
	'query_var' => 'venue',
	'supports' => array('title', 'thumbnail')
);
$neighborhoodargs = array( 
	'hierarchical' => 0, 
	'label' => 'Neighborhood',
	'show_ui' => '1',
	'query_var' => 'neighborhood',
	'rewrite' => '1',
	'singular_label' => 'Neighborhood'
);
$areaargs = array( 
	'hierarchical' => 0, 
	'label' => 'Area',
	'show_ui' => '1',
	'query_var' => 'Area',
	'rewrite' => '1',
	'singular_label' => 'Area'
);
$artistsargs = array( 
	'hierarchical' => 0, 
	'label' => 'Artist(s)',
	'show_ui' => '1',
	'query_var' => 'artists',
	'rewrite' => '1',
	'singular_label' => 'Artist(s)'
);

sd_register_post_type( 'cover' , $coverargs);
sd_register_post_type( 'listing' , $listingargs);
sd_register_post_type( 'venue' , $venueargs);
register_taxonomy('neighborhoods', 'venue', $neighborhoodargs);




add_action('admin_enqueue_scripts', 'poll_scripts_admin');
function poll_scripts_admin($hook_suffix) {
	?>
	<?php
	wp_enqueue_script('jqueryuidatepicker', '/wp-content/plugins/events-calendar/js/ui.datepicker.js', 1);
}

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<table class="form-table">

		<tr>
			<th><label for="twitter">Featured on menu?</label></th>

			<td>
				<input type="checkbox" name="on_menu" id="on_menu" <?= get_the_author_meta( 'on_menu', $user->ID ) == 'on' ? "checked=checked" : '' ; ?> class="regular-text" /><br />
			</td>
		</tr>

	</table>
<?php 
}

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );





function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'on_menu', $_POST['on_menu'] );
}

// if(!is_admin()){ // make sure the filters are only called in the frontend
//   function comma_tag_filter($tag_arr){
//     $tag_arr_new = $tag_arr;
//     if($tag_arr->taxonomy == 'post_tag' && strpos($tag_arr->name, '|')){
//         $tag_arr_new->name = str_replace('|',', ',$tag_arr->name);
//     }
//     return $tag_arr_new;  
      
//   }
//   add_filter('get_post_tag', comma_tag_filter);

//   function comma_tags_filter($tags_arr){
//     $tags_arr_new = array();
//     foreach($tags_arr as $tag_arr){
//         $tags_arr_new[] = comma_tag_filter($tag_arr);
//     }
//     return $tags_arr_new;
//   }
//   add_filter('get_terms', comma_tags_filter);
//   add_filter('get_the_terms', comma_tags_filter);
// }

?>