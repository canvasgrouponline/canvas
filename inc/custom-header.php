<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
 *  <?php if ( get_header_image() ) : ?>
 *  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
 *      <img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
 *  </a>
 *  <?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package canvas
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses canvas_photo_header_style()
 */
function canvas_photo_custom_header_setup() {
    add_theme_support( 'custom-header', apply_filters( 'canvas_photo_custom_header_args', array(
        'default-image'          => get_parent_theme_file_uri( '/assets/images/header.png' ),
        'width'                  => 600,
        'height'                 => 160,
        'flex-height'            => true,
        'wp-head-callback'       => '',
    ) ) );

    register_default_headers( array(
        'default-image' => array(
            'url'           => '%s/assets/images/header.png',
            'thumbnail_url' => '%s/assets/images/header.png',
            'description'   => __( 'Default Header Image', 'canvas' ),
        ),
    ) );
}
add_action( 'after_setup_theme', 'canvas_photo_custom_header_setup' );
