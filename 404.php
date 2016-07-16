<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package canvas
 */

get_header(); ?>

	<div class="container">
		<div class="row">

			<section class="col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2">
					<div class="page-content">
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/inc/images/background/404.jpg" alt="" class="img-responsive">
					</div>
			</section><!-- col-md-12 -->

		</div><!-- row -->
	</div><!-- container -->

<?php get_footer(); ?>
