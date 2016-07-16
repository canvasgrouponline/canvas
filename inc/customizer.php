<?php
/**
 * canvas Theme Customizer
 *
 * @package canvas
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function canvas_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'canvas_customize_register' );

/**
 * Options for canvas Theme Customizer.
 */
function canvas_customizer( $wp_customize ) {

    /* Main option Settings Panel */
    $wp_customize->add_panel('canvas_main_options', array(
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Canvas Options', 'canvas'),
        'description' => __('Panel to update canvas theme options', 'canvas'), // Include html tags such as <p>.
        'priority' => 10 // Mixed with top-level-section hierarchy.
    ));

        // add "Content Options" section
        $wp_customize->add_section( 'canvas_content_section' , array(
                'title'      => esc_html__( 'Content Options', 'canvas' ),
                'priority'   => 50,
                'panel' => 'canvas_main_options'
        ) );
            // add setting for excerpts/full posts toggle
            $wp_customize->add_setting( 'canvas_excerpts', array(
                    'default'           => 1,
                    'sanitize_callback' => 'canvas_sanitize_checkbox',
            ) );
            // add checkbox control for excerpts/full posts toggle
            $wp_customize->add_control( 'canvas_excerpts', array(
                    'label'     => esc_html__( 'Show post excerpts?', 'canvas' ),
                    'section'   => 'canvas_content_section',
                    'priority'  => 10,
                    'type'      => 'checkbox'
            ) );

            $wp_customize->add_setting( 'canvas_page_comments', array(
                    'default' => 1,
                    'sanitize_callback' => 'canvas_sanitize_checkbox',
            ) );
            $wp_customize->add_control( 'canvas_page_comments', array(
                    'label'		=> esc_html__( 'Display Comments on Static Pages?', 'canvas' ),
                    'section'	=> 'canvas_content_section',
                    'priority'	=> 20,
                    'type'      => 'checkbox',
            ) );

        /* canvas Main Options */
        $wp_customize->add_section('canvas_slider_options', array(
            'title' => __('Slider options', 'canvas'),
            'priority' => 31,
            'panel' => 'canvas_main_options'
        ));
            $wp_customize->add_setting( 'canvas[canvas_slider_checkbox]', array(
                    'default' => 0,
                    'type' => 'option',
                    'sanitize_callback' => 'canvas_sanitize_checkbox',
            ) );
            $wp_customize->add_control( 'canvas[canvas_slider_checkbox]', array(
                    'label'	=> esc_html__( 'Check if you want to enable slider', 'canvas' ),
                    'section'	=> 'canvas_slider_options',
                    'priority'	=> 5,
                    'type'      => 'checkbox',
            ) );

            // Pull all the categories into an array
            global $options_categories;
            $wp_customize->add_setting('canvas[canvas_slide_categories]', array(
                'default' => '',
                'type' => 'option',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'canvas_sanitize_slidecat'
            ));
            $wp_customize->add_control('canvas[canvas_slide_categories]', array(
                'label' => __('Slider Category', 'canvas'),
                'section' => 'canvas_slider_options',
                'type'    => 'select',
                'description' => __('Select a category for the featured post slider', 'canvas'),
                'choices'    => $options_categories
            ));

            $wp_customize->add_setting('canvas[canvas_slide_number]', array(
                'default' => 3,
                'type' => 'option',
                'sanitize_callback' => 'canvas_sanitize_number'
            ));
            $wp_customize->add_control('canvas[canvas_slide_number]', array(
                'label' => __('Number of slide items', 'canvas'),
                'section' => 'canvas_slider_options',
                'description' => __('Enter the number of slide items', 'canvas'),
                'type' => 'text'
            ));

        /* canvas Header Options */
        $wp_customize->add_section('canvas_header_options', array(
            'title' => __('Header', 'canvas'),
            'priority' => 31,
            'panel' => 'canvas_main_options'
        ));

            $wp_customize->add_setting('canvas[sticky_header]', array(
                'default' => 0,
                'type' => 'option',
                'sanitize_callback' => 'canvas_sanitize_checkbox'
            ));
            $wp_customize->add_control('canvas[sticky_header]', array(
                'label' => __('Sticky Header', 'canvas'),
                'description' => sprintf(__('Check to show fixed header', 'canvas')),
                'section' => 'canvas_header_options',
                'type' => 'checkbox',
            ));

            $wp_customize->add_setting('canvas[nav_bg_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'canvas_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'canvas[nav_bg_color]', array(
                'label' => __('Top nav background color', 'canvas'),
                'description'   => __('Default used if no color is selected','canvas'),
                'section' => 'canvas_header_options',
            )));
            $wp_customize->add_setting('canvas[nav_link_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'canvas_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'canvas[nav_link_color]', array(
                'label' => __('Top nav item color', 'canvas'),
                'description'   => __('Link color','canvas'),
                'section' => 'canvas_header_options',
            )));

            $wp_customize->add_setting('canvas[nav_item_hover_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'canvas_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'canvas[nav_item_hover_color]', array(
                'label' => __('Top nav item hover color', 'canvas'),
                'description'   => __('Link:hover color','canvas'),
                'section' => 'canvas_header_options',
            )));

            $wp_customize->add_setting('canvas[nav_dropdown_bg]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'canvas_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'canvas[nav_dropdown_bg]', array(
                'label' => __('Top nav dropdown background color', 'canvas'),
                'description'   => __('Background of dropdown item hover color','canvas'),
                'section' => 'canvas_header_options',
            )));

            $wp_customize->add_setting('canvas[nav_dropdown_item]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'canvas_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'canvas[nav_dropdown_item]', array(
                'label' => __('Top nav dropdown item color', 'canvas'),
                'description'   => __('Dropdown item color','canvas'),
                'section' => 'canvas_header_options',
            )));

            $wp_customize->add_setting('canvas[nav_dropdown_item_hover]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'canvas_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'canvas[nav_dropdown_item_hover]', array(
                'label' => __('Top nav dropdown item hover color', 'canvas'),
                'description'   => __('Dropdown item hover color','canvas'),
                'section' => 'canvas_header_options',
            )));

            $wp_customize->add_setting('canvas[nav_dropdown_bg_hover]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'canvas_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'canvas[nav_dropdown_bg_hover]', array(
                'label' => __('Top nav dropdown item background hover color', 'canvas'),
                'description'   => __('Background of dropdown item hover color','canvas'),
                'section' => 'canvas_header_options',
            )));

        /* canvas Social Options */
        $wp_customize->add_section('canvas_social_options', array(
            'title' => __('Social', 'canvas'),
            'priority' => 31,
            'panel' => 'canvas_main_options'
        ));
            $wp_customize->add_setting('canvas[social_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'canvas_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'canvas[social_color]', array(
                'label' => __('Social icon color', 'canvas'),
                'description' => sprintf(__('Default used if no color is selected', 'canvas')),
                'section' => 'canvas_social_options',
            )));

            $wp_customize->add_setting('canvas[social_footer_color]', array(
                'default' => '',
                'type'  => 'option',
                'sanitize_callback' => 'canvas_sanitize_hexcolor'
            ));
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'canvas[social_footer_color]', array(
                'label' => __('Footer social icon color', 'canvas'),
                'description' => sprintf(__('Default used if no color is selected', 'canvas')),
                'section' => 'canvas_social_options',
            )));

            $wp_customize->add_setting('canvas[footer_social]', array(
                'default' => 0,
                'type' => 'option',
                'sanitize_callback' => 'canvas_sanitize_checkbox'
            ));
            $wp_customize->add_control('canvas[footer_social]', array(
                'label' => __('Footer Social Icons', 'canvas'),
                'description' => sprintf(__('Check to show social icons in footer', 'canvas')),
                'section' => 'canvas_social_options',
                'type' => 'checkbox',
            ));
}
add_action( 'customize_register', 'canvas_customizer' );

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
function canvas_sanitize_hexcolor($color) {
    if ($unhashed = sanitize_hex_color_no_hash($color))
        return '#' . $unhashed;
    return $color;
}

