<?php
/**
 * canvas functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package canvas
 */

  // Sets up theme defaults and registers support for various WordPress features.
  // add_action('after_setup_theme', 'canvas_setup');
  // Get information from Theme Options and add it into wp_head
  // add_action( 'wp_head', 'get_canvas_theme_options', 10 );

  // Action & Filter Hooks
  // Load CSS
  // add_action('wp_enqueue_scripts', 'canvas_load_styles');
  // Load Javascript
  // add_action('wp_enqueue_scripts', 'canvas_load_scripts');

  // Register sidebars by running canvas_widgets_init() on the widgets_init hook.
  // add_action( 'widgets_init', 'canvas_widgets_init' );


  //deactivate WordPress function
  // remove_shortcode('gallery', 'gallery_shortcode');
  //activate own function
  // add_shortcode('gallery', 'canvas_gallery_shortcode');

  // Filters
  // add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
  // add_filter( 'excerpt_more', 'custom_excerpt_more' );
  // add_filter( "the_excerpt", 'add_class_to_excerpt' );
  // add_filter( 'get_the_excerpt', 'new_excerpt_more' );


  // Requires
  /**
   * Implement the Custom Header feature.
   */
  // require ( get_template_directory() . '/inc/custom-header.php' );
  /**
   * Customizer additions.
   */
  // require ( get_template_directory() . '/inc/customizer.php' );

  // Includes
  // include ( get_template_directory() . '/inc/setup.php' );
  // include ( get_template_directory() . '/inc/enqueue.php' );
  // include ( get_template_directory() . '/inc/navwalker.php' );
  // include ( get_template_directory() . '/inc/pagination.php' );
  // include ( get_template_directory() . '/inc/tweaks.php' );

?>
