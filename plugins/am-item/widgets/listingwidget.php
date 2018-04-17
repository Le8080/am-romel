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
class Amitem_FilterList_Widget extends WP_Widget{

    //set up widget
    public function __construct(){

        $options = array(
            'classname' => 'amitem_filterlist_widget',
            'description' => 'Automeans Filtered List'
        );
        parent::__construct('amitem_filterlist_widget', 'Filtered List', $options);
    }

    //output widget content
    public function widget($args, $instance){
        extract($args);
        echo $before_Widget;
        
        require_once plugin_dir_path( __FILE__ ).'amitem_obj.php';
        $amitemobj = new amitem_obj();
        $datas = $amitemobj->get_values();
        $results = $amitemobj->list_results_values($_GET['keywords']);
        foreach($results as $result){

        ?>
        <div>
            <div><?php echo get_the_post_thumbnail( $result->post_id,'post-thumbnail'); ?></div>
            <div>
            <h3><?php echo $result->post_title;?></h3>
            <p><?php echo $result->post_content;?></p>

            <span><?php echo $result->locprovince;?></span>
            </div>

        </div>
        <?php
        }
    }

    //output widget form fields
    public function form($instance){

    }

    //process widget options
    public function update($new_instance, $old_instace){

    }
    

}    
