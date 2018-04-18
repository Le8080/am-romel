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
    'AutoMeans Details',
     'amitem_metabox',
     'amitem',
     'normal',
     'core' 
    );
}
function amitem_get_object(){

    $postobj = new stdClass();
    $postobj->mobilenumber = "mobilenumber";
    $postobj->phonenumber = "phonenumber";
    $postobj->emailaddress = "emailaddress";
    $postobj->loccity = "loccity";
    $postobj->locprovince = "locprovince";
    $postobj->longitude = "longitude";
    $postobj->latitude = "latitude";
    $postobj->website = "website";
    $postobj->facebook = "facebook";
    $postobj->twitter = "twitter";
    $postobj->isverified = "isverified";
    $postobj->pricerange = "pricerange";
    return $postobj;
}
function amitem_create_metabox(){
    $metaboxes =array('amitem_details_metabox');
    foreach($metaboxes as $metabox){
        add_meta_box(
            $metabox, //unique id of metabox
            'Automeans Details', //title of metaboc
            $metabox,   // callback function
            'amitem', //post type.
            'normal',
            'core' 
        );
    }

}
function amitem_details_metabox($post){
    $postdata = get_post_meta($post->ID, '_amitem_details_meta_key', true);
    wp_nonce_field (basename(__FILE__), 'amitem_details_metabox_nonce');
    ?>
    <input type="checkbox" name="isverified" id="amitem_details_metabox" value="1"<?php checked(@$postdata['isverified'],'1');?>> <label>Is Verified  </label> 

    <div class="row">
        <p>Contact Details</p>
        <div><label>Mobile Number : &nbsp; </label></div><div><input name="mobilenumber" value="<?php echo @$postdata['mobilenumber']; ?>"></div>
        <div><label>Phone Number : &nbsp; </label></div><div><input name="phonenumber" value="<?php echo @$postdata['phonenumber']; ?>"></div>
        <div><label>Email address : &nbsp; </label></div><div><input name="emailaddress" value="<?php echo @$postdata['emailaddress']; ?>" type="email"></div>
    </div>
    <div class="row">
        <p>Location</p>
        <div><label>City : &nbsp; </label></div><div><input name="loccity" value="<?php echo @$postdata['loccity']; ?>"></div>
        <div><label>Province : &nbsp; </label></div><div><input name="locprovince" value="<?php echo @$postdata['locprovince']; ?>"></div>
        <div><label>Longitude : &nbsp; </label></div><div><input name="longitude" value="<?php echo @$postdata['longitude']; ?>"></div>
        <div><label>Latitude : &nbsp; </label></div><div><input name="latitude" value="<?php echo @$postdata['latitude']; ?>"></div>
     </div>
    <div class="row">
        <p>Social Links</p>
        <div><label>Website :</label></div><div><input name="website" value="<?php echo @$postdata['website']; ?>"></div>
        <div><label>Facebook : </label></div><div><input name="facebook" value="<?php echo @$postdata['facebook']; ?>"></div>
        <div><label>Twitter : </label></div><div><input name="twitter" value="<?php echo @$postdata['twitter']; ?>"></div>
    </div>
    <div class="row">
     <div><label>Price Range : </label></div><div><input name="pricerange" value="<?php echo @$postdata['pricerange']; ?>"></div>
    </div>
    <?php
}
function amitem_save_metabox()
{  
    global $post;
    $is_autosave = wp_is_post_autosave($post->ID);
    $is_revision = wp_is_post_revision($post->ID);
    $is_valid_none = false;
  
    if(isset($_POST['isverified'])){
        if(wp_verify_nonce ($POST['amitem_details_metabox_nonce'],basename(__FILE__))){
            $is_valid_none = true;
        }
    }
    
    if($is_autosave || $is_revision || $is_valid_none) return;
    $ampost = [];
    $obj = amitem_get_object();
    foreach($obj as $am){
        $ampost[$am]=$_POST[$am];
    }
    if(array_key_exists('isverified',$_POST)){
        update_post_meta($post->ID, '_amitem_details_meta_key', $ampost);
    }
}   
add_action('init', 'amitem_add_menu');
add_action( 'add_meta_boxes', 'amitem_create_metabox' );
add_action( 'save_post', 'amitem_save_metabox' );   


require_once plugin_dir_path( __FILE__ ).'/widgets/searchwidget.php';
require_once plugin_dir_path( __FILE__ ).'/widgets/listingwidget.php';
require_once plugin_dir_path( __FILE__ ).'/widgets/resultwidget.php';

function amitem_register_widget(){
    register_widget('Amitem_FilterList_Widget');
    register_widget('Amitem_Search_Widget');
    register_widget('Amitem_Result_Widget');
}
add_action('widgets_init', 'amitem_register_widget');
