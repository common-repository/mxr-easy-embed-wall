<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              none
 * @since             1.0.0
 * @package           mixer_wall
 *
 * @wordpress-plugin
 * Plugin Name:       Mixer Easy Embed (Wall)
 * Plugin URI:        https://www.streamweasels.com
 * Description:       Easily embed a group of Mixer Streams in your site with a simple shortcode and easy admin menu.
 * Version:           1.0.1
 * Author:            StreamWeasels
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mixer-wall
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mixer-wall-activator.php
 */
function activate_mixer_wall() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mixer-wall-activator.php';
	mixer_wall_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mixer-wall-deactivator.php
 */
function deactivate_mixer_wall() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mixer-wall-deactivator.php';
	mixer_wall_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mixer_wall' );
register_deactivation_hook( __FILE__, 'deactivate_mixer_wall' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mixer-wall.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mixer_wall() {

	$plugin = new mixer_wall();
	$plugin->run();

}
run_mixer_wall();
