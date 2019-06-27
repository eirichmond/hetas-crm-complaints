<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://squareone.software
 * @since             1.0.0
 * @package           Hetas_Crm_Complaints
 *
 * @wordpress-plugin
 * Plugin Name:       HETAS CRM Complaints
 * Plugin URI:        https://hetas.co.uk
 * Description:       This plugin deals with all complaints registered and syncs them to the CRM.
 * Version:           1.0.0
 * Author:            Elliott Richmond
 * Author URI:        https://squareone.software
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hetas-crm-complaints
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hetas-crm-complaints-activator.php
 */
function activate_hetas_crm_complaints() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hetas-crm-complaints-activator.php';
	Hetas_Crm_Complaints_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hetas-crm-complaints-deactivator.php
 */
function deactivate_hetas_crm_complaints() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hetas-crm-complaints-deactivator.php';
	Hetas_Crm_Complaints_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hetas_crm_complaints' );
register_deactivation_hook( __FILE__, 'deactivate_hetas_crm_complaints' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-hetas-crm-complaints.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hetas_crm_complaints() {

	$plugin = new Hetas_Crm_Complaints();
	$plugin->run();

}
run_hetas_crm_complaints();
