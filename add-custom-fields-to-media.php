<?php
/*
Plugin Name: Add Custom Fields to Media
Plugin URI: http://thisismyurl.com/plugins/add-custom-fields-to-media/
Description: Allows users to add custem text fields to the media upload tool.
Author: Christopher Ross
Author URI: http://thisismyurl.com/
Tags: media uploader, custom fields, photo copyright, add fields to photos, uploader, photo credit
Version: 1.2.5
*/

/**
 * Add Custom Fields to Media core file
 *
 * This file contains all the logic required for the plugin
 *
 * @link		http://wordpress.org/extend/plugins/add-custom-fields-to-media/
 *
 * @package 		Add Custom Fields to Media
 * @copyright		Copyright (c) 2013, Chrsitopher Ross
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Add Custom Fields to Media 1.0
 */


/**
 * Return our new unique field
 *
 * @param int $attachment_id	the attachment id
 * @param sting $unique_field_id 	the unique field name
 *
 * @return array
 */
function thisismyurl_get_custom_media_field( $attachment_id = null, $unique_field_id ) {

	$attachment_id = ( empty( $attachment_id ) ) ? get_post_thumbnail_id() : (int) $attachment_id;

	if ( $attachment_id )
		return get_post_meta( $attachment_id, '_' . $unique_field_id, true );

}

/**
 * Returns a boolean value based on if the unqiue field exists
 *
 * @param int $attachment_id	the attachment id
 * @param sting $unique_field_id 	the unique field name
 *
 * @return array
 */
function thisismyurl_has_custom_media_field( $attachment_id = null, $unique_field_id ) {

	$attachment_id = ( empty( $attachment_id ) ) ? get_post_thumbnail_id() : (int) $attachment_id;

	if ( $attachment_id )
		return get_post_meta( $attachment_id, '_' . $unique_field_id, true );

	if ( $attachment_id )
		return true;
	else
		return false;

}

/**
 * Echo our new unique field
 *
 * @param int $attachment_id	the attachment id
 * @param sting $unique_field_id 	the unique field name
 *
 * @return array
 */
function thisismyurl_custom_media_field( $attachment_id = null, $unique_field_id ) {

	echo thisismyurl_get_custom_media_field( $attachment_id, $unique_field_id );

}

/**
 * Adding a custom field to the media uploader $form_fields array
 *
 * @param array $form_fields
 * @param object $post
 *
 * @uses    http://bavotasan.com/2012/add-a-copyright-field-to-the-media-uploader-in-wordpress/
 *
 * @return array
 */
function thisismyurl_add_custom_media_fields( $form_fields, $post ) {

    $media_custom_fields = get_option( 'thisismyurl_custom_media_fields', NULL );

    foreach ( $media_custom_fields as $custom_field ) {

        $form_fields[ $custom_field['unique_id']  ] = array(
            'label' => $custom_field['name'] ,
            'value' => get_post_meta( $post->ID, '_' . $custom_field['unique_id'] , true ),
            'helps' => $custom_field['help']
        );

    }

	return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'thisismyurl_add_custom_media_fields', null, 2 );

/**
 * Save our new media field
 *
 * @param object $post
 * @param object $attachment
 *
 * @return array
 */
function thisismyurl_save_custom_media_fields( $post, $attachment ) {

    $media_custom_fields = get_option( 'thisismyurl_custom_media_fields', NULL );

    foreach ( $media_custom_fields as $custom_field ) {

        if ( ! empty( $attachment[ $custom_field['unique_id']  ] ) )
            update_post_meta( $post['ID'], '_' . $custom_field['unique_id'] , $attachment[ $custom_field['unique_id']  ] );
        else
            delete_post_meta( $post['ID'], '_' . $custom_field['unique_id']  );

    }

	return $post;
}
add_filter( 'attachment_fields_to_save', 'thisismyurl_save_custom_media_fields', null, 2 );


/**
 * Adds a settings link to the plugins menu
 */
function thisismyurl_add_custom_media_fields_plugin_page_menu( $links, $file ) {

	static $this_plugin;

	if( ! $this_plugin )
		$this_plugin = plugin_basename( __FILE__ );

	if( $file == $this_plugin ) {
		$links [] = '<a href="options-general.php?page=thisismyurl_add_custom_media_fields">' . __( 'Settings', 'thisismyurl_add_custom_media_fields' ) . '</a>';
    }

	return $links;

}
add_filter( 'plugin_action_links', 'thisismyurl_add_custom_media_fields_plugin_page_menu', 10, 2 );

