<?php
// Assuming you have already established a MySQLi database connection
require_once 'config.php'; // Include the database configuration file

// Get the MySQLi connection object
$config = new config();
$conn = $config->getConnection(); 

// Get the employee ID from the AJAX request
$seq_id = isset($_POST['sequence_id']) ? $_POST['sequence_id'] : null;

if ($seq_id !== null) {
    // Prepare the SQL query with a placeholder
    $query = "SELECT * FROM `work_mssp_hw`.`counselling_availability_date` AS `wmssp_cad` WHERE `wmssp_cad`.`seq_id` = ?";
    
    // Prepare and bind the statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $seq_id); // 'i' indicates integer type
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch data and store it in an array
    $schedule = $result->fetch_all(MYSQLI_ASSOC);

    // Check if there are no activity logs
    if (empty($schedule)) {
        // Return custom message if no activity logs found
        $message = "No activity logs found for this employee!";
        echo json_encode(array('message' => $message));
    } else {
        // Return JSON response if activity logs found
        header('Content-Type: application/json');
        echo json_encode($schedule);
    }
} else {
    // Handle invalid or missing employee ID
    echo json_encode(array('error' => 'Invalid or missing employee ID'));
}

// Close the database connection
$conn->close();
?>
