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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>

    <div id="page" class="site">
        <div class="container">
          <header id="masthead" class="site-header row" role="banner">
            <div class="col-md-12">
              <h1 class="text-center">Site Header</h1>
            </div>
          </header>
        </div>
        <!-- ================================================== -->
        <div id="content" class="site-content">

