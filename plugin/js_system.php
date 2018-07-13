<?php
/**
 * Plugin Name: Jet Stream System
 * Plugin URI: http://phoenixsoul.net
 * Description: A plugin used for the Jet Stream website.
 * Version: 1.0
 * Author: Jeremy Kennedy
 * Author URI: http://phoenixsoul.net
 *
 */

defined( 'ABSPATH' ) or die( "Go hack elsewhere." );

/**
 * Function run on activation
 */
function js_registration()
{
  js_create_service_post_type();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'js_registration' );

/**
 * Function run on deactivation
 */
function js_deactivation()
{
	js_create_service_post_type();
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'js_deactivation' );

/**
 * Function to create Service post type
 */
function js_create_service_post_type()
{
	$labels = array(
		'name'               => 'Services',
		'singular_name'      => 'Service',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Service',
		'edit_item'          => 'Edit Service',
		'new_item'           => 'New Service',
		'all_items'          => 'All Services',
		'view_item'          => 'View Service',
		'search_items'       => 'Search Services',
		'not_found'          => 'No Services found',
		'not_found_in_trash' => 'No Services found in the Trash',
		'parent_item_colon'  => '',
		'menu_name'          => 'Services',
	);

	$supports = array(
		'title',
    'editor',
		'revisions',
		'page-attributes',
	);

	$args = array(
		'labels' => $labels,
		'description' => 'Contains all Services to be displayed.',
		'public' => true,
		'menu_position' => 5,
		'supports' => $supports,
		'has_archive' => false,
		'menu_icon' => 'dashicons-hammer',
	);

	register_post_type( 'js_services', $args );
}
add_action( 'init', 'js_create_service_post_type' );

/**
 * Function to change Service messages
 */
function js_services_change_messages( $messages )
{
	global $post, $post_ID;
	$messages[ 'js_services' ] = array(
		0  => '',
		1  => 'Service updated.',
		2  => 'Custom field updated.',
		3  => 'Custom field deleted.',
		4  => 'Service updated.',
		5  => isset( $_GET[ 'revision' ] ) ? sprintf( 'Service restored to revision from %s', wp_post_revision_title( (int) $_GET[ 'revision' ], false ) ) : '',
		6  => 'Service published.',
		7  => 'Service saved.',
		8  => 'Service submitted.',
		9  => sprintf( 'Service scheduled for: <strong>%1%s</strong>.' , date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => 'Service draft updated.'
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'js_services_change_messages' );

/**
 * Function to retrieve Services
 */
function js_get_services()
{
	return get_posts( array(
		'fields' => 'ids',
		'post_type' => 'js_services',
		'posts_per_page' => 100,
		'orderby' => 'menu_order',
		'order' => 'ASC'
	) );
}

?>
