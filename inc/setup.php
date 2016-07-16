<?php

  if ( ! function_exists( 'canvas_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
    function canvas_setup() {

      /*
       * Let WordPress manage the document title.
       * By adding theme support, we declare that this theme does not use a
       * hard-coded <title> tag in the document head, and expect WordPress to
       * provide it for us.
       */
      add_theme_support( 'title-tag' );

      // Add default posts and comments RSS feed links to head.
      add_theme_support( 'automatic-feed-links' );

      // This theme uses wp_nav_menu() in one location.
      register_nav_menus(array(
        'primary'      => __('Primary', 'canvas'),
        'footer-links' => __( 'Footer Links', 'canvas' ) // secondary nav in footer
        ));

      /**
       * Enable support for Post Thumbnails on posts and pages.
       *
       * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
       */
      add_theme_support('post-thumbnails');

      add_image_size( 'canvas-featured', 1920, 600, true );


      /*
       * Switch default core markup for search form, comment form, and comments
       * to output valid HTML5.
       */
      add_theme_support( 'html5', array(
          'comment-list',
          'search-form',
          'comment-form',
          'gallery',
          'caption',
      ) );

      /*
       * Enable support for Post Formats.
       * See https://developer.wordpress.org/themes/functionality/post-formats/
       */
      add_theme_support( 'post-formats', array(
          'aside',
          'image',
          'video',
          'quote',
          'link',
      ) );
    }
  endif;

  if ( ! function_exists( 'canvas_header_menu' ) ) :
    /**
     * Header menu (should you choose to use one)
     */
    function canvas_header_menu() {
      // display the WordPress Custom Menu if available
      wp_nav_menu(array(
        'menu'              => 'primary',
        'theme_location'    => 'primary',
        'depth'             => 2,
        'container'         => false,
        'menu_class'        => 'nav navbar-nav',
        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
        'walker'            => new wp_bootstrap_navwalker()
      ));
    } /* end header menu */
  endif;



  /**
   * Register widget area.
   *
   * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
   */
  // http://code.tutsplus.com/tutorials/dynamically-adding-four-footer-widget-areas--cms-22168

  function canvas_widgets_init() {

      for( $i=1; $i<5; $i++ ) {
          register_sidebar(array(
              'name'          =>  sprintf( esc_html__( 'Footer Widget %s', 'canvas' ), $i),
              'id'            => 'footer-widget-'.$i,
              'description'   =>  esc_html__( 'Used for footer widget area', 'canvas' ),
              'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
              'after_widget'  => '</div>',
              'before_title'  => '<h5 class="text-center">',
              'after_title'   => '</h5>',
          ));
      }
  }


  /* Globals variables */
  global $options_categories;
  $options_categories = array();
  $options_categories_obj = get_categories();
  foreach ($options_categories_obj as $category) {
          $options_categories[$category->cat_ID] = $category->cat_name;
  }


  /**
   * Helper function to return the theme option value.
   * If no value has been saved, it returns $default.
   * Needed because options are saved as serialized strings.
   *
   * Not in a class to support backwards compatibility in themes.
   */
  if ( ! function_exists( 'of_get_option' ) ) :
    function of_get_option( $name, $default = false ) {

      $option_name = '';
      // Get option settings from database
      $options = get_option( 'canvas' );

      // Return specific option
      if ( isset( $options[$name] ) ) {
        return $options[$name];
      }

      return $default;
    }
  endif;


  /**
  * Builds the Gallery shortcode output.
  *
  * This implements the functionality of the Gallery Shortcode for displaying
  * WordPress images on a post.
  *
  * @staticvar int $instance
  *
  *
  * @param array $attr {
  *     Attributes of the gallery shortcode.
  *
  *     @type string       $order      Order of the images in the gallery. Default 'ASC'. Accepts 'ASC', 'DESC'.
  *     @type string       $orderby    The field to use when ordering the images. Default 'menu_order ID'.
  *                                    Accepts any valid SQL ORDERBY statement.
  *     @type int          $id         Post ID.
  *     @type string       $itemtag    HTML tag to use for each image in the gallery.
  *                                    Default 'dl', or 'figure' when the theme registers HTML5 gallery support.
  *     @type string       $icontag    HTML tag to use for each image's icon.
  *                                    Default 'dt', or 'div' when the theme registers HTML5 gallery support.
  *     @type string       $captiontag HTML tag to use for each image's caption.
  *                                    Default 'dd', or 'figcaption' when the theme registers HTML5 gallery support.
  *     @type int          $columns    Number of columns of images to display. Default 3.
  *     @type string|array $size       Size of the images to display. Accepts any valid image size, or an array of width
  *                                    and height values in pixels (in that order). Default 'thumbnail'.
  *     @type string       $ids        A comma-separated list of IDs of attachments to display. Default empty.
  *     @type string       $include    A comma-separated list of IDs of attachments to include. Default empty.
  *     @type string       $exclude    A comma-separated list of IDs of attachments to exclude. Default empty.
  *     @type string       $link       What to link each image to. Default empty (links to the attachment page).
  *                                    Accepts 'file', 'none'.
  * }
  * @return string HTML content to display gallery.
   */
  function canvas_gallery_shortcode( $attr ) {
      $post = get_post();

      static $instance = 0;
      $instance++;

      if ( ! empty( $attr['ids'] ) ) {
      // 'ids' is explicitly ordered, unless you specify otherwise.
          if ( empty( $attr['orderby'] ) ) {
              $attr['orderby'] = 'post__in';
          }
          $attr['include'] = $attr['ids'];
      }

      /**
       * Filter the default gallery shortcode output.
       *
       * If the filtered output isn't empty, it will be used instead of generating
       * the default gallery template.
       *
       * @since 2.5.0
       * @since 4.2.0 The `$instance` parameter was added.
       *
       * @see gallery_shortcode()
       *
       * @param string $output   The gallery output. Default empty.
       * @param array  $attr     Attributes of the gallery shortcode.
       * @param int    $instance Unique numeric ID of this gallery shortcode instance.
       */
      $output = apply_filters( 'post_gallery', '', $attr, $instance );
      if ( $output != '' ) {
          return $output;
      }

      $html5 = current_theme_supports( 'html5', 'gallery' );
      $atts = shortcode_atts( array(
          'order'      => 'ASC',
          'orderby'    => 'menu_order ID',
          'id'         => $post ? $post->ID : 0,
          'itemtag'    => $html5 ? 'figure'     : 'dl',
          'icontag'    => $html5 ? 'div'        : 'dt',
          'captiontag' => $html5 ? 'figcaption' : 'dd',
          'columns'    => 3,
          'size'       => 'thumbnail',
          'include'    => '',
          'exclude'    => '',
          'link'       => ''
          ), $attr, 'gallery' );

      $id = intval( $atts['id'] );

      if ( ! empty( $atts['include'] ) ) {
          $_attachments = get_posts( array(
              'include'        => $atts['include'],
              'post_status'    => 'inherit',
              'post_type'      => 'attachment',
              'post_mime_type' => 'image',
              'order'          => $atts['order'],
              'orderby'        => $atts['orderby']
          ) );

          $attachments = array();
          foreach ( $_attachments as $key => $val ) {
              $attachments[$val->ID] = $_attachments[$key];
          }
      } elseif ( ! empty( $atts['exclude'] ) ) {
          $attachments = get_children( array(
              'post_parent'    => $id,
              'exclude'        => $atts['exclude'],
              'post_status'    => 'inherit',
              'post_type'      => 'attachment',
              'post_mime_type' => 'image',
              'order'          => $atts['order'],
              'orderby'        => $atts['orderby']
          ) );
      } else {
          $attachments = get_children( array(
              'post_parent'    => $id,
              'post_status'    => 'inherit',
              'post_type'      => 'attachment',
              'post_mime_type' => 'image',
              'order'          => $atts['order'],
              'orderby'        => $atts['orderby']
          ) );
      }

      if ( empty( $attachments ) ) {
          return '';
      }

      if ( is_feed() ) {
          $output = "\n";
          foreach ( $attachments as $att_id => $attachment ) {
              $output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
          }
          return $output;
      }

      $itemtag    = tag_escape( $atts['itemtag'] );
      $captiontag = tag_escape( $atts['captiontag'] );
      $icontag    = tag_escape( $atts['icontag'] );
      $valid_tags = wp_kses_allowed_html( 'post' );

      if ( ! isset( $valid_tags[ $itemtag ] ) ) {
          $itemtag = 'dl';
      }
      if ( ! isset( $valid_tags[ $captiontag ] ) ) {
          $captiontag = 'dd';
      }
      if ( ! isset( $valid_tags[ $icontag ] ) ) {
          $icontag = 'dt';
      }

      $columns = intval( $atts['columns'] );
      if ($columns == 1) { $col_class = 'col-md-12';}
      else if ($columns == 2) { $col_class = 'col-md-6'; }
      else if ($columns == 3) { $col_class = 'col-md-4'; }
      else if ($columns == 4) { $col_class = 'col-md-3'; }

      $selector = "gallery-{$instance}";


      $size_class = sanitize_html_class( $atts['size'] );
      $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

      /**
       * Filter the default gallery shortcode CSS styles.
       *
       * @since 2.5.0
       *
       * @param string $gallery_style Default CSS styles and opening HTML div container
       *                              for the gallery shortcode output.
       */
      $output = apply_filters( 'gallery_style', $gallery_div );
      $output .= '<div class="row gallery">';

      $i = 0;
      foreach ( $attachments as $id => $attachment ) {

          if ($i%$columns == 0 && $i > 0) {
              $output .= '</div><div class="row gallery">';
          }

          $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';

          if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
              $image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr=array('class' => 'img-responsive img-thumbnail') );
          } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
              $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
          } else {
              $image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr=array('class' => 'img-responsive img-thumbnail') );
          }

          $image_meta  = wp_get_attachment_metadata( $id );

          $orientation = '';
          if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
              $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
          }

          $output .= "<{$itemtag} class='gallery-item $col_class'>";
          $output .= "
          <{$icontag} class='gallery-icon {$orientation}'>
              $image_output
          </{$icontag}>";

          if ( $captiontag && trim($attachment->post_excerpt) ) {
              $output .= "
              <{$captiontag} class='wp-caption-text gallery-caption text-center' id='$selector-$id'>
              " . wptexturize($attachment->post_excerpt) . "
              </{$captiontag}>";
          }

          $output .= "</{$itemtag}>";
          $i++;
      }

      $output .= "</div>\n";
      $output .= "</div>\n";

      return $output;
  }

?>
