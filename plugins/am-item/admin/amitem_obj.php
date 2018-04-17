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

class amitem_obj{
    var $id;
    public function __construct($id = NULL){
        if($id)
            $this->id = $id;

    }
    public function get_values(){
       global $wpdb;
       //$results =  $wpdb->get_results("SELECT DISTINCT {$wpdb->prefix}posts FROM wp_posts");
        $pms = $this->get_postmeta_data();
        $result = array();
       // var_dump(get_post_meta(120, '_amitem_details_meta_key', true));
        foreach ($pms as $p =>$pm){
            $result[$pm->post_id] =  get_post_meta($pm->post_id, '_amitem_details_meta_key', true);
        }
        return $result;
    }
    public function get_postmeta_data(){
        global $wpdb;
        $rs = $wpdb->get_results("
        SELECT pm.*
        FROM {$wpdb->posts} p inner join {$wpdb->postmeta} pm on pm.post_id=p.ID
        where p.post_type='amitem' and pm.meta_key ='_amitem_details_meta_key'");
        return $rs;
    }
    public function get_item_obj_pt($output = ''){

       return $obj = get_post_type_object( 'amitem' ,$output);
    }
    public function list_meta_values( $key = '' ) {
        $val = $this->get_values();

    }
    public function get_city(){

    }
    public function get_item($id){

    }
    public function search_item(){

    }

}