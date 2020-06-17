<?php
    class User{
        private $conn;

        public $id;
        public $username;
        public $password;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT id, username, password FROM users WHERE username = :username;";

            $stmt = $this->conn->prepare($query);

            $stmt->execute(["username" => $this->username]); 

            return $stmt;
        }

        public function create(){
            $query = "INSERT INTO users (username, password) VALUES (:username, :password)";

            $stmt = $this->conn->prepare($query);

            $this->username = htmlspecialchars(strip_tags($this->username));

            $this->password = htmlspecialchars(strip_tags($this->password));

            $insert_array = ["username" => $this->username,"password" => $this->password];

            $stmt->execute($insert_array);

            return $stmt;
        }
    }
?>