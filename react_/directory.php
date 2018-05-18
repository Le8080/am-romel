<?php

class NameDirectory {

    var $type;
    /**
     * Directory CLass constructor
     *
     * @param string $type 
     * @param object $DBconnections 
     */
    public function __construct($type){
        $this->type = $type;
    }
    /**
     * get all the name directory
     *
     * @param array $param
     * @param string $orderfield
     * @param string $ordertype DESC ASC
     * @param integer $page
     * @param integer $limit
     * @return void
     */
    public function get_all_namedirectory($param = array(),$orderfield = '',$ordertype = '',$page = 0, $limit = 0){
        global $DB;
        if($orderfield)
            $orderfield = 'ORDER by '.$orderfield;
        if($ordertype)
            $orderfield .=' '.$ordertype;
       return $records = $DB->get_records('SELECT * FROM '.$this->type.' '.E, $param);
    }
}


function di($value){
    print_r('<pre>');
    print_r($value);
    print_r('</pre>');
}
?>
