<?php
// Set the timezone to Philippines (Manila)
date_default_timezone_set('Asia/Manila');

// MySQL connection
require_once 'config.php';
session_start();

$config = new config();
$conn = $config->getConnection();

$id = $_SESSION['cm_id'];
$service_id = $_SESSION['service_id'];

// Query to count the number of schedules for the current week
$sql = "
    SELECT 
        COUNT(*) AS num_schedules 
    FROM 
        `work_mssp_hw`.`counselling_availability_date` AS `wmssp_cad`
    WHERE WEEK(`avail_date`) = WEEK(CURRENT_DATE()) AND `wmssp_cad`.`cm_id`='$id' AND `wmssp_cad`.`service_id`='$service_id' AND `wmssp_cad`.`sched_status`='Stable'";

// Execute the query
$result = $conn->query($sql);

if ($result !== false && $result->num_rows > 0) {
    // Fetch the count of schedules
    $row = $result->fetch_assoc();
    $numSchedules = $row['num_schedules'];

    // Calculate the number of available slots
    $availableSlots = 4 - $numSchedules;

    // Return the number of available slots
    echo $availableSlots;
} else {
    // Handle the case where the query fails
    echo 'error';
}

// Close connection
$conn->close();
?>