<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class FrontPage extends Controller
{
    public function featured_posts() {
        $args = array(
			'meta_key' => 'featured_front',
            'meta_value'  => 'on',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 3
	    );
	    $the_query = new WP_Query( $args );
	    return $the_query->posts;
    }
}
