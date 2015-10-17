<?php

$required_plugins = [
    
    '/advanced-custom-fields-font-awesome/acf-font-awesome.php',
    '/amazon-web-services/amazon-web-services.php',
    '/amazon-s3-and-cloudfront/wordpress-s3.php',
    '/easy-wp-smtp/easy-wp-smtp.php',

];

foreach($required_plugins as $required)
{
    require_once WPMU_PLUGIN_DIR . $required;
}

define( 'AWS_ACCESS_KEY_ID', env('AWS_ACCESS_KEY_ID') );
define( 'AWS_SECRET_ACCESS_KEY', env('AWS_SECRET_ACCESS_KEY') );

add_filter( 'the_content', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="btn-load-more"';
}

/* --------------------------------------------------------------------
Remove Unwanted Menu Items from the WordPress Dashboard
- Requires WordPress 3.1+
-------------------------------------------------------------------- */
function sb_remove_admin_menus (){

  // Check that the built-in WordPress function remove_menu_page() exists in the current installation
  if ( function_exists('remove_menu_page') ) { 

    /* Remove unwanted menu items by passing their slug to the remove_menu_item() function.
    You can comment out the items you want to keep. */

    remove_menu_page('index.php'); // Dashboard tab
    remove_menu_page('edit.php'); // Posts
    remove_menu_page('edit.php?post_type=page'); // Pages
    //remove_menu_page('upload.php'); // Media
    remove_menu_page('link-manager.php'); // Links
    remove_menu_page('edit-comments.php'); // Comments
    remove_menu_page('themes.php'); // Appearance
    remove_menu_page('plugins.php'); // Plugins
    //remove_menu_page('users.php'); // Users
    remove_menu_page('tools.php'); // Tools
    //remove_menu_page('options-general.php'); // Settings

  }

}
// Add our function to the admin_menu action
add_action('admin_menu', 'sb_remove_admin_menus'); 

/**
 * Adds the ability for v-card to be uploaded to media uploader.  Add additional mime types here as needed.
 */
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
    // add your extension to the array
    $existing_mimes['vcf'] = 'text/x-vcard';
    return $existing_mimes;
}