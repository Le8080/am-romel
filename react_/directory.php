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
<<<<<<< HEAD
    public function get_all_namedirectory(){
        
    }
}

class DBobject{
    private static $_instance;
    private $_connect;
    private $_host;
    private $_password;
    private $_username;
    private $_dbname;
    
    /**
     * Get Database instance
     *
     * @return instance
     */
    public static function DBInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

    private function __clone() {
        //Let's prevent duplication of connection
    }
    
    /**
     * Constructor
     * This is where the connection of the database takes place
     * and declaration of some of the variables
     * 
     * TODO : fetching database credentials
     */
    private function __construct(){
        $this->_host = 'localhost';
        $this->_password = 'password';
        $this->_username = 'root';
        $this->_dbname = 'searchandsort';
        $this->_password = '';
       
        $connect = $this->__connect();
        if(!$connect){
            throw new Exception('Unable to connect to Mysql'.PHP_EOL.' Debugging no.'.mysqli_connect_errno().PHP_EOL
            .' Debugging Error Message '.mysqli_connect_error);
        }
        //catch error connection;
        try{
            $this->__connect();
        }catch(MongoConnectionException  $error){
            $connect = trigger_error('Caught Exception : '.$error->message);
        }finally{
            return $connect;
        }
        return $connect;
    }

    /**
     * Close the database connection
     * @return true
     */
    public function __destruct() {
        $this->_connect->close();
        return true;
    }

=======
>>>>>>> 7e368943eb420b8d01bd5be90e89645ccac06316
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
<<<<<<< HEAD
    private function __connect(){
        return $this->_connect = new mysqli($this->_host,$this->_username,$this->_password,$this->_dbname);
    }

    /**
     * gets the connection
     *
     * @return void
     */
    public function getDBConnect(){
        return $this->__connect();
    }
    
    /**
     * Get single record of a given table and parameters
     *
     * @param string $table
     * @param array $params
     * @return object
     */
    public function get_record($table = '', $params = array()){
        if($table AND !empty($params)){

            $whereparam = '';
            //setup query params
            foreach($params as $p=>$param){
                if(!empty($whereparam))
                    $whereparam .=" AND $p = $param ";
                else $whereparam .=" $p = $param ";
            }
            //prepare sql
            $sql = "SELECT * FROM $table where $whereparam LIMIT 1";
            //get data
            $record =  $this->_connect->query($sql);
            if(!empty($record)){
                //fetch data as object
                return mysqli_fetch_object($record);
            }
        }
        return false;
    }
    
    /**
     * Get records of a given table and parameters
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function get_records($sql = '', $params = array()){
        if($sql AND !empty($params)){
            preg_match_all('(:|\?)',$sql,$matches);
            $totalmatches = count($matches[0]);
            $totalcondition = count($params);
            if(in_array('?',$matches[0])){
                //check if the query condition consist the same count on provided parameters for our Where Clause
                if($totalcondition < $totalmatches){
                    return trigger_error('Caught Exception : Expecting '.$totalmatches.' but recieves '.$totalcondition);
                }
            }else if(in_array(':',$matches[0])){
                foreach($params as $p=>$param){
                    $patterns[$p] = "/:$p/";
                    $replace[$p] = $param;
                }
                $sql = preg_replace($patterns,$replace,$sql);
            }
            //get data
            $record =  $this->_connect->query($sql);
            if(!empty($record)){
            //fetch data as object
                return mysqli_fetch_assoc($record);
            }
        }

        return false;        
=======
    public function get_all_namedirectory($param = array(),$orderfield = '',$ordertype = '',$page = 0, $limit = 0){
        global $DB;
        if($orderfield)
            $orderfield = 'ORDER by '.$orderfield;
        if($ordertype)
            $orderfield .=' '.$ordertype;
       return $records = $DB->get_records('SELECT * FROM '.$this->type.' '.E, $param);
>>>>>>> 7e368943eb420b8d01bd5be90e89645ccac06316
    }
}


function di($value){
    print_r('<pre>');
    print_r($value);
    print_r('</pre>');
}
$DB =  DBobject::DBInstance();
GLOBAL $DB;

?>
