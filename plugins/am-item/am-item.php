<?php
/*
Plugin Name: AM Item
Description: Create and View AM Item
Plugin URI: https://automeans.com
Author: Leah Fuentes
Version: 1.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl.html
*/
if(!defined('ABSPATH')){
    exit;
}
if (!defined('AMITEM_PLUGIN'))
    define('AMITEM_PLUGIN', trim(dirname(plugin_basename(__FILE__)), '/'));

if (!defined('AMITEM_PLUGIN_URL'))
    define('SEARCHANDFILTER_PLUGIN_URL', WP_PLUGIN_URL . '/' . AMITEM_PLUGIN);

if (!defined('AMITEM_BASENAME'))
    define('AMITEM_BASENAME', plugin_basename(__FILE__));

function amitem_add_menu(){
    $icon_url = WP_PLUGIN_URL.'/am-item/admin/icon.png';
    add_menu_page(
        'Auto Means Item Settings', //page_title
        'Auto Means',   //menu_title
        'manage_options', //capability
        'amitem', //menu slogs,
        'amitem_display_settings_page',
        $icon_url,
        null
    );
}
//display the plugin settings page
function amitem_display_settings_page(){
    //check if user is allowed access
    if(!current_user_can('manage_options'))
         wp_die('You do not have sufficient permissions to access this page.');;

    //display output
    echo '<div class="wrap">';
    echo '<h1>'.esc_html(get_admin_page_title()).'</h1>';
    echo '<form action="options.php" method="post">';
        settings_fields('amitem_options');
        settings_fields('amitem');
        submit_button();
    echo '</form>';
    echo '</div>';
}

add_action('admin_menu', 'amitem_add_menu');