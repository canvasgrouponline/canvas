<?php
  get_header();
?>

<!-- Carousel  ================================================== -->

<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <div class="container-fluid">
    <?php
      if ( is_front_page() && of_get_option( 'canvas_slider_checkbox' ) == 1 ) {
        $count    = of_get_option( 'canvas_slide_number' );
        $slidecat = of_get_option( 'canvas_slide_categories' );

        $query = new WP_Query( array( 'cat' =>$slidecat,'posts_per_page' =>1 ) );

        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();
    ?>

    <!-- Indicators -->
    <ol class="carousel-indicators">
      <?php for ($i=0; $i <= $count ; $i++) { ?>
        <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>"></li>
      <?php } ?>
    </ol>

    <!-- /Indicators -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <?php
          if ( (function_exists( 'has_post_thumbnail' )) && ( has_post_thumbnail() ) ) :
                echo the_post_thumbnail( 'canvas-featured', array( 'class' => 'img-responsive' ) );
          endif;
        ?>

        <div class="container">
          <div class="carousel-caption">
            <h1><?php if ( get_the_title() != '' ) the_title(); ?></h1>
            <?php if ( get_the_content() != '' ) the_excerpt(); ?>
          </div>
        </div>
      </div>

      <?php endwhile; endif; wp_reset_query(); ?>

      <?php
        $count    = of_get_option( 'canvas_slide_number' );
        $slidecat = of_get_option( 'canvas_slide_categories' );

        $query = new WP_Query( array( 'cat' =>$slidecat,'posts_per_page' =>$count, 'offset' =>1 ) );

        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();
      ?>



      <div class="item">
        <?php
          if ( (function_exists( 'has_post_thumbnail' )) && ( has_post_thumbnail() ) ) :
                echo the_post_thumbnail( 'canvas-featured', array( 'class' => 'img-responsive' ) );
          endif;
        ?>

        <div class="container">
          <div class="carousel-caption">
            <h1><?php if ( get_the_title() != '' ) the_title(); ?></h1>
            <?php if ( get_the_content() != '' ) the_excerpt(); ?>
          </div>
        </div>
      </div>
    <?php endwhile; endif; wp_reset_query(); }?>
    </div> <!-- /carousel-inner -->

    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="fa fa-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="fa fa-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div> <!-- /.carousel -->

<section class="slogan">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h4>Fulfill Your Dreams with Canvas</h4>
      </div>
      <div class="col-md-2 col-md-offset-2">
        <a href="//shop.canvasgrouponline.com/" type="button" class="btn btn-lg btn-ghost">Shop Now!</a>
      </div>
    </div>
  </div>
</section>

