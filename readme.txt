=== Add Custom Fields to Media ===
Contributors: christopherross,
Plugin URI: http://thisismyurl.com/downloads/add-custom-fields-to-media/
Tags: wordpress, media, upload, custom fields,adopt-me
Donate link: http://thisismyurl.com/downloads/add-custom-fields-to-media/?donate
Requires at least: 3.2.0
Tested up to: 4.1.0
Stable tag: 1.2.5

Allows users to add custom fields to the media uploader and access those fields in template files. Great for adding copyrights etc.

This plugin is maintained by Christopher Ross, http://thisismyurl.com or you can find him on Twitter at http://twitter.com/thisismyurl/

== Description ==

** this plugin is no longer being update. Please feel free to adopt me! **




Allows users to add custom fields to the media uploader and access those fields in template files. Great for adding copyrights etc.

Includes the following functions to help improve your website:

* <code>thisismyurl_get_custom_media_field( $attachment_id, $unique_field_id )</code> - Fetches the value
* <code>thisismyurl_has_custom_media_field( $attachment_id, $unique_field_id )</code> - Returns boolean value
* <code>thisismyurl_custom_media_field( $attachment_id, $unique_field_id )</code> - Displays the value

To use this plugin effectively, download and intall it on your WordPress blog. Next, access the settings page (Settings > Add Custom Fields to Media) and create a new custom field for your media uploads.

* Unique ID - The unique variable name for this item. It may not contain special characaters or spaces
* Field Title - The name you want to appear in the media uploader
* Field Help - A descriptive message you want to appear in the media uploader

Once you've added a custom field, you can access it via the Media menu in WordPress or during the Add Media process of uploading a new item.

To display the information on your website, please use <code>thisismyurl_custom_media_field( $attachment_id, $unique_field_id )</code>.

If you would like to load the contents into a variable, please use <code>thisismyurl_get_custom_media_field( $attachment_id, $unique_field_id )</code>

To check if a variable exists, use <code>thisismyurl_has_custom_media_field( $attachment_id, $unique_field_id )</code>

In all cases the $unique_field_id is the Unique ID you specified when creating the field.

The $attachment_id is the ID of the attachment itself (not the post that you're working with).

== Installation ==

To install the plugin, please upload the folder to your plugins folder and active the plugin.

== Screenshots ==

== Updates ==
Updates to the plugin will be posted to http://thisismyurl.com/downloads/add-custom-fields-to-media/

== Frequently Asked Questions ==

= How do I see the results? =

Includes the following functions to help improve your website:

* <code>thisismyurl_get_custom_media_field( $attachment_id, $unique_field_id )</code> - Fetches the value
* <code>thisismyurl_has_custom_media_field( $attachment_id, $unique_field_id )</code> - Returns boolean value
* <code>thisismyurl_custom_media_field( $attachment_id, $unique_field_id )</code> - Displays the value

= How do I add a photo credit to a featured image? =

Here's my code snippet for adding a photo credit directly under a featured image.

<code>

if ( thisismyurl_has_custom_media_field() ) {

	$credit_name = thisismyurl_get_custom_media_field( get_post_thumbnail_id( $post->ID ), 'credit_name' );
	$credit_url = thisismyurl_get_custom_media_field( get_post_thumbnail_id( $post->ID ), 'credit_url' );

	if ( empty( $credit_name ) )
		$credit_name = $credit_url;

	if ( !empty( $credit_url ) )
		$credit_text = '<a href="' . $credit_url . '" title="' . $credit_name . '">' . $credit_name . '</a>';
	else
		$credit_text = $credit_name;

	$credit_text =  '<div class="media-credit">' . $credit_text . '</div>';

	echo $credit_text;
}

</code>

Note that I named my Unique ID's credit_name and credit_url in this example, and am fetching the them based on the ID returned for the Post feature image using get_post_thumbnail_id( $post->ID ).

= Why does this plugin have thisismyurl_ before the function name? =

Each plugin added to WordPress has the potential to conflict with the core, theme, or other plugins. To ensure this plugin adds only unique code to your website, the prefix thisismyurl_ is added to each function. <a href="http://thisismyurl.com">thisismyurl</a> is my personal domain, as well as my <a href="http://twitter.com/thisismyurl">@thisismyurl</a> alias on Twitter. If you'd like to ask me questions about the plugin, please feel free to Tweet me.

= Where can I get more information, or technical support for this plugin? =

Technical support is available for free from the WordPress community on [wordpress.org](http://wordpress.org).

== Donations ==
If you would like to donate to help support future development of this tool, please visit http://thisismyurl.com/downloads/wordpress-plugins/


== Change Log ==

= 1.2.5 (March 31, 2013) = 

* fixed incorrectly named categories
* removed link to website from plugin links
* encoded and removed icon
* added support link

= 1.2.1 (September 13. 2012) =

* language customization
* renamed function for compatibility

= 1.2.0 (September 13. 2012) =

Added functions:

* <code>thisismyurl_has_custom_media_field( $attachment_id, $unique_field_id )</code> - Returns boolean value
* <code>thisismyurl_custom_media_field( $attachment_id, $unique_field_id )</code> - Displays the value

= 1.0.1 =

* fixed a bug in the fetch function

= 1.0.0 =

* initial release
