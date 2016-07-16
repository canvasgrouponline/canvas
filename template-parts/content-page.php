<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package canvas
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12'); ?>>

    <div class="page-content">
        <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'canvas' ),
                'after'  => '</div>',
            ) );
        ?>
    </div> <!-- page-content -->

    <?php
      edit_post_link(
        sprintf(
          /* translators: %s: Name of current post */
          esc_html__( 'Edit %s', 'canvas' ),
          the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ),'', '', 0, 'btn btn-info edit-content'
      );
    ?>


</article><!-- #post-## -->
