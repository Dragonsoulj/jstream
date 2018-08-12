<?php
/**
 * Template Name: Home
 * The template for displaying the Home page
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
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/SOA1.png" />
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/WhiteMagic1.png" />
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mohawk1.jpg" />
		</div><!-- #secondary -->
	</div><!-- #primary -->

<?php
get_footer();