/**
 *
 * Initialize the plugin
 *
 */
function thisismyurl_add_custom_media_fields_init( ) {

	register_setting( 'thisismyurl_add_custom_media_fields_options', 'thisismyurl_add_custom_media_fields', 'thisismyurl_add_custom_media_fields_validate' );

}
add_action( 'admin_init', 'thisismyurl_add_custom_media_fields_init' );


/**
 *
 * Add the option page
 *
 */
function thisismyurl_add_custom_media_fields_add_page( ) {
	add_options_page( __( 'Add Custom Fields to Media Upload', 'thisismyurl_add_custom_media_fields' ), __( 'Add Custom Fields to Media Upload', 'thisismyurl_add_custom_media_fields' ), 'manage_options', 'thisismyurl_add_custom_media_fields', 'thisismyurl_add_custom_media_fields_do_page' );
}
add_action( 'admin_menu', 'thisismyurl_add_custom_media_fields_add_page' );


/**
 *
 * Options page for WP Add Custom Fields to Media Upload
 *
 */
function thisismyurl_add_custom_media_fields_do_page( ) {

    $media_custom_fields = get_option( 'thisismyurl_custom_media_fields', NULL );

    /* save changes to the custom media fields */
    if ( isset( $_POST['unique_id'] ) ) {


        $media_custom_fields[] = array(     'unique_id' => esc_attr( $_POST['unique_id'] ),
                                            'name' => esc_attr( $_POST['field_title'] ),
                                            'help' => esc_attr( $_POST['field_help'] ),
                                        );

        update_option( 'thisismyurl_custom_media_fields', $media_custom_fields);

    }

    /* delete changes to the custom media fields */
    if ( ( $_GET['delete'] ) ) {

        foreach ( $media_custom_fields as $check_for_delete ) {

            if ( $check_for_delete['unique_id'] != urldecode( $_GET['delete'] ) ) {
                $new_custom_fields[] = array(   'unique_id' => esc_attr( $check_for_delete['unique_id'] ),
                                                'name' => esc_attr( $check_for_delete['name'] ),
                                                'help' => esc_attr( $check_for_delete['help'] ),
                                        );
            }
        }

        update_option( 'thisismyurl_custom_media_fields', $new_custom_fields);

    }


    $media_custom_fields = get_option( 'thisismyurl_custom_media_fields', NULL );

	?>
	<div class="wrap">
		<a href="http://thisismyurl.com/" class="thisismyurl-icon icon32"></a>

		<h2><?php _e( 'Add Custom Fields to Media Upload by Christopher Ross', 'thisismyurl_add_custom_media_fields' ); ?></h2>
        <p><?php _e( 'Adds custom fields to media uploader to allow users to add fields such as copyright holder details, photographer URL links etc.', 'thisismyurl_add_custom_media_fields' ); ?></p>
		<form method="post" action="options-general.php?page=thisismyurl_add_custom_media_fields">
			<?php
            if ( $media_custom_fields ) {
            ?>
            <h3><?php _e( 'Existing custom media fields', 'thisismyurl_add_custom_media_fields' ); ?></h3>
            <table class="form-table">

                <?php foreach ( $media_custom_fields as $custom_field ) { ?>
				<tr valign="top">

			<th scope="row"><?php echo $custom_field['unique_id']; ?></th>
                        <td><?php echo $custom_field['name']; ?></td>
                        <td><?php echo $custom_field['help']; ?></td>
                        <td><a href='options-general.php?page=thisismyurl_add_custom_media_fields&delete=<?php echo urlencode( $custom_field['unique_id'] ); ?>'>x</a></td>

				</tr>
                <?php $index_count++;} ?>
            </table>
            <?php } ?>

            <h3><?php _e( 'Add new field to media uploader', 'thisismyurl_add_custom_media_fields' ); ?></h3>
            <table class="form-table">
				<tr valign="top">
						<th scope="row"><?php _e( 'Unique ID', 'thisismyurl_add_custom_media_fields' ); ?></th>
						<td><input type="text" name="unique_id" id="unique_id" value=""><br><em><?php _e( 'Unique field names may not include spaces or special characters and should be lowercase. For example my_unique_id', 'thisismyurl_add_custom_media_fields' ); ?></em></td>
				</tr>
                <tr valign="top">
						<th scope="row"><?php _e( 'Field Title', 'thisismyurl_add_custom_media_fields' ); ?></th>
						<td><input type="text" name="field_title" id="field_title" value=""><br><em><?php _e( 'The field title, as displayed to users during media uploads.', 'thisismyurl_add_custom_media_fields' ); ?></em></td>
				</tr>
                <tr valign="top">
						<th scope="row"><?php _e( 'Field Help', 'thisismyurl_add_custom_media_fields' ); ?></th>
						<td><input type="text" name="field_help" id="field_help" value=""><br><em><?php _e( 'Helpful tips, displayed to users during media uploads.', 'thisismyurl_add_custom_media_fields' ); ?></em></td>
				</tr>

			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" />
			</p>
		</form>

		<h3><?php _e( 'Feedback' );?></h3>
		<p><?php _e( 'Did you find a bug? Have an idea for a plugin? Please help me improve this plugin.' );?>:</p>
		<ul>
			<li><a href="https://github.com/thisismyurl/Add-Custom-Fields-to-Media/issues"><?php _e( 'Report a bug, or suggest an improvement.' );?></a></li>
			<li><a href="http://twitter.com/thisismyurl/"><?php _e( 'Follow me on Twitter' );?></a></li>
			<li><a href="http://www.facebook.com/thisismyurlcom"><?php _e( 'Like me on Facebook' );?></a></li>
			<li><a href="http://thisismyurl.com"><?php _e( 'Read my blog' );?></a></li>
		</ul>

	</div>
	<?php
}


