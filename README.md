# Media Custom Fields (add-custom-fields-to-media)
_A WordPress plugin that allows users to add custom fields to media files._

## Description

**Media Custom Fields** Allows users to add custom fields to the media uploader and access those fields in posts or template files. Great for adding copyrights etc.

To display the custom fields in your theme, use the following shortcode in post/pages:

* <code>[acfm id="123" field="my_custom_field"]</code>

Where <code>id</code> is the ID of the media item and <code>field</code> is the name of the custom field.

For PHP templates, use the following code:

* <code>echo get_post_meta( 123, 'my_custom_field', true );</code>

To use this plugin effectively, download and intall it on your WordPress blog. Next, access "Media Custom Fields" page in your Admin Settings and create a new custom field for your media uploads.

* Unique ID - The unique variable name for this item. It may not contain special characaters or spaces
* Field Title - The name you want to appear in the media uploader
* Field Help - A descriptive message you want to appear in the media uploader

Once you've added a custom field, you can access it via the Media Library or during the Add Media process of uploading a new item.

### WordPress.org

* Download it: https://wordpress.org/plugins/add-custom-fields-to-media/
* Browse code: https://plugins.trac.wordpress.org/browser/add-custom-fields-to-media/
* Revision Log: https://plugins.trac.wordpress.org/log/add-custom-fields-to-media

### == Installation ==

1. In your WordPress admin panel, go to Plugins > New Plugin, search for "Add Custom Fields To Media" and click "Install now"
2. Alternatively, download the plugin and upload the contents of add-custom-fields-to-media.zip to your plugins directory, which usually is /wp-content/plugins/
3. Activate the plugin
4. Go to "Media Custom Fields" page in your Admin Settings
