<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://wordpress.org/plugins/add-custom-fields-to-media/
 * @since      2.0.0
 *
 * @package    Add_Custom_Fields_To_Media
 * @subpackage Add_Custom_Fields_To_Media/admin/partials
 */

?>
<div class="acfm-header">
	<h1><img src="<?php echo esc_url( $base ); ?>img/acfm.svg" width="22" height="22" alt="" />&nbsp;<?php esc_html_e( 'Add Custom Fields To Media', 'add-custom-fields-to-media' ); ?></h1>
</div>
<?php

esc_html_e( 'Add custom fields to media library to allow users to add fields such as copyright holder details, photographer URL links etc.', 'add-custom-fields-to-media' );

$media_custom_fields = get_option( 'thisismyurl_custom_media_fields', null );

$nonce = isset( $_REQUEST['_wpnonce'] ) ? wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) ), 'media_custom_fields_nonce' ) : false;

if ( $nonce && isset( $_POST['unique_id'] ) && ! empty( $_POST['unique_id'] ) && isset( $_POST['field_title'] ) && ! empty( $_POST['field_title'] ) && isset( $_POST['field_help'] ) ) {
	if ( ! is_array( $media_custom_fields ) ) {
		$media_custom_fields = array();
	}
	$media_custom_fields[] = array(
		'unique_id' => sanitize_text_field( wp_unslash( $_POST['unique_id'] ) ),
		'name'      => sanitize_text_field( wp_unslash( $_POST['field_title'] ) ),
		'help'      => sanitize_text_field( wp_unslash( $_POST['field_help'] ) ),
	);
	update_option( 'thisismyurl_custom_media_fields', $media_custom_fields );
}

if ( ( isset( $_GET['delete'] ) && ! empty( $_GET['delete'] ) ) && is_array( $media_custom_fields ) ) {
	foreach ( $media_custom_fields as $check_for_delete ) {
		if ( urldecode( sanitize_text_field( wp_unslash( $_GET['delete'] ) ) ) !== $check_for_delete['unique_id'] ) {
			$new_custom_fields[] = array(
				'unique_id' => esc_attr( $check_for_delete['unique_id'] ),
				'name'      => esc_attr( $check_for_delete['name'] ),
				'help'      => esc_attr( $check_for_delete['help'] ),
			);
		}
	}
	update_option( 'thisismyurl_custom_media_fields', $new_custom_fields );
}

$media_custom_fields = get_option( 'thisismyurl_custom_media_fields', null );

if ( $media_custom_fields ) :
	?>
	<div class="acfm-fields-table">
		<h3><?php esc_html_e( 'Existing custom media fields', 'add-custom-fields-to-media' ); ?></h3>
		<table class="form-table">
			<thead>
				<tr>
					<td>Unique ID</td>
					<td>Field Name</td>
					<td>Help Text</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $media_custom_fields as $custom_field ) { ?>
					<tr valign="top">
						<td><?php echo esc_html( $custom_field['unique_id'] ); ?></td>
						<td><?php echo esc_html( $custom_field['name'] ); ?></td>
						<td><?php echo esc_html( $custom_field['help'] ); ?></td>
						<td><a href="<?php echo esc_url( 'options-general.php?page=add-custom-fields-to-media&delete=' . $custom_field['unique_id'] ); ?>" style="text-decoration: none;" title="Delete Field"><span class="dashicons dashicons-trash"></span></a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php endif; ?>
<h3><?php esc_html_e( 'Add new field to Media', 'add-custom-fields-to-media' ); ?></h3>
<form method="post" action="options-general.php?page=add-custom-fields-to-media" class="acfm-form">
	<table class="form-table">
		<tr valign="top">
			<th scope="row"><?php esc_html_e( 'Unique ID', 'add-custom-fields-to-media' ); ?></th>
			<td><input type="text" name="unique_id" id="unique_id" value=""><br><em><?php esc_html_e( 'This should not include spaces or special characters and should be lowercase. For example', 'add-custom-fields-to-media' ); ?></em>&nbsp;<code>my_unique_id</code></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php esc_html_e( 'Field Title', 'add-custom-fields-to-media' ); ?></th>
			<td><input type="text" name="field_title" id="field_title" value=""><br><em><?php esc_html_e( 'The field title, as displayed to users during media uploads or in the library.', 'add-custom-fields-to-media' ); ?></em></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php esc_html_e( 'Field Help', 'add-custom-fields-to-media' ); ?></th>
			<td><input type="text" name="field_help" id="field_help" value=""><br><em><?php esc_html_e( 'Helpful tips, displayed to users describing this field.', 'add-custom-fields-to-media' ); ?></em></td>
		</tr>

	</table>
	<p class="submit">
		<input type="submit" class="button-primary" value="<?php esc_html_e( 'Save Changes', 'add-custom-fields-to-media' ); ?>" />
	</p>
	<?php wp_nonce_field( 'media_custom_fields_nonce' ); ?>
</form>
<?php

require_once 'add-custom-fields-to-media-admin-footer.php';
