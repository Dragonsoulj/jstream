<?php
/**
 * Template Name: Home Page
 * The template for displaying the Home Page
 *
 * @package Jet_Stream
 */

get_header();
?>

	<div id="primary" class="content-area row">
		<main id="main" class="site-main col-md-8 col-lg-7 offset-lg-1">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page-no-header' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->

		<div id="side-logos" class="col-md-4 col-lg-3">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/SOA1.png" />
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/WhiteMagic1.png" />
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mohawk1.jpg" />
		</div><!-- #side-logos -->
	</div><!-- #primary -->

<?php
get_footer();
