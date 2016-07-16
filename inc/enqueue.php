<?php

    // Load CSS
    function canvas_load_styles() {
        // Register Styles
        wp_register_style('font-awesome_style', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
        wp_register_style('canvas_main_style', get_template_directory_uri() . '/inc/css/style.min.css');

        // Enqueue Styles
        wp_enqueue_style('font-awesome_style');
        wp_enqueue_style('canvas_main_style');

        // Add slider CSS only if is front page and slider is enabled
        if( ( is_home() || is_front_page() ) && of_get_option('canvas_slider_checkbox') == 1 ) {
          wp_enqueue_style( 'flexslider-css', get_template_directory_uri().'/inc/css/flexslider.css' );
        }
    }

    // Load Javascript
    function canvas_load_scripts() {
        // Bootstrap
        wp_register_script('bootstrap-scripts', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array('jquery'), null, true);
        wp_enqueue_script('bootstrap-scripts');

        // Custom Scripts
        wp_register_script('canvas_custom_script', get_template_directory_uri() . '/inc/js/script.min.js', array('jquery'), null, true);
        wp_enqueue_script('canvas_custom_script');


        if( ( is_home() || is_front_page() ) && of_get_option('canvas_slider_checkbox') == 1 ) {
          // Add slider JS only if is front page ans slider is enabled
          wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/inc/js/flexslider.min.js', array('jquery'), '20140222', true );
          // Flexslider customization
          wp_enqueue_script( 'flexslider-customization', get_template_directory_uri() . '/inc/js/flexslider-custom.js', array('jquery', 'flexslider-js'), '20140716', true );
        }
    }
?>
