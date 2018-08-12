<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jet_Stream
 */

?>

	</div><!-- .container-fluid -->
</div><!-- #content -->

<footer id="site-footer" class="banner-color">
	<div class="site-info container-fluid content-area">
		<div class="row">
			<div class="col-md-6">
				<p>Owned and Operated by Kerry Quick</p>
			</div>
			<div id="colophon" class="col-md-6">
				<p>Copyright &copy;<?php echo date('Y') . ' ' . get_bloginfo( 'name' ); ?></p>
			</div>
		</div><!-- .row -->
	</div><!-- .site-info -->
</footer><!-- #site-footer -->

<?php wp_footer(); ?>

</body>
</html>
