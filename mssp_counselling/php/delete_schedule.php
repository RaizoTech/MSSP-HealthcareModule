<?php
// delete_schedule.php

require_once 'config.php'; // Include your database configuration file
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['seq_id'])) {
    $config = new config();
    $connection = $config->getConnection();

    // Get the sequence ID from the POST data
    $seq_id = $_POST['seq_id'];

    // Prepare a SQL statement to delete the schedule with the provided sequence ID
    $sql = "DELETE FROM counselling_availability_date WHERE seq_id = ?";
    
    // Prepare the SQL statement
    $stmt = $connection->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("i", $seq_id);
    
    // Execute the statement
    if ($stmt->execute()) {
        // If deletion is successful, return success response
        echo 'Success';
        exit;
    } else {
        // If deletion fails, return error response
        echo 'Error';
        exit;
    }
} else {
    // If the request method is not POST or seq_id is not set, return error response
    echo 'Error!';
    exit;
}
?>