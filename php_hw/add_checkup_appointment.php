<?php

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Check if all required fields are set
    if (isset($_POST['check_up_type'], $_POST['date_checkup'], $_POST['time_checkup'], $_POST['emp_code'], $_POST['request_from'])) {
        // Assign values to variables
        $checkup_type = $_POST['check_up_type'];
        $employee_code = $_POST['emp_code'];
        $date_checkup = $_POST['date_checkup'];
        $time_checkup = $_POST['time_checkup'];
        $request_from = $_POST['request_from'];

        // Prepare the SQL statement
        $sql = "
            INSERT INTO `work_mssp_hw`.`checkup_appointment` (
                `employee_code`,
                `checkup_date`,
                `checkup_time`,
                `checkup_type`,
                `request_from`
            ) VALUES (
                '$employee_code',
                '$date_checkup',
                '$time_checkup',
                '$checkup_type',
                '$request_from'
            )
        ";

        // Execute the SQL statement
        if ($connection->query($sql) === TRUE) {
            echo 'success';
        } else {
            echo 'server side error';
        }
    } else {
        echo 'Please fill all forms';
    }
}

?>