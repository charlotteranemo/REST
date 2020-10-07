<?php

class Courses {
    
    private $conn;
    private $table = "courses";
  
    //Properties
    public $id;
    public $name;
    public $progression;
    public $syllabus;
    public $code;
  
    //Constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function create() {
        
        //Rensar bort html-taggar och tecken
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->progression = htmlspecialchars(strip_tags($this->progression));
        $this->syllabus = htmlspecialchars(strip_tags($this->syllabus));
        $this->code = htmlspecialchars(strip_tags($this->code));

        //SQL insert
        $query = "INSERT INTO $this->table (name, progression, syllabus, code) VALUES ('$this->name', '$this->progression', '$this->syllabus', '$this->code')";

        $res = $this->conn->prepare($query);
            
        if($res->execute()) {
            return true;
        } else {
            return false;
        }
        
    }

    function delete($id) {
        $query = "DELETE from $this->table WHERE id = $id";

        $res = $this->conn->prepare($query);
            
        //Returnerar true om den lyckats ta bort post med id = id
        if($res->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function update($id) {

        //Rensar bort html-taggar och tecken
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->progression = htmlspecialchars(strip_tags($this->progression));
        $this->syllabus = htmlspecialchars(strip_tags($this->syllabus));
        $this->code = htmlspecialchars(strip_tags($this->code));

        //SQL Update med värdena som är inmatade
        $query = "UPDATE $this->table SET name = '$this->name', progression = '$this->progression', syllabus = '$this->syllabus', code = '$this->code' WHERE id = '$id'";

        $res = $this->conn->prepare($query);
            
        if($res->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function read() {
        $courseArr = array();

        //Select alla kurser för utläsning
        $query = "SELECT * FROM $this->table";
        $res = $this->conn->prepare($query);
        
        $res->execute();

        //Lägger till kurs för kurs i arrayen courseArr
        foreach($res as $row) {
            $aCourse=array(
                "id" => $row['id'],
                "name" => $row['name'],
                "progression" => $row['progression'],
                "syllabus" => $row['syllabus'],
                "code" => $row['code']
            );
      
            array_push($courseArr, $aCourse);
        }
  
        return $courseArr;
    }

    //Läser ut en post i listan
    function readOne($id) {
        $query = "SELECT * FROM $this->table WHERE id = $id";
        $res = $this->conn->prepare($query);
        
        $res->execute();

        foreach($res as $row) {
            $aCourse=array(
                "id" => $row['id'],
                "name" => $row['name'],
                "progression" => $row['progression'],
                "syllabus" => $row['syllabus'],
                "code" => $row['code']
            );
        }
  
        //Returnerar kursen som lästs ut
        return $aCourse;
    }
}




?>