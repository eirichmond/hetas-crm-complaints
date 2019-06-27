<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://squareone.software
 * @since      1.0.0
 *
 * @package    Hetas_Crm_Complaints
 * @subpackage Hetas_Crm_Complaints/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Hetas_Crm_Complaints
 * @subpackage Hetas_Crm_Complaints/includes
 * @author     Elliott Richmond <elliott@squareonemd.co.uk>
 */
class Hetas_Crm_Complaints_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'hetas-crm-complaints',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
