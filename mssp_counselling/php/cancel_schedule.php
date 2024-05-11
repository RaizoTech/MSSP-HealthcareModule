<?php
require_once 'config.php';

$config = new config();
$connection = $config->getConnection();
// Check if POST data is received
if(isset($_POST['data'])) {
    // Parse the POST data
    parse_str($_POST['data'], $formData);

    // Extract individual values
    $sequenceId = $formData['sequence_id'];
    $status = 'Cancelled'; // Define the status variable

    // Create a prepared statement to prevent SQL injection
    $stmt = $connection->prepare("UPDATE `work_mssp_hw`.`counselling_availability_date` AS `wmssp_cad` SET  
            `wmssp_cad`.`sched_status`=? 
            WHERE `wmssp_cad`.`seq_id`=?");

    // Bind parameters to the prepared statement
    $stmt->bind_param("si", $status, $sequenceId); // Pass status variable by reference

    // Execute the statement
    if ($stmt->execute()) {
        // Return a success message
        echo 'Schedule Cancelled!';
    } else {
        // Return an error message
        echo 'Scheduled Not Set to Cancelled!';
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle the case where POST data is missing
    echo 'Missing POST data!';
}
?>