/**
 *
 * Validate the input
 *
 */
function thisismyurl_add_custom_media_fields_validate( $input ) {
	return $input;
}


/**
 * Adds CSS to the WordPress admin for this plugin
 * @return object  Description
 */
function thisismyurl_add_custom_media_fields_wordpress_scripts() {

	$screen = get_current_screen();
	if ( isset( $_GET['page'] ) ) {
		if ( $_GET['page'] == 'thisismyurl_add_custom_media_fields' ) {
		?>
		<style>
		.thisismyurl-icon {
			background-image: url( 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAAwFBMVEX////3+vv0+Prz+Pnu9ffr8/bn8PTm7/Th7fLf6/Hd6u/b6e7Z6O7W5uzV5ezS4+rO4enO4OjK3ufG3OXE2+TC2uPC2eO91uG71eC509+10t220t610d2z0Nyvztuqy9imyNekx9ajx9Wew9OcwtKZwNCSvM2Ru82OucuMtcWGtMiEtMeCssaBssWAsMV/sMV+sMR6rsJ6rcJ4rMF1qsBtpb1rpLxmoblhnrdhnbdamrRVlrJUlrFSlLBJj6z///9mas9kAAAAQHRSTlP///////////////////////////////////////////////////////////////////////////////////8AwnuxRAAAAeVJREFUOMtlk31jkzAQxp8wbIQqFOk02pWKG1JWhBa6KgPT7/+tvBAg2N1fJPfj7rmX4DrZp6fDuVZ2+P7R3GL8eDhlW4+BzPZ25Wl9AzinLMDMgix15sD6LNRtnKkMWUws2x7XBvhRciAs68lK4r3yywh8Jr+d1v9ZaoOXoQa8M6dDfWP0U3B81wMHAdv4hTcSNrapAjYFYOIXLJmygJUfCPgjIEzkwDPfIUR6xX0D6ARFqv7KtE/FLMHq9/iZQLz2lx7czNXBEtZzAeJveAmRy0Ydd6rROgDXXIwwheRopFQxisCnDu4UamsRGdwjJCDJXs81dS9wAJ4ULB5kkogRkH8LNSQW2DROZ6wDMIAM9RwdNSlRvAXqadS+S0EGwK4HkVK6ZhlYyNko8pcuU8pkvi5jZ6nMJzzuIQjwZ367+X0560YlD1h2QDdJ7K3WqmUHLhf9sKK5RviDX8aIKzXuxsJFyv0ENIP/AqtbqYV5ScA7GX61tD8aE3Dkz/1GLdoQbkl9DhVidYPfhWjv9NJu6NA/mahO9oP/wqm45bj2m0700S+jvC6iZsiNeTj3bUIheN7ra3LCrbxdzp/eoupiZiq14u757ubxriqZRz7JtPwol9Xqzeu+XpePVatStNVuYW7/ASVekhSn/mWeAAAAAElFTkSuQmCC' );
			width: 32px;
			height: 32px;
		}
		</style>
		<?php
		}
	}

}
add_action( 'admin_head', 'thisismyurl_add_custom_media_fields_wordpress_scripts' );

