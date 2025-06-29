=== Add Custom Fields to Media ===
Contributors: pattihis
Plugin URI: https://wordpress.org/plugins/add-custom-fields-to-media/
Tags: wordpress, media, upload, custom fields, meta fields
Donate link: https://profiles.wordpress.org/pattihis/
Requires at least: 5.2
Tested up to: 6.8
Requires PHP: 7.2
Stable tag: 2.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows users to add custom fields to the media uploader and access those fields in posts or template files. Great for adding copyrights, image meta etc.

== Description ==

Allows users to add custom fields to the media uploader and access those fields in posts or template files. Great for adding copyrights, image meta etc.

To display the custom fields in your theme, use the following shortcode in post/pages:

* <code>[acfm id="123" field="my_custom_field"]</code>

Where <code>id</code> is the ID of the media item and <code>field</code> is the name of the custom field.

For PHP templates, use the following code:

* <code>echo get_post_meta( 123, 'my_custom_field', true );</code>

To use this plugin effectively, download and intall it on your WordPress blog. Next, access "Media Custom Fields" page in your admin Settings and create a new custom field for your media uploads.

* Unique ID - The unique variable name for this item. It may not contain special characaters or spaces
* Field Title - The name you want to appear in the media uploader
* Field Help - A descriptive message you want to appear in the media uploader

Once you've added a custom field, you can access it via the Media Library or during the Add Media process of uploading a new item.

This plugin was originally developed by [Christopher Ross](https://profiles.wordpress.org/christopherross/). The plugin has been adopted and refactored by [George Pattichis](https://profiles.wordpress.org/pattihis/) who will continue development and maintenance.

[Changelog](http://wordpress.org/extend/plugins/add-custom-fields-to-media/changelog/)

== Installation ==

1. In your WordPress admin panel, go to Plugins > New Plugin, search for "Add Custom Fields To Media" and click "Install now"
2. Alternatively, download the plugin and upload the contents of add-custom-fields-to-media.zip to your plugins directory, which usually is /wp-content/plugins/
3. Activate the plugin
4. Go to "Media Custom Fields" page in your admin Settings

== Frequently Asked Questions ==

= How do I display the contents of the custom fields? =

* <code>[acfm id="123" field="my_custom_field"]</code> - Shortcode
* <code>echo get_post_meta( 123, 'my_custom_field', true );</code> - PHP code

= Where can I get more information, or technical support for this plugin? =

You can post in the [support forum](https://wordpress.org/support/plugin/add-custom-fields-to-media/) or [contact me](https://profiles.wordpress.org/pattihis/).

== Screenshots ==

1. Plugin settings page
2. The custom fields in media library

== Changelog ==

= 2.0.3 =
* Full compliance with WordPress Coding Standards (PHPCS)
* Improved file docblocks and inline comments for standards
* Enhanced security and sanitization review
* Compatibility with WordPress v6.8

= 2.0.2 =
* Compatibility with WordPress v6.7

= 2.0.1 =
* Add links in plugins page
* Fix Typo about URLs
* Update Readme.txt
* Update translations

= 2.0.0 (January, 2024) =
* Major Update
* Compatibility refactoring
* WP Coding Standards
* Added shortcode [acfm]

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
