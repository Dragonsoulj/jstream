<?php
/**
 * Template Name: About Us
 * The template for displaying the About Us page
 *
 * @package Jet_Stream
 */

get_header();
?>

	<div id="primary" class="row">
		<main id="main" class="site-main col-md-8">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page-no-header' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->

		<div id="secondary" class="col-md-4">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/KerryVivian.png" />
			<div class="row contact-info">
				<div class="col-4 col-md-5">
					<p>Office:</p>
				</div>
				<div class="col-8 col-md-7">
					<a href="tel:1-843-248-4429">(843) 248-4429</a>
				</div>
				<div class="col-4 col-md-5">
					<p>Urgent:</p>
				</div>
				<div class="col-8 col-md-7">
					<a href="tel:1-843-246-0288">(843) 246-0288</a>
				</div>
				<div class="col-4 col-md-5">
					<p>Email:</p>
				</div>
				<div class="col-8 col-md-7">
					<a href="mailto:jstream@sccoast.net">Email Us</a>
				</div>
				<div class="col-4 col-md-5">
					<p>Mail:</p>
				</div>
				<div class="col-8 col-md-7">
					<span>P.O. Box 764</span><br /><span>Conway, SC 29528</span>
				</div>
			</div>
		</div><!-- #secondary -->
	</div><!-- #primary -->

<?php
get_footer();
