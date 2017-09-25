<?php
/**
 * Desher Khobor Theme Customizer.
 *
 * @package canvas
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function canvas_photo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'canvas_photo_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function canvas_photo_customize_preview_js() {
	wp_enqueue_script( 'canvas_photo_customizer_preview', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0', true );
}
// add_action( 'customize_preview_init', 'canvas_photo_customize_preview_js' );

/**
 * [canvas_photo_theme_option description]
 * @param  [type] $wp_customize [description]
 */
function canvas_photo_theme_option( $wp_customize ) {
    // panel
    $wp_customize->add_panel( 'theme_options', array(
        'title'          => __( 'Canvas Theme Options', 'canvas' ),
        'capability'     => 'edit_theme_options',
        'priority'       => 130,
        'theme_supports' => '',
    ));
}
add_action( 'customize_register', 'canvas_photo_theme_option' );


/**
 * Sanitzie checkbox for WordPress customizer
 */
function canvas_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
/**
 * Adds sanitization callback function: colors
 * @package canvas
 */
function canvas_sanitize_hexcolor( $color ) {
    if ($unhashed = sanitize_hex_color_no_hash($color))
        return '#' . $unhashed;
    return $color;
}

/**
 * Adds sanitization callback function: Nohtml
 * @package canvas
 */
function canvas_sanitize_nohtml( $input ) {
    return wp_filter_nohtml_kses($input);
}

/**
 * Adds sanitization callback function: Number
 * @package canvas
 */
function canvas_sanitize_number( $input ) {
    if ( isset( $input ) && is_numeric( $input ) ) {
        return $input;
    }
}

/**
 * Adds sanitization callback function: Strip Slashes
 * @package canvas
 */
function canvas_sanitize_strip_slashes( $input ) {
    return wp_kses_stripslashes($input);
}

/**
 * Adds sanitization callback function: Sanitize Text area
 * @package canvas
 */
function canvas_sanitize_textarea( $input ) {
    return sanitize_text_field($input);
}

/**
 * Adds sanitization callback function: Slider Category
 * @package canvas
 */
function canvas_sanitize_slidecat( $input ) {
    global $options_categories;
    if ( array_key_exists( $input, $options_categories ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Sidebar Layout
 * @package canvas
 */
function canvas_sanitize_layout( $input ) {
    global $site_layout;
    if ( array_key_exists( $input, $site_layout ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Adds sanitization callback function: Typography Size
 * @package canvas
 */
function canvas_sanitize_typo_size( $input ) {
    global $typography_options, $typography_defaults;
    if ( array_key_exists( $input, $typography_options['sizes'] ) ) {
        return $input;
    } else {
        return $typography_defaults['size'];
    }
}
/**
 * Adds sanitization callback function: Typography Face
 * @package canvas
 */
function canvas_sanitize_typo_face( $input ) {
    global $typography_options, $typography_defaults;
    if ( array_key_exists( $input, $typography_options['faces'] ) ) {
        return $input;
    } else {
        return $typography_defaults['face'];
    }
}
/**
 * Adds sanitization callback function: Typography Style
 * @package canvas
 */
function canvas_sanitize_typo_style( $input ) {
    global $typography_options, $typography_defaults;
    if ( array_key_exists( $input, $typography_options['styles'] ) ) {
        return $input;
    } else {
        return $typography_defaults['style'];
    }
}
