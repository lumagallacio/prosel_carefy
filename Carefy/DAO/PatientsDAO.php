<?php
 
require_once dirname(__FILE__) . "/../config/Database.php";
require_once dirname(__FILE__) . "/../config/GeraLog.php";
require_once dirname(__FILE__) . "/../POJO/Patient.php";


class PatientsDAO {
 
    private $db;
    
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
 
    public function insert(Patient $patient) {
        try {
            $query  = "INSERT INTO patients (id, name, hospital, user_id, enabled) 
                VALUES (NULL, :name, :hospital, :user_id, :enabled)";
 
            $stmt  = $this->db->getConection()->prepare($query);
            $stmt->bindValue(":name", $patient->getName());
            $stmt->bindValue(":hospital", $patient->getHospital());
            $stmt->bindValue(":user_id", $patient->getUserId());
            $stmt->bindValue(":enabled", $patient->getEnabled());
            $stmt->execute();
        } catch (Exception $e) {
            GeraLog::getConection()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $query = "UPDATE patients SET enabled = 2 WHERE id = :id";
            $stmt = $this->db->getConection()->prepare($query);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        } catch (Exception $e) {
            GeraLog::getConection()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }
 
    public function selectAll() {
        try {
            $sql = "SELECT * FROM patients";
            $stmt = $this->db->getConection()->prepare($sql);
            $stmt->execute();
            $result = array();
            foreach($stmt->fetchAll() as $k=>$v) { 
                $result[] = $this->translateToObject($v);
            }
            return $result;
        } catch (Exception $e) {
            GeraLog::getConection()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }
    private function translateToObject($row) {
            $user = new Patient();
            $user->setId($row['id']);
            $user->setName($row['name']);
            $user->setHospital($row['hospital']);
            $user->setUserId($row['user_id']);
            $user->setEnabled($row['enabled']);
            return $user;
        }
     }
?>