<?php
  /**
  * Custom functions that act independently of the theme templates
  *
  * Eventually, some of the functionality here could be replaced by core features
  *
  * @package canvas
  */


// HEADER CLEANUPS //
// post and comment feeds
  remove_action('wp_head', 'feed_links', 2);

// category feeds
  remove_action('wp_head', 'feed_links_extra', 3);

// EditURI link
  remove_action('wp_head', 'rsd_link');

// windows live writer
  remove_action('wp_head', 'wlwmanifest_link');

// WP version
  remove_action('wp_head', 'wp_generator');

// links for adjacent posts
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Removes emoji styles and JS
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
* [removeWpVersionFromLink description]
* @param  [type] $src [description]
* @return [type]      [description]
*/
function removeWpVersionFromLink( $src ) {
    if (strpos($src, 'ver='))
        $src = remove_query_arg('ver', $src);
    return $src;
}
// remove WP version from css
  add_filter('style_loader_src', 'removeWpVersionFromLink', 9999);
// remove Wp version from scripts
  add_filter('script_loader_src', 'removeWpVersionFromLink', 9999);

/**
 * [filter_ptags_on_images description]
 * @param  [type] $content [description]
 * @return [type]          [description]
 */
function filter_ptags_on_images($content) {
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

?>
