<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package canvas
 */

?>
        </div> <!-- #content -->
        <!-- ================================================== -->

        <!-- Footer -->
        <footer class="site-footer">
          <div class="container">
            <div class="row">
              <div id="widget-1" class="col-md-3 widget">
                <?php dynamic_sidebar( 'footer-widget-1' ); ?>
              </div>
              <div id="widget-2" class="col-md-3 widget">
                <?php dynamic_sidebar( 'footer-widget-2' ); ?>
              </div>
              <div id="widget-3" class="col-md-3 widget">
                <?php dynamic_sidebar( 'footer-widget-3' ); ?>
              </div>
              <div id="widget-4" class="col-md-3 widget">
                <?php dynamic_sidebar( 'footer-widget-4' ); ?>
              </div>
            </div>
            <!-- ================================================== -->
            <div class="row copyright">
              <div class="col-md-12">
                <h6 class="text-muted text-center">2016 - <?php echo date("Y"); ?> &copy; <a href="#">Canvas Photography</a></h6>
                <h6 class="text-muted text-center">Theme by <a href="http://jobayerarman.github.io/" target="_blank">Jobayer Arman</a> Powered by <a href="http://wordpress.org/" target="_blank">WordPress</a></h6>
              </div>
            </div>
            <!-- ================================================== -->
            <div class="scroll-to-top"><i class="fa fa-angle-up"></i></div>
          </div>
        </footer>
        <!-- ================================================== -->
    </div><!-- #page -->
    <!-- ================================================== -->

    <?php wp_footer(); ?>
  </body>
</html>
