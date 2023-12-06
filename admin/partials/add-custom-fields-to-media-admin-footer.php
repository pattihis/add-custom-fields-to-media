<?php
/**
 * Provide a admin area footer for the plugin
 *
 * This file is used to markup the footer in the admin-facing aspects of the plugin.
 *
 * @link       https://https://wordpress.org/plugins/add-custom-fields-to-media/
 * @since      2.0.0
 *
 * @package    Add_Custom_Fields_To_Media
 * @subpackage Add_Custom_Fields_To_Media/admin/partials
 */

?>

<div class="acfm-help">
	<h4>Usage</h4>
	<p>To display the custom fields in your theme, use the following shortcode in post/pages:</p>
	<code>
		[acfm id="123" field="my_custom_field"]
	</code>
	<p>Where <code>id</code> is the ID of the media item and <code>field</code> is the name of the custom field.</p>
	<p>For PHP templates, use the following code:</p>
	<code>echo get_post_meta( 123, 'my_custom_field', true );</code>
</div>

<div class="wrap">
	<p>If you find this free plugin useful then please <a target="_blank" href="https://wordpress.org/support/plugin/add-custom-fields-to-media/reviews/?rate=5#new-post" title="Rate the plugin">rate the plugin ★★★★★</a> to support us. Thank you!</p>
</div>
