<?php
 
class Patient {
 
    private $id;
    private $name;
    private $hospital;
    private $user_id;
    private $enabled;
 
    public function getId() {
        return $this->id;
    }
 
    public function setId($id) {
        $this->id = $id;
    }
 
    public function getName() {
        return $this->name;
    }
 
    public function setName($name) {
        $this->name = $name;
    }
 
    public function getHospital() {
        return $this->hospital;
    }
 
    public function setHospital($hospital) {
        $this->hospital = $hospital;
    }
 
    public function getUserId() {
        return $this->user_id;
    }
 
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }    
     
    public function getEnabled() {
        return $this->enabled;
    }
 
    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }
 
}
 
?>