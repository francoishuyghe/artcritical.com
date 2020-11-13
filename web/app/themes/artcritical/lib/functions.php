<?php

#HELPY FUNCTIONS
function array_split($array, $pieces = 2){  
    if ($pieces < 2)
        return array($array);
    $newCount = ceil(count($array)/$pieces);
    $a = array_slice($array, 0, $newCount);
    $b = array_split(array_slice($array, $newCount), $pieces-1);
    return array_merge(array($a),$b);
}
function post_strip($where) {
	global $featuredposts, $wpdb;
	$where .= " AND $wpdb->posts.ID not in($featuredposts) "; 
	return $where;
}
function postimage($size = 'medium', $return = 'url') {
	global $post;
	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size, false, '' );
	
	if(!empty($src[0]) && $return !== 'image'){
		return $src[0];	
	}else{
		if ( $images = get_children(array(
			'post_parent' => get_the_ID(),
			'post_type' => 'attachment',
			'numberposts' => 1,
			'post_mime_type' => 'image',)))
		{
			foreach( $images as $image ) {
				$attachmenturl=wp_get_attachment_url($image->ID);
				$attachmentimage=wp_get_attachment_image( $image->ID, $size );
				//$image = wp_get_attachment_image_src($image->ID, $size, false); 

				if($return == 'url'){
					return $attachmenturl;
				}else{
					return $attachmentimage;	
				}

			}
		}else{
			return false;
		}
	}
	
}
function get_fronttop3_excerpt($limit = 17){
	$textcontent = get_the_excerpt();
	$content = apply_filters('the_content', $textcontent);
	$content = str_replace(']]>', ']]&gt;', $content);
	$words = explode(' ', strip_tags($content));
	return implode(' ', array_slice($words, 0, $limit))."...";
}

function get_newsletter_excerpt(){
	$textcontent = get_the_excerpt();
	$content = apply_filters('the_content', $textcontent);
	$content = str_replace(']]>', ']]&gt;', $content);
	$words = explode(' ', strip_tags($content));
	return implode(' ', array_slice($words, 0, 50));
}

function get_top3_excerpt(){
	$textcontent = get_the_excerpt();
	$content = apply_filters('the_content', $textcontent);
	$content = str_replace(']]>', ']]&gt;', $content);
	$words = explode(' ', strip_tags($content));
	return implode(' ', array_slice($words, 0, 40))."...";
}
function get_cat_slug($cat_id) {
	$cat_id = (int) $cat_id;
	$category = get_category($cat_id);
	return $category->slug;
}

function get_archive_link($category){
	$base = get_option('siteurl');
	$categoryparent = get_cat_slug($category->parent);
	return $base."/category/".$categoryparent."/".$category->slug."/";
}
function get_myauthor_link($name){
	$base = get_option('siteurl');
	return $base."/author/".$name;
}
function get_venue_link($id){
	$title = get_the_title($id);
	$link = get_permalink($id);
	return "<a href=\"$link\">".$title."</a>";
}

//stolen from plugin of the same name
function get_related_posts($before_title="",$after_title="") {	
	global $wpdb, $post,$table_prefix;	
	
	$q = 'SELECT tt.term_id FROM '. $table_prefix .'term_taxonomy tt, ' . $table_prefix . 'term_relationships tr WHERE tt.taxonomy = \'category\' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id = '.$post->ID;

	$cats = $wpdb->get_results($q);
		
	if(!$post->ID){return;}
	$now = current_time('mysql', 1);
	$tags = wp_get_post_tags($post->ID);
	
	$taglist = "'" . $tags[0]->term_id. "'";
	
	$tagcount = count($tags);
	if ($tagcount > 1) {
		for ($i = 1; $i < $tagcount; $i++) {
			$taglist = $taglist . ", '" . $tags[$i]->term_id . "'";
		}
	}
	
	$limitclause = "LIMIT 10";

	$q = "SELECT p.ID, p.post_title, p.post_content,p.post_excerpt, p.post_date,  p.comment_count, count(t_r.object_id) as cnt FROM $wpdb->term_taxonomy t_t, $wpdb->term_relationships t_r, $wpdb->posts p WHERE t_t.taxonomy ='post_tag' AND t_t.term_taxonomy_id = t_r.term_taxonomy_id AND t_r.object_id  = p.ID AND (t_t.term_id IN ($taglist)) AND p.ID != $post->ID AND p.post_status = 'publish' AND p.post_date_gmt < '$now' GROUP BY t_r.object_id ORDER BY cnt DESC, p.post_date_gmt DESC $limitclause;";
	
	$related_posts = $wpdb->get_results($q);
	
	$output = "";
	
	if (!$related_posts){
		if(!$wp_no_rp_text) $wp_no_rp_text= __("No Related Post",'wp_related_posts');
		$output  .= '<li>'.$wp_no_rp_text .'</li>';
	}
	
	foreach ($related_posts as $related_post ){
			$output .=  '<a href="'.get_permalink($related_post->ID).'" title="'.wptexturize($related_post->post_title).'">'.wptexturize($related_post->post_title).'</a>';
	}
	
	return $output;
}

