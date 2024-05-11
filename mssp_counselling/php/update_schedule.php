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
    $newDate = $formData['edit_dateset'];
    $newTimeAM = $formData['edit_timeAM'];
    $newTimePM = $formData['edit_timePM'];
    $newSlot = $formData['edit_slot'];

    // Create a prepared statement to prevent SQL injection
    $stmt = $connection->prepare("UPDATE `work_mssp_hw`.`counselling_availability_date` AS `wmssp_cad` SET 
            `wmssp_cad`.`avail_date`=?, 
            `wmssp_cad`.`time_am`=?, 
            `wmssp_cad`.`time_pm`=?, 
            `wmssp_cad`.`slot`=? 
            WHERE `wmssp_cad`.`seq_id`=?");

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssssi", $newDate, $newTimeAM, $newTimePM, $newSlot, $sequenceId);

    // Execute the statement
    if ($stmt->execute()) {
        // Return a success message
        echo 'Schedule Updated!';
    } else {
        // Return an error message
        echo 'Failed to update schedule.';
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle the case where POST data is missing
    echo 'Missing POST data!';
}
?>