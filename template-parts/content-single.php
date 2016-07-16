<?php
/**
 * Template part for displaying all the posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package canvas
 */

?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('col-md-8'); ?>>
    <header>

      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <?php
            if ( has_post_thumbnail()) : the_post_thumbnail('large', array( 'class' => 'img-responsive img-thumbnail' ));
            endif;
          ?>
        </div>
      </div>


      <?php
        if ( is_single() ) {
          the_title( '<h4 class="entry-title">', '</h4>' );
        } else {
          the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
        }
      ?>
      <h6 class="text-muted">
        <i class="fa fa-user"></i> <?php the_author(); ?>
        <span class="post-meta"><i class="fa fa-calendar"></i> <?php the_date(); ?></span>
        <span class="post-meta"><i class="fa fa-folder-open-o"></i> <?php the_category(','); ?></span>
        <hr>
      </h6>
    </header><!-- header -->

    <div>
      <?php
      the_content( sprintf(
        /* translators: %s: Name of current post. */
        wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'canvas' ), array( 'span' => array( 'class' => array() ) ) ),
        the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ) );
      ?>
    </div><!-- content -->

      <?php
      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'canvas' ),
        'after'  => '</div>',
        ) );
      ?>

  </article><!-- #post-## -->
