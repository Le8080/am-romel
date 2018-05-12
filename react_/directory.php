<?php

class directory {

    var $type;
    /**
     * Directory CLass constructor
     *
     * @param string $type 
     * @param object $DBconnections 
     */
    public function __construct($type,$DBconnections){
        $this->type = $type;
    }
    private function DBconnect(){

    }
    public function get_all_directory(){

    }
}
?>