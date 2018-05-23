<?php
require_once('db.php');

$DB =  DBobject::DBInstance();
GLOBAL $DB;
class Directories {
    var $categories;
    var $type;
    /**
     * Directory CLass constructor
     *
     * @param string $type 
     * @param object $DBconnections 
     */
    public function __construct(){
        $this->categories = $this->set_categories();
    }

    public function get_directories($type){
        global $DB;
        $records = $DB->get_records('SELECT * from ? ',array($type));
        return $records;
    }

    public function get_directory($param){
        
    }
    public function set_categories(){
        $categories = new stdClass();
        $categories->business = 'Business';
        $categories->hotel = 'Hotel';
        $categories->restaurant = 'Restaurant';
        $categories->school = 'School';
    }
    public function get_categories(){

    }

    public function get_category(){

    }

    public function get_directory_details(){

    }
}


function di($value){
    print_r('<pre>');
    print_r($value);
    print_r('</pre>');
}


?>
