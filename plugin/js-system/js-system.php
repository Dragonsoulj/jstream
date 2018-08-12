<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://phoenixsoul.net
 * @since             1.0.0
 * @package           JS-System
 *
 * @wordpress-plugin
 * Plugin Name:       Jet Stream System
 * Plugin URI:        http://phoenixsoul.net
 * Description:       A plugin used for the Jet Stream website.
 * Version:           1.0.0
 * Author:            Jeremy Kennedy
 * Author URI:        http://phoenixsoul.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       JS-System
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'JS_SYSTEM_VERSION', '1.0.0' );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-js-system-activator.php
 */
function activate_js_system() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-js-system-activator.php';
	JS_System_Activator::activate();
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-js-system-deactivator.php
 */
function deactivate_js_system() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-js-system-deactivator.php';
	JS_System_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_js_system' );
register_deactivation_hook( __FILE__, 'deactivate_js_system' );
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-js-system.php';
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_js_system() {
	$plugin = new JS_System();
	$plugin->run();
}
run_js_system();
