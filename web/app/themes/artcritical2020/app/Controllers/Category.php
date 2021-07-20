<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class Category extends Controller
{
    public function featured_posts() {
        $category = get_queried_object();
    
        $args = array(
            'meta_key' => 'featured',
            'meta_value'  => 'on',
            'cat' => $category->term_id,
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 3
        );
        
	    $the_query = new WP_Query( $args );
	    return $the_query->posts;
    }
}