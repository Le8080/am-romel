<?php
require_once('directory.php');
require_once('directorywebservice.php');

$function = '';
$params = '';

if(!empty($function)){
    $directory = new Directory();
    $directory->$function($params);
}

class DirectoryHandle extends DirectoryWebservice{
   function get_directories(){
       $param['type']='directory';
       
   }
   function get_directory(){

   }
}