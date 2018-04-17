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
         //   $result[$pm->post_id] =  get_post_meta($pm->post_id, '_amitem_details_meta_key', true);
          //  array_merge(array('meta_id'=>$pm->meta_id),$result[$pm->post_id]);
          //get_the_post_thumbnail( int|WP_Post $post = null, string|array $size = 'post-thumbnail', string|array $attr = '' )
          $result[$pm->post_id] = array_merge(get_post_meta($pm->post_id, '_amitem_details_meta_key', true),
                                    array('meta_id'=>$pm->meta_id,
                                        'meta_key'=>$pm->meta_key,
                                        'post_date'=>$pm->post_date,
                                        'post_content'=>$pm->post_content,
                                        'post_title'=>$pm->post_title,
                                        'post_name'=>$pm->post_name)
                                   );
        }
        return $result;
    }
    public function get_postmeta_data(){
        global $wpdb;
        $rs = $wpdb->get_results("
        SELECT pm.*,p.*
        FROM {$wpdb->posts} p join {$wpdb->postmeta} pm on pm.post_id=p.ID
        where p.post_type='amitem' and pm.meta_key ='_amitem_details_meta_key'");
        return $rs;
    }
    public function get_item_obj_pt($output = ''){

       return $obj = get_post_type_object( 'amitem' ,$output);
    }
    public function list_results_values( $key = '',$filter = NULL ) {
        global $wpdb;
        if(!$filter){
            $filter = array('post_title');
        }
        $i = 0;
        $fii = '';
        foreach($filter as $fi){
            if(!$i)
              $fii = " AND ".$fi." LIKE '%".$key."%'";
            else $fii .= " OR ".$fi." LIKE '%".$key."%'";
            $i++;

        }
        $rs = $wpdb->get_results("
            SELECT pm.*,p.*
            FROM {$wpdb->posts} p join {$wpdb->postmeta} pm on pm.post_id=p.ID
            where p.post_type='amitem' and pm.meta_key ='_amitem_details_meta_key' ".$fii);
        return $rs;

    }
    public function get_city(){

    }
    public function get_item($id){

    }
    public function search_item(){

    }

}