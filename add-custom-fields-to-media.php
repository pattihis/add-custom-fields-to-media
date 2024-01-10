<?php
/**
 * The plugin's main file
 *
 * @link              https://wordpress.org/plugins/add-custom-fields-to-media/
 * @since             2.0.0
 * @package           Add_Custom_Fields_To_Media
 *
 * @wordpress-plugin
 * Plugin Name:       Add Custom Fields To Media
 * Plugin URI:        https://wordpress.org/plugins/add-custom-fields-to-media/
 * Description:       Allows users to add custom fields to the media uploader and access those fields in template files. Great for adding copyrights, image meta etc.
 * Version:           2.0.1
 * Author:            George Pattichis
 * Author URI:        https://profiles.wordpress.org/pattihis//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       add-custom-fields-to-media
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 *
 * @since 2.0.0
 */
define( 'ADD_CUSTOM_FIELDS_TO_MEDIA_VERSION', '2.0.1' );

/**
 * Plugin's basename.
 *
 * @since 2.0.0
 */
define( 'ADD_CUSTOM_FIELDS_TO_MEDIA_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-add-custom-fields-to-media-activator.php
 */
function activate_add_custom_fields_to_media() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-add-custom-fields-to-media-activator.php';
	Add_Custom_Fields_To_Media_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-add-custom-fields-to-media-deactivator.php
 */
function deactivate_add_custom_fields_to_media() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-add-custom-fields-to-media-deactivator.php';
	Add_Custom_Fields_To_Media_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_add_custom_fields_to_media' );
register_deactivation_hook( __FILE__, 'deactivate_add_custom_fields_to_media' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-add-custom-fields-to-media.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function run_add_custom_fields_to_media() {

	$plugin = new Add_Custom_Fields_To_Media();
	$plugin->run();
}
run_add_custom_fields_to_media();

/**
 * Keeping the below functions for backwards compatibility
 * with the old version of the plugin.
 */

/**
 * Return our new unique field
 *
 * @param int   $attachment_id    the attachment id.
 * @param sting $unique_field_id    the unique field name.
 *
 * @since    1.0.0
 * @return array
 */
function thisismyurl_get_custom_media_field( $attachment_id, $unique_field_id ) {

	$attachment_id = ( empty( $attachment_id ) ) ? get_post_thumbnail_id() : (int) $attachment_id;

	if ( $attachment_id ) {
		return get_post_meta( $attachment_id, '_' . $unique_field_id, true );
	}
}

/**
 * Returns a boolean value based on if the unqiue field exists
 *
 * @param int   $attachment_id    the attachment id.
 * @param sting $unique_field_id    the unique field name.
 *
 * @since    1.0.0
 * @return array
 */
function thisismyurl_has_custom_media_field( $attachment_id, $unique_field_id ) {

	$attachment_id = ( empty( $attachment_id ) ) ? get_post_thumbnail_id() : (int) $attachment_id;

	if ( $attachment_id ) {
		return get_post_meta( $attachment_id, '_' . $unique_field_id, true );
	}

	if ( $attachment_id ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Echo our new unique field
 *
 * @param int   $attachment_id    the attachment id.
 * @param sting $unique_field_id    the unique field name.
 *
 * @since    1.0.0
 */
function thisismyurl_custom_media_field( $attachment_id, $unique_field_id ) {

	echo esc_html( thisismyurl_get_custom_media_field( $attachment_id, $unique_field_id ) );
}
