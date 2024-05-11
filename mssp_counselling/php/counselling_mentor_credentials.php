<?php

require_once 'config.php';

class CounsellingMentorCredentials {

    private $db;

    public function __construct(){
        $this->db = new Config(); // Assuming Config provides database connection
    }

    public function ConsellingMentorInformation($id){
        $connection = $this->db->getConnection(); // Assuming getConnection() method returns the database connection

        // Prepare SQL query with a WHERE clause to select a specific employee by their ID
        $sql = "SELECT * FROM counselling_mentors WHERE cm_id = ?";
    
        // Prepare and execute the SQL query
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
    
        // Get the result
        $result = $stmt->get_result();
    
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
