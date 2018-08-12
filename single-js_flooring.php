<?php
/**
 * Template Name: Flooring
 * The template for displaying the Flooring pages
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

			<div class="row service-box">
				<div class="col-12">
					<a class="service-toggle" href="http://js.dragonsoulj.com/mill-direct-flooring/">
						<h2>
							<div class="service-icon">
								<span class="fas fa-angle-left"></span>
							</div>
							Back to Mill Direct Flooring
						</h2>
					</a>
				</div>
			</div>

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
				$flooring = js_get_flooring_children( get_the_ID() );

				if ( ! empty( $flooring ) ) {
					foreach( $flooring as $floor ) {
			?>

					<div class="row service-box">
						<div class="col-12">
							<a class="service-toggle" href=".service-<?php echo str_pad( $floor, 4, '0', STR_PAD_LEFT ); ?>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls=".service-<?php echo str_pad( $floor, 4, '0', STR_PAD_LEFT ); ?>">
								<h2>
									<?php echo get_the_title( $floor ); ?>
									<div class="service-icon service-<?php echo str_pad( $floor, 4, '0', STR_PAD_LEFT ); ?>-icon">
										<span class="fas fa-angle-right"></span>
									</div>
								</h2>
							</a>
						</div>
						<div class="col-12">
							<div id="service-<?php echo str_pad( $floor, 4, '0', STR_PAD_LEFT ); ?>" class="service-description service-<?php echo str_pad( $floor, 4, '0', STR_PAD_LEFT ); ?> collapse no-transition">
								<?php echo apply_filters( 'the_content', get_post_field( 'post_content', $floor ) ); ?>

								<?php if ( get_edit_post_link( $floor ) ) : ?>
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
												get_the_title( $floor )
											),
											'<span class="edit-link">',
											'</span>',
											$floor
										);
										?>
									</footer><!-- .entry-footer -->
								<?php endif; ?>
								</footer><!-- .entry-footer -->
							</div>
						</div>
					</div>

			<?php
						}
					}
			?>

		<?php
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php
get_footer();
