<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

// Older Cover functions
function cover_post_init() {
    $args = array(
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
      
    register_post_type( 'Cover', $args );
}
add_action( 'init', __NAMESPACE__.'\\cover_post_init' );