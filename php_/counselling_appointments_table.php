<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

// Fetch data from MySQL
$sql = "
SELECT 
    employees.`first_name`,
    employees.`last_name`,
    counselling_service.`service_name`,
    counselling_appointment.`appointment_date`,
    counselling_appointment.`appointment_time`
FROM 
    counselling_appointment
LEFT JOIN 
    employees ON counselling_appointment.`employee_id` = employees.`employee_id`
LEFT JOIN 
    counselling_service ON counselling_appointment.`service_id` = counselling_service.`service_id`
";
$result = $connection->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close connection
$connection->close();

// Send JSON response
echo json_encode(array("data" => $data));
?>