/*
 * Copyright 2010 Matt Wiebe.
 *
 * This code is licensed under the GPL v2.0
 * http://www.opensource.org/licenses/gpl-2.0.php
 *
 * If you do something cool with it, let me know! http://somadesign.ca/contact/
 * 
 */

/**
 * SD_Register_Post_Type class
 *
 * @author Matt Wiebe
 * @link http://somadesign.ca
 * 
 * @param string $post_type The post type to register
 * @param array $args The arguments to pass into @link register_post_type(). Some defaults provided to ensure the UI is available.
 * @param string $custom_plural The plural name to be used in rewriting (http://yourdomain.com/custom_plural/ ). If left off, an "s" will be appended to your post type, which will break some words. (person, box, ox. Oh, English.)
 **/

if ( ! class_exists('SD_Register_Post_Type') ) {

	class SD_Register_Post_Type {

		private $post_type;
		private $post_slug;
		private $args;

		private $defaults = array(
			'show_ui' => true,
			'public' => true,
			'supports' => array('title', 'editor', 'thumbnail')
		);

		public function __construct( $post_type = null, $args=array(), $custom_plural = false ) {
			if ( $post_type ) {
				$this->post_type = $post_type;
				$this->args = wp_parse_args($args, $this->defaults);
				// Uppercase the post type for label if there isn't one
				if ( ! $this->args['label'] ) {
					$this->args['label'] = ucwords($post_type);
				}
				$this->post_slug = ( $custom_plural ) ? $custom_plural : $post_type . 's';

				$this->add_actions();
				$this->add_filters();
			}
		}

		public function add_actions() {
			add_action( 'init', array($this, 'register_post_type'));
			add_action('template_redirect', array($this, 'context_fixer') );
		}

		public function add_filters() {

			add_filter( 'generate_rewrite_rules', array($this, 'add_rewrite_rules') );
			add_filter( 'template_include', array($this, 'template_include') );
			add_filter( 'post_class', array($this, 'post_classes') );
			add_filter( 'body_class', array($this, 'body_classes') );
		}
		
		public function context_fixer() {
			if ( get_query_var( 'post_type' ) == $this->post_type ) {
				global $wp_query;
				$wp_query->is_home = false;
			}
		}

		public function add_rewrite_rules( $wp_rewrite ) {
			$new_rules = array();
			$new_rules[$this->post_slug . '/page/?([0-9]{1,})/?$'] = 'index.php?post_type=' . $this->post_type . '&paged=' . $wp_rewrite->preg_index(1);
			$new_rules[$this->post_slug . '/?$'] = 'index.php?post_type=' . $this->post_type;

			$wp_rewrite->rules = array_merge($new_rules, $wp_rewrite->rules);
			return $wp_rewrite;
		}

		public function register_post_type() {
			register_post_type( $this->post_type, $this->args );		
		}

		public function template_include( $template ) {
			if ( get_query_var('post_type') == $this->post_type ) {

				if ( is_single() ) {
					return locate_template( array( 
						'single-'.$this->post_type . '.php', 
						'single.php', 
						'index.php' 
					));
				}
				// loop
				return locate_template( array( 
					$this->post_type . '.php', 
					'index.php' 
				));

			}
			return $template;
		}

		public function post_classes( $c ) {
			global $post;

			if ( $post->post_type === $this->post_type ) {
				$c[] = $this->post_type;
				$c[] = 'post_type-' . $this->post_type;
			}
			return $c;
		}

		public function body_classes( $c ) {
			if ( get_query_var('post_type') === $this->post_type ) {
				$c[] = $this->post_type;
				$c[] = 'post_type-' . $this->post_type;
			}
			return $c;
		}


	} // end SD_Register_Post_Type class
	
	/**
	 * A helper function for the SD_Register_Post_Type class. Because typing "new" is hard.
	 *
	 * @author Matt Wiebe
	 * @link http://somadesign.ca
	 * 
	 * @uses SD_Register_Post_Type class
	 * @param string $post_type The post type to register
	 * @param array $args The arguments to pass into @link register_post_type(). Some defaults provided to ensure the UI is available.
	 * @param string $custom_plural The plural name to be used in rewriting (http://yourdomain.com/custom_plural/ ). If left off, an "s" will be appended to your post type, which will break some words. (person, box, ox. Oh, English.)
	 **/

	if ( ! function_exists( 'sd_register_post_type' ) && class_exists( 'SD_Register_Post_Type' ) ) {
		function sd_register_post_type( $post_type = null, $args=array(), $custom_plural = false ) {
			$custom_post = new SD_Register_Post_Type( $post_type, $args, $custom_plural );
		}
	}

}

?>