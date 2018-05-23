<?php
require_once('directorywebservice.php');
Class DirectoryHandle extends DirectoryWebservice{
    private $directory;

    public function __construct(){
        require_once('directory.php');
        $this->directory = new Directories();
    }
   function get_directories($params){
       //verify params
       if(!isset($param['params']['type'])){
           //throw error;
       }
       //get directories
       $data = $this->directory->get_directories($param['params']['type']);
       if(empty($data)) {
            $statusCode = 404;
        $rawData = array('error' => 'No Directories Found');
        } else {
            $statusCode = 200;
        }

        $contentype = $_SERVER['HTTP_ACCEPT'];
        $this ->set_headers($contentype, $statusCode);
                
        if(strpos($requestContentType,'application/json') !== false){
            $response = $this->encodeJson($rawData);
            echo $response;
        } else if(strpos($requestContentType,'text/html') !== false){
            $response = $this->encodeHtml($rawData);
            echo $response;
        } else if(strpos($requestContentType,'application/xml') !== false){
            $response = $this->encodeXml($rawData);
            echo $response;
        }
   }
   function get_directory($params){

   }
    private function encodeJson($responseData) {
        $jsonResponse = json_encode($responseData);
        return $jsonResponse;		
    }
    private function encodeXml($responseData) {
		$xml = new SimpleXMLElement('<?xml version="1.0"?><mobile></mobile>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
    }
    private function encodeHtml($responseData) {
        $htmlResponse = "<table border='1'>";
        foreach($responseData as $key=>$value) {
                $htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
        }
        $htmlResponse .= "</table>";
        return $htmlResponse;		
    }
}

$function = $_GET['function'];
$params = $_GET['params'];

if(!empty($function)){
    $directory = new DirectoryWebservice();
    $directory = new DirectoryHandle();
   // $directory->$function($params);
}