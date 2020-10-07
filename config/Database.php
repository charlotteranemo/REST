<?php

class Database {
    //Databasinställningar
    private $host = "charlotteranemo.se.mysql";
    private $db_name = "charlotteranemo_secourses";
    private $username = "charlotteranemo_secourses";
    private $password = "kaffekopp123";
    public $conn;

    public function connect() {
        $this->conn = null;
  
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception){
            echo "Error when trying to connect to DB: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}



?>