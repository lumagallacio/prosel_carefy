<?php
  
class GeraLog{
     
    public static $instance;    
     
    private function __construct() {
        //
    }
     
    public static function getInstance(){
        if (!isset(self::$instance))
        self::$instance = new GeraLog();        
         
        return self::$instance;
    }
     
    public function inserirLog($msg){
        $msg = "\r\n\r\n".$msg."\r\n\r\n Ocorrido em: ".date("d-m-Y, H:i:s")."\r\n -----------------------------------------------------------------------------------";
        $fp = fopen(dirname(__FILE__)."/error_log_".date("d-m-Y").".txt",'a');
        fwrite($fp,$msg);
        fclose($fp);
    }
     
}
?>