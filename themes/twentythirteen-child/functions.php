<?php
/**
 * Enqueue the parent and child theme stylesheets,
 * as seen here https://developer.wordpress.org/themes/advanced-topics/child-themes/#3-enqueue-stylesheet.
 */
function ttc_theme_enqueue_styles() {
	$parent_style = 'twentythirteen-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'ttc_theme_enqueue_styles' );

/**
 * Make all CPT posts show up on the blog feed.
 */
function add_all_cpt_to_query( $query ) {
	if (
		$query->is_home() &&
		empty( $query->query_vars['suppress_filters'] )
	) {
		$query->set( 'post_type', array(
			'post',
			'snippet',
			'video'
		) );
	}
}
add_filter( 'pre_get_posts', 'add_all_cpt_to_query' );

/**
 * Make all CPT posts appear in the category & tag archive result page.
 */
function add_all_cpt_to_archive( $query ) {
	if ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		$query->set( 'post_type', array(
			'post',
			'nav_menu_item',
			'snippet',
			'video'
		));
		return $query;
	}
}
 add_filter( 'pre_get_posts', 'add_all_cpt_to_archive' );

if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
	/**
	 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
	 *
	 * @since Twenty Thirteen 1.0
	 */
	function twentythirteen_entry_meta() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="featured-post">' . esc_html__( 'Sticky', 'twentythirteen-child' ) . '</span>';
		}

		  // Eugene removed [&& 'post' == get_post_type()] from the "if" statement below in order to show the date on all CPTs.
		  // the old code looked like the following:
		  // if ( ! has_post_format( 'link' ) && 'post' == get_post_type() ).
		if ( ! has_post_format( 'link' ) ) {
			twentythirteen_entry_date();
		}

		  // Translators: used between list items, there is a space after the comma.
		  $categories_list = get_the_category_list( __( ', ', 'twentythirteen-child' ) );
		if ( $categories_list ) {
			echo '<span class="categories-links">' . $categories_list . '</span>';
		}

		  // Translators: used between list items, there is a space after the comma.
		  $tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen-child' ) );
		if ( $tag_list ) {
			 echo '<span class="tags-links">' . $tag_list . '</span>';
		}

		if ( ! get_post_type('post') ) {
			// Retrieve the terms of the custom taxonomy Coding Language.
			echo '<br>' . get_the_term_list( get_the_ID(), 'language', 'Languages: ', ', ' );

			// Retrieve the terms of the custom taxonomy Web Tool.
			echo '<br>' . get_the_term_list( get_the_ID(), 'tool', ' Tools: ', ', ' );

			// Retrieve the terms of the custom taxonomy Project.
			echo '<br>' . get_the_term_list( get_the_ID(), 'project', ' Projects: ', ', ' );
		}

		  // Post author.
		if ( 'post' === get_post_type() ) {
			 printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
				 esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				 // Translators: name of the author.
				 esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen-child' ), get_the_author() ) ),
				 get_the_author()
			 );
		}
	}
 endif;

/**
 * Add custom fields to the Video CPT output
 */
function add_custom_fields_to_video( $custom_fields ) {
    if ( 'video' === get_post_type() ) {
			$video_id = get_post_meta( get_the_ID(), 'video_id', true);
				if(get_settings('ytuvg_setting_disable_fullscreen')){
						 echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0"></iframe>';
				} else {
						 echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>';
				}
        return $custom_fields . nl2br(get_post_meta( get_the_id(), 'details', true));
    }
    return $custom_fields;
}
add_filter( 'the_content', 'add_custom_fields_to_video' );

/**
 * Custom taxonomies.
 */
require get_stylesheet_directory() . '/inc/custom-taxonomies.php';
