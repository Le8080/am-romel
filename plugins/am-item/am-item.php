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
    //register post
    register_post_type('amitem',
        array(
            'labels'      => array(
                'name'          => 'Automeans',
                'singular_name' => 'Automeans',
                'add_new' => 'Add New', 
                'add_new_item' =>'Add New Automeans Item',
                'edit_item' => 'Edit Automeans Item',
                'new_item' => 'Edit New Automeans Item',
                'view_item' => 'View Automeans Item',
                'search_items' => 'Search Automeans Item',
                'not_found' =>  'No Automeans Item Found',
                'not_found_in_trash' =>  'No Automeans Item Found in the trash'
            ),
            'public'      => true,
            'has_archive' => true,
            'menu_icon' => $icon_url,
            'hierarchical'  => 0,
            'can_export'    => 1,
            'supports' => array('title', 'editor', 'comments', 'excerpt', 'custom-fields', 'thumbnail')
        )
    );
    // Category tax.
    $cat_args = array(
        'labels' => array(
            'name' => __( 'Automeans Categories', 'amcateg' ),
            'singular_name' => __( 'Automeans Category', 'amcateg' ),
            'add_new_item' =>'Add New Automeans Category',
            'edit_item' => 'Edit Automeans Category',
            'new_item' => 'Edit New Automeans Category',
            'view_item' => 'View Automeans Category',
            'search_items' => 'Search Automeans Category',
            'not_found' =>  'No Automeans Category Found',
            'not_found_in_trash' =>  'No Automeans Category Found in the trash'
            ),
        'hierarchical' => true,
        'public' => true,
        'supports' => array('title', 'editor', 'custom-fields', 'thumbnail')
    );
    register_taxonomy('AutomeansCateg', 'amitem', $cat_args );
    // Category tax.
    $tag_args = array(
        'labels' => array(
            'name' => __( 'Automeans Tags', 'amtag' ),
            'singular_name' => __( 'Automeans tag', 'amtag' ),
            'add_new_item' =>'Add New Automeans Tag',
            'edit_item' => 'Edit Automeans Tag',
            'new_item' => 'Edit New Automeans Tag',
            'view_item' => 'View Automeans Tag',
            'search_items' => 'Search Automeans Tag',
            'not_found' =>  'No Automeans Tag Found',
            'not_found_in_trash' =>  'No Automeans Tag Found in the trash'
        ),
        'hierarchical' => true,
        'public' => true
    );
    register_taxonomy('Automeanstag', 'amitem', $tag_args );
}
function amitem_metabox_callback(){
    add_meta_box( 'amitem-info',
    'AutoMeans Listing',
     'amitem_metabox',
     'amitem',
     'normal',
     'core' 
    );
}
function amitem_metabox(){
    global $post;
    $custom = get_post_custom($post->ID);
    $location = isset($custom["location"][0])?$custom["location"][0]:'';
    $contactnum = isset($custom["contactnum"][0])?$custom["contactnum"][0]:'';
    $sitelink = isset($custom["sitelink"][0])?$custom["sitelink"][0]:'';
    $fblink = isset($custom["fblink"][0])?$custom["fblink"][0]:'';
    ?>
    <label>Location: </label><input name="location" value="<?php echo $location; ?>">

    <label>Contact Details: </label><input name="contactnum" value="<?php echo $contactnum; ?>">
    <label>Location: </label><input name="sitelink" value="<?php echo $sitelink; ?>">
    <label>Location: </label><input name="fblink" value="<?php echo $fblink; ?>">
    <?php

}
function prefix_teammembers_save_post()
{
    if(empty($_POST)) return; //why is prefix_teammembers_save_post triggered by add new? 
    global $post;
    update_post_meta($post->ID, "function", $_POST["function"]);
}   


function amitem_add_menu_prepare(){
    require_once plugin_dir_path( __FILE__ ).'/admin/manage/manageitem.php';
    $item_form = new manageitem($id);
    $item_form->item_form;

}
//display list of item
// function amitem_display_cms(){
//     //check if user is allowed access
//     if(!current_user_can('manage_options'))
//          wp_die('You do not have sufficient permissions to access this page.');;

//     //display output
//     echo '<div class="wrap">';
//     echo '<h1>'.esc_html(get_admin_page_title()).'</h1>';
//     echo '<a href="/wp-admin/admin.php?page=amitem-new" class="page-title-action">Add New</a>';
//     require_once plugin_dir_path( __FILE__ ).'/admin/manage/itemlist.php';
    
//     //initialize table
//     $amtb = new AM_item_table();
//     echo '<div class="wrap">'; 
//     $amtb->prepare_items(); 
//     $amtb->display(); 
//     echo '</div>'; 
//     echo '</div>';

// }
function sample_data($post) {
    // Add your meta data to the post with the ID $post->ID
    add_post_meta($post->ID, 'key', 'value');

    // and then copy&past the metabox content from the function post_custom_meta_box()
}
add_action('init', 'amitem_add_menu');
add_action( 'add_meta_boxes', 'amitem_metabox_callback' );
add_action( 'save_post_prefix-teammembers', 'prefix_teammembers_save_post' );   



