<?php

class config {
    // Main MSSP Database
    private $host = "194.110.173.106";
    private $username = "workfoli";
    private $password = "nif0ZrDruBz)L9u0";
    private $database = "work_mssp_hw";
    private $conn;
    
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>