<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package canvas
 */

?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>

  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="author" content="Manjurul Ratul">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>

    <!-- ################################################################################################ -->
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse <?php if( of_get_option( 'sticky_header' ) ) echo 'navbar-fixed-top'; ?>" role="navigation">

      <?php
        // Fix menu overlap bug..
        if ( is_admin_bar_showing() ) echo '<div style="min-height: 32px;"></div>';
      ?>

      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <?php if( get_header_image() != '' ) : ?>

          <div id="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>"  height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
          </div> <!-- end of #logo -->

          <?php endif; // header image was removed ?>

          <?php if( !get_header_image() ) : ?>

          <div id="logo">
              <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
          </div> <!-- end of #logo -->

          <?php endif; // header image was removed (again) ?>

        </div> <!-- end of .navbar-header -->

        <div id="navbar" class="navbar-collapse collapse">
          <?php canvas_header_menu(); // main navigation ?>
          <p class="navbar-text navbar-right"><i class="fa fa-phone-square" aria-hidden="true"></i> 01777-558-880</p>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <!-- ################################################################################################ -->
