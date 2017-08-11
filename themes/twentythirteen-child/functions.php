<?php

// Enqueue the parent and child theme stylesheets,
// as seen here https://developer.wordpress.org/themes/advanced-topics/child-themes/#3-enqueue-stylesheet
function ttc_theme_enqueue_styles() {
    $parent_style = 'twentythirteen-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'ttc_theme_enqueue_styles' );

// Make the Snippet CPT posts show up on the blog feed.
function add_snippet_cpt_to_query( $query ) {
	if(
		$query->is_home() &&
		empty( $query->query_vars['suppress_filters'] )
	) {
		$query->set( 'post_type', array(
			'post',
			'snippet'
		) );
	}
}
add_filter( 'pre_get_posts', 'add_snippet_cpt_to_query' );
