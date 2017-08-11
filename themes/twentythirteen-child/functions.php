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
