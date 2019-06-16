<?php

/*class Conexao {
 
    public static $instance;
 
    private function __construct() {
        //
    }
 
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=192.185.209.187; dbname=globa813_prosel_carefy', 'globa813_desafio', 'carefy123',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
 
        return self::$instance;
    }
 
}*/
 
	class Database 
	{
	    private $host = "192.185.209.187";
	    private $username = "globa813_desafio";
	    private $password = "carefy123";
	    private $database = "globa813_prosel_carefy";
	    private $conexao = null; 

	    public function __construct()
	    {          
	        $this->conect();
	    }

	    public function getConection()
	    {
	        return $this->conexao;
	    }
   
	    private function conect() 
	    {
	    	try{
		    	//$this->conexao = new mysqli( $this->host,  $this->username, $this->password);
			    $this->conexao = new PDO("mysql:host=192.185.209.187;dbname=globa813_prosel_carefy",$this->username, $this->password);
			    // set the PDO error mode to exception
			    $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    }catch(PDOException $e)
		    {
		    echo "Connection failed: " . $e->getMessage();
		    }
		    //echo "Connected successfully"; 

	    }
	}

?>