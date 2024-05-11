<?php
// Start the session
require_once 'config.php';
session_start();

$config = new config();
$conn = $config->getConnection();

// Retrieve data from POST request
$data = $_POST['data'] ?? array(); // Access the data array

if (!empty($data)) {
    // Initialize arrays to hold the values
    $dateAvail = $timeAM = $timePM = $slot = array();

    // Extract individual arrays from the nested data array
    foreach ($data as $item) {
        if ($item['name'] === 'dateset[]') {
            $dateAvail[] = $item['value'];
        } elseif ($item['name'] === 'timeAM[]') {
            $timeAM[] = $item['value'];
        } elseif ($item['name'] === 'timePM[]') {
            $timePM[] = $item['value'];
        } elseif ($item['name'] === 'slot[]') {
            $slot[] = $item['value'];
        }
    }

    // Get cm_id and service_id from session
    $cm_id = $_SESSION['cm_id']; // Replace 'cm_id' with your session variable name
    $service_id = $_SESSION['service_id']; // Replace 'service_id' with your session variable name

    // Check if there are any records to insert
    if (!empty($dateAvail) && !empty($timeAM) && !empty($timePM) && !empty($slot)) {
        // Prepare the SQL statement
        $sql = "INSERT INTO `work_mssp_hw`.`counselling_availability_date` (cm_id, service_id, avail_date, time_am, time_pm, sched_status, slot) VALUES ";

        // Create an array to hold the values to be inserted
        $values = array();

        // Loop through each set of values and construct the SQL query
        foreach ($dateAvail as $key => $date) {
            $avail_date = $date;
            $time_am = $timeAM[$key];
            $time_pm = $timePM[$key];
            $sched_status = 'Stable';
            $slot_value = $slot[$key];
            
            // Add values to the array
            $values[] = "('$cm_id', '$service_id', '$avail_date', '$time_am', '$time_pm', '$sched_status', '$slot_value')";
        }

        // Combine the values into a single string separated by commas
        $sql .= implode(",", $values);

        // Execute the SQL query
        if ($conn->query($sql) === TRUE) {
            echo "New schedules added to your counselling service this week !";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "No data to insert.";
    }
} else {
    echo "No data received.";
}

// Close connection
$conn->close();
?>
