<?php
/**
 * The frontend functionality of the plugin.
 *
 * @link       https://https://wordpress.org/plugins/add-custom-fields-to-media/
 * @since      2.0.0
 *
 * @package    Add_Custom_Fields_To_Media
 * @subpackage Add_Custom_Fields_To_Media/admin
 */

/**
 * The frontend functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the frontend stylesheet and JavaScript.
 *
 * @package    Add_Custom_Fields_To_Media
 * @subpackage Add_Custom_Fields_To_Media/admin
 * @author     George Pattichis <gpattihis@gmail.com>
 */
class Add_Custom_Fields_To_Media_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the frontend side of the site.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {
	}

	/**
	 * Render the shortcode [acfm].
	 *
	 * @param array $atts Shortcode attributes.
	 * @since    1.0.0
	 */
	public function display_custom_media_field( $atts ) {

		if ( ! is_array( $atts ) ) {
			$atts = array();
		}

		if ( ! isset( $atts['id'] ) || empty( $atts['id'] ) ) {
			$atts['id'] = '1';
		}

		if ( ! isset( $atts['field'] ) || empty( $atts['field'] ) ) {
			$atts['field'] = '';
		}

		ob_start();

		if ( ! is_admin() ) {
			$custom_fields = get_post_meta( $atts['id'], '_' . $atts['field'], true );
			if ( ! empty( $custom_fields ) ) {
				echo esc_html( $custom_fields );
			}
		}

		return ob_get_clean();
	}
}
