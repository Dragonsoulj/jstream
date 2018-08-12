<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jet_Stream
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header id="masthead" class="site-header banner-color">
	<div class="container-fluid content-area">
		<div class="site-branding row">
			<div id="logo" class="col">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/jStreamLogo3.png">
			</div>
		</div><!-- .site-branding -->
	</div><!-- .container -->
</header><!-- #masthead -->

<div id="navigation-bar">
	<div class="container-fluid content-area">
		<nav id="main-navigation" class="navbar navbar-expand-md row">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-label">
					<span class="fas fa-bars"></span>
					Navigation
				</span>
			</button>
			<?php
				wp_nav_menu( array(
					'theme_location' 	=> 'main-menu-left',
					'menu_id'        	=> 'left-menu',
					'container'				=> 'div',
					'container_class'	=> 'collapse navbar-collapse main-navbar col-md-8',
					'container_id'		=> 'main-navbar-left',
					'items_wrap'			=> '<ul class="navbar-nav mr-auto">%3$s</ul>',
					'walker'					=> new jstream_nav_walker(),
				) );
			?>
			<?php
				wp_nav_menu( array(
					'theme_location' 	=> 'main-menu-right',
					'menu_id'        	=> 'right-menu',
					'container'				=> 'div',
					'container_class'	=> 'collapse navbar-collapse main-navbar col-md-4',
					'container_id'		=> 'main-navbar-right',
					'items_wrap'			=> '<ul class="navbar-nav ml-auto">%3$s</ul>',
					'walker'					=> new jstream_nav_walker(),
				) );
			?>
		</nav><!-- .row -->
	</div><!-- .container-fluid -->
</div><!-- #navigation-bar -->

<div id="site-content">
	<div class="container-fluid content-area">
