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
class Amitem_Search_Widget extends WP_Widget{

    //set up widget
    public function __construct(){

        $options = array(
            'classname' => 'amitem_search_widget',
            'description' => 'Search Automeans Item'
        );
        parent::__construct('amitem_search_widget', 'Search Automeans', $options);
    }

    //output widget content
    public function widget($args, $instance){
        extract($args);
        echo $before_Widget;
        
        require_once plugin_dir_path( __FILE__ ).'amitem_obj.php';
        $amitemobj = new amitem_obj();
        $datas = $amitemobj->get_values();
        ?>
        <form role="search" method="get" id="amitem_search" action="http://lkd/result-page/">
        <input type="text" name="keywords">
        <!-- <select name="location">
            
        </select> -->
        <button>search</button>
        </form>
        <?php
    }

    //output widget form fields
    public function form($instance){

    }

    //process widget options
    public function update($new_instance, $old_instace){

    }
    

}    


// $get_query_var = apply_filters( 'get_search_query', $get_query_var ); 

// if ( !empty( $get_query_var ) ) { 

// // everything has led up to this point... 

// } 

//add_action('init', 'search_query');

// define the get_search_query callback 

function my_remove_actions() {
    
echo '';
    
    }
if(isset($_GET['kw'])){
    add_action( 'init', 'my_remove_actions' );
}
//add_action('wp','maybe_direct_html_output');

function maybe_direct_html_output() { 
    if (is_search()) {
        // global $post;
        // $htmlfilepath = get_post_meta($post->ID,'htmlfilepath',true);
        // if ( ($htmlfilepath) && (file_exists($htmlfilepath)) ) {
        //     echo file_get_contents($htmlfilepath); exit;
        // }
        // $htmlurl = get_post_meta($post->ID,'htmlurl',true);
        // if ($htmlurl) {
        //     $html = wp_remote_get($html);
        //     if (!is_wp_error($html)) {echo $html['body']; exit;}
        // }
        echo 'helo';
        $htmlfilepath = get_post_meta($post->ID,'htmlfilepath',true);
    }
}