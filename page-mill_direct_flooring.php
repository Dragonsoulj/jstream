<?php
/**
 * Template Name: Mill Direct Flooring
 * The template for displaying the Mill Direct Flooring page
 *
 * @package Jet_Stream
 */

get_header();
?>

	<div id="primary" class="row">
		<main id="main" class="site-main col-12">

		<?php
		while ( have_posts() ) :
			the_post();
		?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->

				<?php if ( get_edit_post_link() ) : ?>
					<footer class="entry-footer">
						<?php
						edit_post_link(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Edit <span class="screen-reader-text">%s</span>', 'jstream' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							),
							'<span class="edit-link">',
							'</span>'
						);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php
				$flooring = js_get_flooring();

				foreach( $flooring as $floor ) {
			?>

				<div class="row service-box">
					<div class="col-12">
						<a class="service-toggle" href="<?php echo get_the_permalink( $floor ); ?>">
							<h2>
								<?php echo get_the_title( $floor ); ?>
								<div class="service-icon">
									<span class="fas fa-angle-right"></span>
								</div>
							</h2>
						</a>
					</div>
				</div>

			<?php } ?>

		<?php
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_footer();
