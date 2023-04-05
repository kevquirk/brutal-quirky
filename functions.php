<?php

// Gutenberg custom stylesheet
add_theme_support('editor-styles');
add_editor_style( 'style.css' );
add_editor_style( 'editor-style.css' );

// Remove block library stylesheet
function remove_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
} 
add_action( 'wp_enqueue_scripts', 'remove_block_library_css' );

// Remove "Archive:", "Category:" etc.
add_filter( 'get_the_archive_title', function ($title) {
      if ( is_category() ) {
              $title = single_cat_title( '', false );
          } elseif ( is_tag() ) {
              $title = single_tag_title( '', false );
          } elseif ( is_author() ) {
              $title = '<span class="vcard">' . get_the_author() . '</span>' ;
          } elseif ( is_tax() ) { //for custom post types
              $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
          } elseif (is_post_type_archive()) {
              $title = post_type_archive_title( '', false );
          }
      return $title;
  });

// Shortcode for inserting the site's contact email
add_shortcode( 'contact_email', 'contact_email' );

function contact_email( $atts ) {
    return '23g@qrk.one'; // Change this value when it's time to update your email everywhere!
}

// Shortcode for generating the post title
add_shortcode( 'get_title', 'get_title' );

function get_title( $atts ) {
    return esc_attr( get_the_title( get_the_ID() ) );
}

// Add reply link to RSS feed
add_filter( "the_content_feed", "feed_comment_via_email" );

function feed_comment_via_email($content)
{
   $content .= "<p><a href=\"mailto: " . do_shortcode( ' [contact_email] ' ) . "?subject=Reply to '" . do_shortcode( ' [get_title] ' ) . "'" . "\">Reply via email</a></p>";
   return $content;
}

// Remove mobile menu and drop-down JS.
add_action( 'wp_enqueue_scripts', 'tu_remove_menu_scripts', 50 );
function tu_remove_menu_scripts() {
    wp_dequeue_script( 'generate-menu' );
    wp_dequeue_script( 'generate-dropdown' );
}

// Disable comments RSS feed
add_action( 'after_setup_theme', 'head_cleanup' );

function head_cleanup(){

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // disable comments feed
    add_filter( 'feed_links_show_comments_feed', '__return_false' ); 

}

// Auto-generate titles on posts based on date and time
add_filter('default_title', function ($title) {
    global $post_type;
    if ('post' == $post_type) {
        return date('d F Y H:i');
    }
    return $title;
} );

// Fix comment date
add_filter( 'get_comment_date', 'db_reformat_comment_date' );	
function db_reformat_comment_date( $dateForm ) {
    $dateForm  = date("j F Y H:i");	
    return $dateForm;
}