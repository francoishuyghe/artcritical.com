<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    public static function get_myauthor_link($name){
        $base = get_option('url');
        return $base."/author/".$name;
    }

    public static function postimage($size = 'medium', $return = 'url') {

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
}