/**
 * Adds sanitization callback function: Nohtml
 * @package canvas
 */
function canvas_sanitize_nohtml($input) {
    return wp_filter_nohtml_kses($input);
}

/**
 * Adds sanitization callback function: Number
 * @package canvas
 */
function canvas_sanitize_number($input) {
    if ( isset( $input ) && is_numeric( $input ) ) {
        return $input;
    }
}

/**
 * Adds sanitization callback function: Strip Slashes
 * @package canvas
 */
function canvas_sanitize_strip_slashes($input) {
    return wp_kses_stripslashes($input);
}

/**
 * Adds sanitization callback function: Sanitize Text area
 * @package canvas
 */
function canvas_sanitize_textarea($input) {
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

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function canvas_customize_preview_js() {
	wp_enqueue_script( 'canvas_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20140317', true );
}
add_action( 'customize_preview_init', 'canvas_customize_preview_js' );

/**
 * Add CSS for custom controls
 */
function canvas_customizer_custom_control_css() {
	?>
    <style>
        #customize-control-canvas-main_body_typography-size select, #customize-control-canvas-main_body_typography-face select,#customize-control-canvas-main_body_typography-style select { width: 60%; }
    </style><?php
}
add_action( 'customize_controls_print_styles', 'canvas_customizer_custom_control_css' );


/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'customizer_custom_scripts' );

function customizer_custom_scripts() { ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        /* This one shows/hides the an option when a checkbox is clicked. */
        jQuery('#customize-control-canvas-canvas_slide_categories, #customize-control-canvas-canvas_slide_number').hide();
        jQuery('#customize-control-canvas-canvas_slider_checkbox input').click(function() {
            jQuery('#customize-control-canvas-canvas_slide_categories, #customize-control-canvas-canvas_slide_number').fadeToggle(400);
        });

        if (jQuery('#customize-control-canvas-canvas_slider_checkbox input:checked').val() !== undefined) {
            jQuery('#customize-control-canvas-canvas_slide_categories, #customize-control-canvas-canvas_slide_number').show();
        }
    });
</script>
<style>
    li#accordion-section-canvas_important_links h3.accordion-section-title, li#accordion-section-canvas_important_links h3.accordion-section-title:focus { background-color: #00cc00 !important; color: #fff !important; }
    li#accordion-section-canvas_important_links h3.accordion-section-title:hover { background-color: #00b200 !important; color: #fff !important; }
    li#accordion-section-canvas_important_links h3.accordion-section-title:after { color: #fff !important; }
</style>
<?php
}
