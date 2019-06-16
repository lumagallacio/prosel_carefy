<?php

require_once dirname(__FILE__) . "/../config/Database.php";
require_once dirname(__FILE__) . "/../config/GeraLog.php";
require_once dirname(__FILE__) . "/../POJO/User.php";

class UsersDAO {

	private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function insert(User $user) {
        try {
            $query  = "INSERT INTO users (id, name, email, password) 
                VALUES (NULL, :name, :email, :password)";
 
            $stmt  = $this->db->getConection()->prepare($query);
            $stmt->bindValue(":name", $user->getName());
            $stmt->bindValue(":email", $user->getEmail());
            $stmt->bindValue(":password", $user->getPassword());
            $stmt->execute();

        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            print $e->getMessage();
            GeraLog::getConection()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }
    public function select($id) {
        try {
            $query = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->getConection()->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

            return $stmt->fetch();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getConection()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }
    public function loginExist($email, $pass) {
        try {
            $query = "SELECT * FROM users WHERE email = :email AND password = :password";
            $stmt = $this->db->getConection()->prepare($query);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":password", $pass);
            $stmt->execute();
            if($stmt->fetch(PDO::FETCH_ASSOC) == true) 
	            return true;
	        return false;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
            GeraLog::getConection()->inserirLog("Erro: Código: " . $e->getCode() . " Mensagem: " . $e->getMessage());
        }
    }
    private function translateToObject($row) {
        $user = new User();
        $user->setId($row['id']);
        $user->setName($row['name']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);
        return $user;
    }
}

?>