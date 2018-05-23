<?php
<<<<<<< HEAD
require_once('directorywebservice.php');
Class DirectoryHandle extends DirectoryWebservice{
    private $directory;

=======

require_once('directorywebservice.php');
require_once('db.php');
$DB =  DBobject::DBInstance();
global $DB;
class DirectoryHandle extends DirectoryWebservice{
    private $directory;

	/**
	 * Construct directory handle
	 */
>>>>>>> bc309990d21f9bdb332340985e028fb8f99b4be0
    public function __construct(){
        require_once('directory.php');
        $this->directory = new Directories();
    }
<<<<<<< HEAD
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
=======
	
	/**
	 * Undocumented function
	 *
	 * @param array $params
	 * @return void
	 */
	function get_directories($params){
		//check if param exists
		if(!isset($params['type']) && empty($params['type'] && !is_string($params['type'])))
			throw new InvalidArgumentException('Param type is invalid or empty');
        //get directories
        $directories = $this->directory->get_directories($params['type']);
		return self::return_response($directories);
    }

    function get_directory($params){

		$type = $params['type'];
		$name = $params['name'];
		$value = $params['value'];

		//check if param exists
		if(!isset($type) && empty($type && !is_string($type)))
			throw new InvalidArgumentException('Param type is invalid or empty');
		if(!isset($name) && empty($name && !is_string($name)))
			throw new InvalidArgumentException('Param key is invalid or empty');
		if(!isset($value) && empty($value && !is_string($value)))
			throw new InvalidArgumentException('Param value is invalid or empty');

		//get a directory details
		$directory = $this->directory->get_directory($type,array($name=>$value));

		return self::return_response($directory);
	}
	function get_categories(){
		$category = $this->directory->get_categories();
		$category = json_encode((array)$category);

		return self::return_response($category);
	}
    private function encodeHtml($responseData) {
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;		
	}
	
	private function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	private function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><mobile></mobile>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}
	private function return_response($data){
		$contenttype = 'application/json';
		if(empty($data)){
            $statuscode = 404;
            $data = array('error'=>$params['type'].' has no records');
        }else{
            $statuscode = 200;
		}
		$this->set_headers($contenttype, $statuscode);
		if(strpos($contenttype,'application/json') !== false){
			$response = $this->encodeJson($data);
			echo $response;
		} else if(strpos($contenttype,'text/html') !== false){
			$response = $this->encodeHtml($data);
			echo $response;
		} else if(strpos($contenttype,'application/xml') !== false){
			$response = $this->encodeXml($data);
			echo $response;
		}
	}
	
}


$function = $_GET['function'];
$params = (isset($_GET['params']) ? $_GET['params'] : '' );

if(!empty($function)){
	$directory = new DirectoryHandle();
	if(!empty($params))
		$directory->$function($params);
	else $directory->$function();
>>>>>>> bc309990d21f9bdb332340985e028fb8f99b4be0
}