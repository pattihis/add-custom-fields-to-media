<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://wordpress.org/plugins/add-custom-fields-to-media/
 * @since      2.0.0
 *
 * @package    Add_Custom_Fields_To_Media
 * @subpackage Add_Custom_Fields_To_Media/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      2.0.0
 * @package    Add_Custom_Fields_To_Media
 * @subpackage Add_Custom_Fields_To_Media/includes
 * @author     George Pattichis <gpattihis@gmail.com>
 */
class Add_Custom_Fields_To_Media_I18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    2.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'add-custom-fields-to-media',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
