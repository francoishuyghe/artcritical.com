<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});


// OLD PHP


// include 'lib/side_widgets.php';
// include 'lib/functions.php';
// include 'lib/customadmin.php';
add_theme_support( 'post-thumbnails' );
add_image_size('featured_inside', 275, 205, true);
add_image_size('featured_front', 370, 324, true);

update_option('image_default_link_type','file');

//Link Review Panel Widget to categories
function add_template_category($t){
	foreach( (array) get_the_category() as $cat ) { 
		$tempcat = $cat->slug;
		$trpcategories = array('podcast', 'latest-podcast', 'the-review-panel', 'review-panel-news', 'review-panel-special');
		if ( in_array($tempcat, $trpcategories) ) 
				return TEMPLATEPATH . "/single-cat-reviewpanel.php"; } 
		return $t;
}
add_filter('single_template', __NAMESPACE__ . '\\add_template_category');


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
add_action( 'init', __NAMESPACE__.'\\wpcodex_add_authors_for_listings' );






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
