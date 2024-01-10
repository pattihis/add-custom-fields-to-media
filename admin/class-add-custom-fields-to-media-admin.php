<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://wordpress.org/plugins/add-custom-fields-to-media/
 * @since      2.0.0
 *
 * @package    Add_Custom_Fields_To_Media
 * @subpackage Add_Custom_Fields_To_Media/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Add_Custom_Fields_To_Media
 * @subpackage Add_Custom_Fields_To_Media/admin
 * @author     George Pattichis <gpattihis@gmail.com>
 */
class Add_Custom_Fields_To_Media_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/add-custom-fields-to-media-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {
	}

	/**
	 * Register the admin menu
	 *
	 * @since    2.0.0
	 */
	public function add_custom_fields_to_media_admin_menu() {

		$page_title = esc_html__( 'Media Custom Fields', 'add-custom-fields-to-media' );
		$menu_title = esc_html__( 'Media Custom Fields', 'add-custom-fields-to-media' );
		$capability = 'manage_options';
		$menu_slug  = 'add-custom-fields-to-media';
		$function   = array( $this, 'add_custom_fields_to_media_admin_page' );

		add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function, 20 );
	}

	/**
	 * Render the admin menu page content
	 *
	 * @since  2.0.0
	 * @access public
	 */
	public function add_custom_fields_to_media_admin_page() {
		$base = plugin_dir_url( __FILE__ );

		include_once 'partials/add-custom-fields-to-media-admin-display.php';
	}

	/**
	 * Show custom links in Plugins Page
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $links Default Links.
	 * @param  array $file Plugin's root filepath.
	 * @return array Links list to display in plugins page.
	 */
	public function add_custom_fields_to_media_plugin_links( $links, $file ) {

		if ( ADD_CUSTOM_FIELDS_TO_MEDIA_BASENAME === $file ) {
			$acfm_links = '<a href="' . get_admin_url() . 'options-general.php?page=add-custom-fields-to-media" title="Plugin Options">' . __( 'Settings', 'add-custom-fields-to-media' ) . '</a>';
			$acfm_visit = '<a href="https://gp-web.dev/" title="Contact" target="_blank" >' . __( 'Contact', 'add-custom-fields-to-media' ) . '</a>';
			array_unshift( $links, $acfm_visit );
			array_unshift( $links, $acfm_links );
		}

		return $links;
	}

	/**
	 * Adding a custom field to the media uploader $form_fields array
	 *
	 * @param array  $form_fields the array of form fields.
	 * @param object $post the post object.
	 *
	 * @return array
	 */
	public function hook_custom_media_fields( $form_fields, $post ) {

		$media_custom_fields = get_option( 'thisismyurl_custom_media_fields', null );

		foreach ( $media_custom_fields as $custom_field ) {

			$form_fields[ $custom_field['unique_id'] ] = array(
				'label' => $custom_field['name'],
				'value' => get_post_meta( $post->ID, '_' . $custom_field['unique_id'], true ),
				'helps' => $custom_field['help'],
			);
		}

		return $form_fields;
	}

	/**
	 * Save our new media field
	 *
	 * @param object $post the post object.
	 * @param object $attachment the attachment object.
	 *
	 * @return array
	 */
	public function save_custom_media_fields( $post, $attachment ) {

		$media_custom_fields = get_option( 'thisismyurl_custom_media_fields', null );

		foreach ( $media_custom_fields as $custom_field ) {

			if ( ! empty( $attachment[ $custom_field['unique_id'] ] ) ) {
				update_post_meta( $post['ID'], '_' . $custom_field['unique_id'], $attachment[ $custom_field['unique_id'] ] );
			} else {
				delete_post_meta( $post['ID'], '_' . $custom_field['unique_id'] );
			}
		}

		return $post;
	}
}
