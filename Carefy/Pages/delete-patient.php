<?php

require_once dirname(__FILE__) . "/../DAO/PatientsDAO.php";
require_once dirname(__FILE__) . "/../config/Database.php";

    if (!empty($_POST)) {
    	$db = new Database();
    	$patientsDao = new PatientsDAO($db);
     	$patientsDao->delete($_POST["id"]);
    }

?>