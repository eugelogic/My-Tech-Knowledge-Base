<?php
/**
 * Twenty Thirteen custom taxonomies
 *
 * Prevents Twenty Thirteen from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backward compatible and relies on
 * many new functions and markup changes introduced in 3.6.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

function create_tech_kb_taxonomies(){
/**
 *
 * Coding language custom taxonomy.
 *
 */
 $labels = array(
      'name'              => _x( 'Languages', 'taxonomy general name', 'twentythirteen-child' ),
      'singular_name'     => _x( 'Language', 'taxonomy singular name', 'twentythirteen-child' ),
      'search_items'      => __( 'Search Languages', 'twentythirteen-child' ),
      'all_items'         => __( 'All Languages', 'twentythirteen-child' ),
      'parent_item'       => __( 'Parent Language', 'twentythirteen-child' ),
      'parent_item_colon' => __( 'Parent Language:', 'twentythirteen-child' ),
      'edit_item'         => __( 'Edit Language', 'twentythirteen-child' ),
      'update_item'       => __( 'Update Language', 'twentythirteen-child' ),
      'add_new_item'      => __( 'Add New Language', 'twentythirteen-child' ),
      'new_item_name'     => __( 'New Language Name', 'twentythirteen-child' ),
      'menu_name'         => __( 'Language', 'twentythirteen-child' ),
    );

$args = array(
   'hierarchical'      => true,
   'labels'            => $labels,
   'show_ui'           => true,
   'show_admin_column' => true,
   'query_var'         => true,
   'rewrite'           => array( 'slug' => 'language', 'with_front' => true ),
 );

register_taxonomy( 'language', array( 'post', 'snippet', 'video' ), $args );

unset( $args );
unset( $labels );

/**
 *
 * Web tool custom taxonomy.
 *
 */
$labels = array(
     'name'              => _x( 'Tools', 'taxonomy general name', 'twentythirteen-child' ),
     'singular_name'     => _x( 'Tool', 'taxonomy singular name', 'twentythirteen-child' ),
     'search_items'      => __( 'Search Tools', 'twentythirteen-child' ),
     'all_items'         => __( 'All Tools', 'twentythirteen-child' ),
     'parent_item'       => __( 'Parent Tool', 'twentythirteen-child' ),
     'parent_item_colon' => __( 'Parent Tool:', 'twentythirteen-child' ),
     'edit_item'         => __( 'Edit Tool', 'twentythirteen-child' ),
     'update_item'       => __( 'Update Tool', 'twentythirteen-child' ),
     'add_new_item'      => __( 'Add New Tool', 'twentythirteen-child' ),
     'new_item_name'     => __( 'New Tool Name', 'twentythirteen-child' ),
     'menu_name'         => __( 'Tool', 'twentythirteen-child' ),
 );

$args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'tool', 'with_front' => true ),
);

register_taxonomy( 'tool', array( 'post', 'snippet', 'video' ), $args );

unset( $args );
unset( $labels );

/**
 *
 * Project custom taxonomy.
 *
 */
 $labels = array(
      'name'              => _x( 'Projects', 'taxonomy general name', 'twentythirteen-child' ),
      'singular_name'     => _x( 'Project', 'taxonomy singular name', 'twentythirteen-child' ),
      'search_items'      => __( 'Search Projects', 'twentythirteen-child' ),
      'all_items'         => __( 'All Projects', 'twentythirteen-child' ),
      'parent_item'       => __( 'Parent Project', 'twentythirteen-child' ),
      'parent_item_colon' => __( 'Parent Project:', 'twentythirteen-child' ),
      'edit_item'         => __( 'Edit Project', 'twentythirteen-child' ),
      'update_item'       => __( 'Update Project', 'twentythirteen-child' ),
      'add_new_item'      => __( 'Add New Project', 'twentythirteen-child' ),
      'new_item_name'     => __( 'New Project Name', 'twentythirteen-child' ),
      'menu_name'         => __( 'Project', 'twentythirteen-child' ),
  );

 $args = array(
     'hierarchical'      => false,
     'labels'            => $labels,
     'show_ui'           => true,
     'show_admin_column' => true,
     'query_var'         => true,
     'rewrite'           => array( 'slug' => 'project', 'with_front' => true ),
 );

 register_taxonomy( 'project', array( 'post', 'snippet', 'video' ), $args );

}
add_action('init', 'create_tech_kb_taxonomies', 0);
