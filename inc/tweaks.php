<?php
  /**
  * Custom functions that act independently of the theme templates
  *
  * Eventually, some of the functionality here could be replaced by core features
  *
  * @package canvas
  */


    // change the default excerpt length using excerpt_length filter
    function custom_excerpt_length( $length ) {
      return 30;
    }
    // remove [...] from excerpt
    function custom_excerpt_more( $more ) {
      return '';
    }

    // add a special class to the excerpt's p element
    function add_class_to_excerpt( $excerpt ) {
      return str_replace('<p', '<p class="excerpt"', $excerpt);
    }

    // Add link text to excerpt
    function new_excerpt_more( $excerpt ) {
      return $excerpt . '...<a class="more-link" href="'. get_permalink( get_the_ID() ) . '">' . __('Continue Reading', 'canvas') . '</a>';
    }

  if ( ! function_exists( 'canvas_featured_slider' ) ) :
    /**
    * Featured image slider, displayed on front page for static page and blog
    */
    function canvas_featured_slider() {
      if ( is_front_page() && of_get_option( 'canvas_slider_checkbox' ) == 1 ) {
        echo '<div class="flexslider">';
        echo '<ul class="slides">';

        $count    = of_get_option( 'canvas_slide_number' );
        $slidecat = of_get_option( 'canvas_slide_categories' );

        $query = new WP_Query( array( 'cat' =>$slidecat,'posts_per_page' =>$count ) );
        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();

        echo '<li>';
        if ( (function_exists( 'has_post_thumbnail' )) && ( has_post_thumbnail() ) ) :
          echo the_post_thumbnail( 'canvas-featured' );
        endif;

        echo '<div class="flex-caption">';
        if ( get_the_title() != '' ) echo '<h2 class="entry-title">'. get_the_title().'</h2>';
        if ( get_the_content() != '' ) echo '<div class="excerpt">' . get_the_excerpt() .'</div>';
        echo '</div>';
        echo '</li>';
        endwhile;
        endif;

        echo '</ul>';
        echo ' </div>';
      }
    }
  endif;


  if ( ! function_exists( 'get_canvas_theme_options' ) ) {
    /**
     * Get information from Theme Options and add it into wp_head
     */
    function get_canvas_theme_options(){

      echo '<style type="text/css">';

      if ( of_get_option('link_color')) {
        echo 'a, #infinite-handle span, #secondary .widget .post-content a {color:' . of_get_option('link_color') . '}';
      }
      if ( of_get_option('link_hover_color')) {
        echo 'a:hover, a:active, #secondary .widget .post-content a:hover,
        .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover,
        .woocommerce nav.woocommerce-pagination ul li span.current  {color: '.of_get_option('link_hover_color').';}';
      }
      if ( of_get_option('element_color')) {
        echo '.btn-default, .label-default, .flex-caption h2, .btn.btn-default.read-more,button,
        .navigation .wp-pagenavi-pagination span.current,.navigation .wp-pagenavi-pagination a:hover,
        .woocommerce a.button, .woocommerce button.button,
        .woocommerce input.button, .woocommerce #respond input#submit.alt,
        .woocommerce a.button, .woocommerce button.button,
        .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt { background-color: '.of_get_option('element_color').'; border-color: '.of_get_option('element_color').';}';

        echo '.site-main [class*="navigation"] a, .more-link, .pagination>li>a, .pagination>li>span { color: '.of_get_option('element_color').'}';
      }

      if ( of_get_option('element_color_hover')) {
        echo '.btn-default:hover, .label-default[href]:hover, .tagcloud a:hover,button, .main-content [class*="navigation"] a:hover,.label-default[href]:focus, #infinite-handle span:hover,.btn.btn-default.read-more:hover, .btn-default:hover, .scroll-to-top:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .site-main [class*="navigation"] a:hover, .more-link:hover, #image-navigation .nav-previous a:hover, #image-navigation .nav-next a:hover, .cfa-button:hover,.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover{ background-color: '.of_get_option('element_color_hover').'; border-color: '.of_get_option('element_color_hover').'; }';
      }
      if ( of_get_option('element_color_hover')) {
        echo '.pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover {color: '.of_get_option('element_color_hover').';}';
      }
      if ( of_get_option('heading_color')) {
        echo 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, .entry-title {color: '.of_get_option('heading_color').';}';
      }
      if ( of_get_option('nav_bg_color')) {
        echo '.navbar.navbar-default, .navbar-default .navbar-nav .open .dropdown-menu > li > a {background-color: '.of_get_option('nav_bg_color').';}';
      }
      if ( of_get_option('nav_link_color')) {
        echo '.navbar-default .navbar-nav > li > a, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus { color: '.of_get_option('nav_link_color').';}';
      }
      if ( of_get_option('nav_item_hover_color')) {
        echo '.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {color: '.of_get_option('nav_item_hover_color').';}';
      }
      if ( of_get_option('nav_dropdown_bg_hover') || of_get_option('nav_dropdown_item_hover') ) {
        echo '@media (max-width: 767px) {.navbar-default .navbar-nav .open .dropdown-menu>.active>a, .navbar-default .navbar-nav .open .dropdown-menu>.active>a:focus, .navbar-default .navbar-nav .open .dropdown-menu>.active>a:hover {background: '.of_get_option('nav_dropdown_bg_hover').'; color:'.of_get_option('nav_dropdown_item_hover').';} }';
      }
      if ( of_get_option('nav_dropdown_bg')) {
        echo '.dropdown-menu {background-color: '.of_get_option('nav_dropdown_bg').';}';
      }
      if ( of_get_option('nav_dropdown_item')) {
        echo '.navbar-default .navbar-nav .open .dropdown-menu > li > a, .dropdown-menu > li > a { color: '.of_get_option('nav_dropdown_item').';}';
      }
      if ( of_get_option('nav_dropdown_bg_hover') || of_get_option('nav_dropdown_item_hover') ) {
        echo '.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .navbar-default .navbar-nav .open .dropdown-menu > li.active > a {background-color: '.of_get_option('nav_dropdown_bg_hover').'; color:'.of_get_option('nav_dropdown_item_hover').';}';
      }
      if ( of_get_option('nav_dropdown_item_hover') ) {
        echo '.navbar-default .navbar-nav .current-menu-ancestor a.dropdown-toggle { color: '.of_get_option('nav_dropdown_item_hover').';}';
      }

      if ( of_get_option('social_color')) {
        echo '.social-icons li a {background-color: '.of_get_option('social_color').' !important ;}';
      }
      if ( of_get_option('social_footer_color')) {
        echo '#footer-area .social-icons li a {background-color: '.of_get_option('social_footer_color').' !important ;}';
      }
      echo '</style>';
    }
  }

?>
