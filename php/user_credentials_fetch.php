<?php

require_once 'config.php';

class UserCredentials {

    private $db;

    public function __construct(){
        $this->db = new Config(); // Assuming Config provides database connection
    }

    public function EmployeeInformation($id){
        $connection = $this->db->getConnection(); // Assuming getConnection() method returns the database connection

        // Prepare SQL query with a WHERE clause to select a specific employee by their ID
        $sql = "SELECT * FROM `work_main_db`.`employees` AS eim WHERE eim.`code`='$id';";
        $result = $connection->query($sql);
    
        // Get the result
        // Check if any data is retrieved
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $userData = $row;
            return $userData;
        } else {
            return null;
        }
    }
}
?>
