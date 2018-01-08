<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.castrocountryclub.org
 * @since             1.0.0
 * @package           Castro_CC
 *
 * @wordpress-plugin
 * Plugin Name:       CastroCC
 * Plugin URI:        http://www.castrocountryclub.org
 * Description:       Use this plug in for Castro Country Club functions
 * Version:           1.0.0
 * Author:            Mario Hernandez
 * Author URI:        http://www.castrocountryclub.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       castrocc
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-castrocc-activator.php
 */
function activate_castrocc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-castrocc-activator.php';
	CastroCC_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-castrocc-deactivator.php
 */
function deactivate_castrocc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-castrocc-deactivator.php';
	CastroCC_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_castrocc' );
register_deactivation_hook( __FILE__, 'deactivate_castrocc' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-castrocc.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_castrocc() {

	$plugin = new CastroCC();
	$plugin->run();

}
run_castrocc();