<section id="price-table" class="container">
  <div class="row">
    <div class="col-md-12">
      <h3 class="text-center">Photography and Cinematography (combo) Packages</h3>
      <hr>
    </div>
  </div>

  <div class="row text-center">
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title">Economy</h2>
          <h4 class="panel-title">7,000/- BDT</h4>
        </div>
        <ul class="list-group">
          <li class="list-group-item"><h6>Photographer: 02, Cinematographer: 1</h6></li>
          <li class="list-group-item"><h6>Unlimited Photos</h6></li>
          <li class="list-group-item"><h6>Couple, Portrait, Group &amp; Guest Photos</h6></li>
          <li class="list-group-item"><h6>Special Attention for Close Relatives of Brides &amp; Grooms</h6></li>
          <li class="list-group-item"><h6>Free Special Pre/Post Wedding Photo Shoot (With Bride &amp; Groom)</h6></li>
          <li class="list-group-item"><h6>3 Hours Per Day(Max)</h6></li>
          <li class="list-group-item"><h6>Printed Photos (Special Edited):<br>4R = 40 Copies</h6></li>
          <li class="list-group-item"><h6>Full HD Edited Video Trailer &amp; 30 Minutes Event</h6></li>
          <li class="list-group-item"><h6>All Photos &amp; Videos are Provided On DVD</h6></li>
        </ul>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title">Silver</h2>
          <h4 class="panel-title">8,000/- BDT</h4>
        </div>
        <ul class="list-group">
          <li class="list-group-item"><h6>Photographer: 03, Cinematographer: 1</h6></li>
          <li class="list-group-item"><h6>Unlimited Photos</h6></li>
          <li class="list-group-item"><h6>Couple, Portrait, Group &amp; Guest Photos</h6></li>
          <li class="list-group-item"><h6>Special Attention for Close Relatives of Brides &amp; Grooms</h6></li>
          <li class="list-group-item"><h6>Free Special Pre/Post Wedding Photo Shoot (With Bride &amp; Groom)</h6></li>
          <li class="list-group-item"><h6>4 Hours Per Day(Max)</h6></li>
          <li class="list-group-item"><h6>Printed Photos (Special Edited):<br>4R = 50 Copies</h6></li>
          <li class="list-group-item"><h6>Full HD Edited Video Trailer &amp; 35 Minutes Event</h6></li>
          <li class="list-group-item"><h6>Exclusive Photo Story</h6></li>
          <li class="list-group-item"><h6>All Photos &amp; Videos are Provided On DVD</h6></li>
        </ul>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title">Gold</h2>
          <h4 class="panel-title">10,000/- BDT</h4>
        </div>
        <ul class="list-group">
          <li class="list-group-item"><h6>Photographer: 03, Cinematographer: 1</h6></li>
          <li class="list-group-item"><h6>Unlimited Photos</h6></li>
          <li class="list-group-item"><h6>Couple, Portrait, Group &amp; Guest Photos</h6></li>
          <li class="list-group-item"><h6>Special Attention for Close Relatives of Brides &amp; Grooms</h6></li>
          <li class="list-group-item"><h6>Free Special Pre/Post Wedding Photo Shoot (With Bride &amp; Groom)</h6></li>
          <li class="list-group-item"><h6>Full Event Per Day(Max)</h6></li>
          <li class="list-group-item"><h6>Printed Photos (Special Edited):<br>4R = 70 Copies, Poster Size = 1 Copy</h6></li>
          <li class="list-group-item"><h6>Full HD Edited Video Trailer &amp; 45 Minutes Event</h6></li>
          <li class="list-group-item"><h6>One Photo Mug</h6></li>
          <li class="list-group-item"><h6>Exclusive Photo Story</h6></li>
          <li class="list-group-item"><h6>All Photos &amp; Videos are Provided On DVD</h6></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <h3 class="text-center">Photography Packages</h3>
      <hr>
    </div>
  </div>

  <div class="row text-center">
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title">Economy</h2>
          <h4 class="panel-title">4,000/- BDT</h4>
        </div>
        <ul class="list-group">
          <li class="list-group-item">
            <h6>Photographer: 02</h6>
          </li>
          <li class="list-group-item">
            <h6>Unlimited Photos</h6>
          </li>
          <li class="list-group-item">
            <h6>Couple, Portrait, Group &amp; Guest Photos</h6>
          </li>
          <li class="list-group-item">
            <h6>Special Attention for Close Relatives of Brides &amp; Grooms</h6>
          </li>
          <li class="list-group-item">
            <h6>Free Special Pre/Post Wedding Photo Shoot (With Bride &amp; Groom)</h6>
          </li>
          <li class="list-group-item">
            <h6>3 Hours Per Day(Max)</h6>
          </li>
          <li class="list-group-item">
            <h6>Printed Photos (Special Edited): 4R = 40 Copies</h6>
          </li>
          <li class="list-group-item">
            <h6>All Photos are Provided On DVD</h6>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title">Silver</h2>
          <h4 class="panel-title">5,000/- BDT</h4>
        </div>
        <ul class="list-group">
          <li class="list-group-item">
            <h6>Photographer: 03</h6>
          </li>
          <li class="list-group-item">
            <h6>Unlimited Photos</h6>
          </li>
          <li class="list-group-item">
            <h6>Couple, Portrait, Group &amp; Guest Photos</h6>
          </li>
          <li class="list-group-item">
            <h6>Special Attention for Close Relatives of Brides &amp; Grooms</h6>
          </li>
          <li class="list-group-item">
            <h6>Free Special Pre/Post Wedding Photo Shoot (With Bride &amp; Groom)</h6>
          </li>
          <li class="list-group-item">
            <h6>4 Hours Per Day(Max)</h6>
          </li>
          <li class="list-group-item">
            <h6>Printed Photos (Special Edited): 4R = 50 Copies</h6>
          </li>
          <li class="list-group-item">
            <h6>Exclusive Photo Story</h6>
          </li>
          <li class="list-group-item">
            <h6>All Photos are Provided On DVD</h6>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title">Gold</h2>
          <h4 class="panel-title">6,000/- BDT</h4>
        </div>
        <ul class="list-group">
          <li class="list-group-item">
            <h6>Photographer: 03</h6>
          </li>
          <li class="list-group-item">
            <h6>Unlimited Photos</h6>
          </li>
          <li class="list-group-item">
            <h6>Couple, Portrait, Group &amp; Guest Photos</h6>
          </li>
          <li class="list-group-item">
            <h6>Special Attention for Close Relatives of Brides &amp; Grooms</h6>
          </li>
          <li class="list-group-item">
            <h6>Free Special Pre/Post Wedding Photo Shoot (With Bride &amp; Groom)</h6>
          </li>
          <li class="list-group-item">
            <h6>Full Event Per Day(Max)</h6>
          </li>
          <li class="list-group-item">
            <h6>Printed Photos (Special Edited): 4R = 70 Copies, Poster Size = 1 Copy</h6>
          </li>
          <li class="list-group-item">
            <h6>One Photo Mug</h6>
          </li>
          <li class="list-group-item">
            <h6>Exclusive Photo Story</h6>
          </li>
          <li class="list-group-item">
            <h6>All Photos are Provided On DVD</h6>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="recent-post" class="container">
  <h3 class="text-center">Recent News</h3>
  <hr>

  <?php $query = new WP_Query( array( 'tag__not_in' => '6','posts_per_page' => 3 ) );
  if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
  <div class="row news-post">
    <div class="col-md-4">
      <?php the_post_thumbnail( 'medium', array('class' => 'img-responsive img-thumbnail')); ?>
    </div>
    <div class="col-md-8">
      <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
      <h6 class="text-muted">
        <i class="fa fa-user"></i> <?php the_author(); ?>
        <span class="post-meta"><i class="fa fa-calendar"></i> <?php the_date(); ?></span>
        <span class="post-meta"><i class="fa fa-folder-open-o"></i> <?php the_category(', '); ?></span>
      </h6>
      <hr>
      <p><?php echo get_the_excerpt(); ?></p>
      <a href="<?php the_permalink(); ?>" type="button" class="btn btn-ghost pull-right">Read More</a>
    </div>
  </div>
<?php endwhile; else : ?>
  <p><?php _e( 'Sorry, no recent post found.', 'canvas' ); ?></p>
<?php endif; ?>

</section>

<?php
get_footer();
?>
