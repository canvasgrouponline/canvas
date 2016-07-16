<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package canvas
 */

get_header(); ?>

  <div class="container page-content">
    <div class="row">

      <?php
      while ( have_posts() ) : the_post();

        get_template_part( 'template-parts/content', 'single' );

      endwhile; // End of the loop.
      ?>
    </div>

  </div><!-- .container -->

<?php
get_footer();
?>
