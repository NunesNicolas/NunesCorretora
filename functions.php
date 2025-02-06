<?php

/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */


/**
 * Scripts
 */

require_once('model/scripts.php');

/**
 * Supports Wordpress
 */

add_theme_support('post-thumbnails');

/**
 * Remove Site Health
 */
add_action('wp_dashboard_setup', 'remove_site_health_dashboard_widget');
function remove_site_health_dashboard_widget()
{
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
}

add_filter('wp_fatal_error_handler_enabled', '__return_false');

add_action('admin_menu', 'remove_site_health_menu');

function remove_site_health_menu()
{
    remove_submenu_page('tools.php', 'site-health.php');
}

/**
 * Post Types (Custom Fields and Custom Category)
 */

require_once('model/post-types/news/news.php'); #News
require_once('model/post-types/news/type-publications.php'); #News
require_once('model/post-types/news/type-publications.php'); #News

require_once('model/post-types/banners/banners.php'); #Banners
require_once('model/post-types/banners/custom-fields.php'); #Banners

/**
 *  Ajax
 */

 require_once('model/ajax/filters/publications.php'); #Publicações

 /* 
* GET Thumbnail
*/

function check_url_thumbnail($url)
{

  // Use get_headers() function
  $headers = @get_headers($url);

  // Use condition to check the existence of URL
  if ($headers && strpos($headers[0], '200')) {
    $status = true;
  } else {
    $status = false;
  }

  return $status;
}

function my_post_title_updater($post_id)
{
  $post_type = get_post_type();

  if ($post_type == 'banner') {

    $title_field = get_field('local_banner', $post_id);

    wp_update_post(array('ID' => $post_id, 'post_title' => $title_field));
  }
}

function wpdocs_remove_menus()
{
    /*
  remove_menu_page('index.php');                  //Dashboard
  remove_menu_page('jetpack');                    //Jetpack* 
  //remove_menu_page('edit.php');                   //Posts
  remove_menu_page('upload.php');                 //Media
  remove_menu_page('edit.php?post_type=page');    //Pages
  remove_menu_page('edit-comments.php');          //Comments
  remove_menu_page('themes.php');                 //Appearance
  remove_menu_page('plugins.php');                //Plugins
  remove_menu_page('tools.php');                  //Tools
  remove_menu_page('options-general.php');        //Settings
  remove_menu_page('edit.php?post_type=acf-field-group'); //ACF
  remove_menu_page('edit.php?post_type=podcast'); //PODCAST 
  */
}
add_action('admin_menu', 'wpdocs_remove_menus');