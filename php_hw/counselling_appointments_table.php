<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

// Fetch data from MySQL
$sql = "
    SELECT
    `wmain_emp`.`first_name`, 
    `wmain_emp`.`last_name`,
    `wmssp_cs`.`service_name`,
    `wmssp_ca`.`appointment_date`,
    TIME_FORMAT(`wmssp_ca`.`appointment_time`, '%h:%i %p') AS `appointment_time`
FROM
    `work_mssp_hw`.`counselling_appointment` AS `wmssp_ca`
INNER JOIN
    `work_main_db`.`employees` AS `wmain_emp`
ON
    `wmssp_ca`.`employee_code` = `wmain_emp`.`code`
INNER JOIN
    `work_mssp_hw`.`counselling_service` AS `wmssp_cs`
ON
    `wmssp_ca`.`service_id` = `wmssp_cs`.`service_id`;
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