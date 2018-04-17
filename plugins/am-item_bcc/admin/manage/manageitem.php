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
//managing item object
class manageitem {

    var $id;
    var $itemobj;
    
    //construct 
    public function __construct($id = NULL){
        $this->id = $id;
        //if has id prepare the item object

        if($id){
            $this->prepare_item;
        }
    }

    private function prepare_item(){
        
    }
    
    public function item_form(){
        $id = $this->id;
        $default_fields = $this->get_default_fields();
        $fields_to_create = $default_fields;
        foreach ( $fields_to_create as &$f) {
            $field = new WPBDP_FormField( $f );
            $field->save();
        }
    }
    public function default_fields(){
        $default_fields = array(
            'Location' => array( 'label' =>'Location', 'field_type' => 'textfield', 'association' => 'meta', 'weight' => 1,
            'display_flags' => array( 'excerpt', 'listing', 'search' ), 'tag' => 'location' )
        );

        if ( $id ) {
            if ( isset( $default_fields[ $id ] ) )
                return $default_fields[ $id ];
            else
                return null;
        }

        return $default_fields;
    }

}