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
		</div><!-- #secondary -->
	</div><!-- #primary -->

<?php
get_footer();
