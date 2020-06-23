<?php
    class Locatii{
        private $conn;

        public $locatie;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT DISTINCT Locationdesc FROM informations order by Locationdesc ASC";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();   
            
            return $stmt;
        }
    }
?>