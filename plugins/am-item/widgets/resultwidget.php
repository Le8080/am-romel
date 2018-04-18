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
class Amitem_Result_Widget extends WP_Widget{

    //set up widget
    public function __construct(){

        $options = array(
            'classname' => 'amitem_result_widget',
            'description' => 'Automeans Details'
        );
        parent::__construct('amitem_result_widget', 'Automeans Details', $options);
    }

    //output widget content
    public function widget($args, $instance){
        extract($args);
        echo $before_Widget;
        
        require_once plugin_dir_path( __FILE__ ).'amitem_obj.php';
        $amitemobj = new amitem_obj();
        $datas = $amitemobj->get_values();
        ?>

        <?php
    }

    //output widget form fields
    public function form($instance){

    }

    //process widget options
    public function update($new_instance, $old_instace){

    }
    

}    
