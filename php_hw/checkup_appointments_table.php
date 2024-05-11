<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

// Fetch data from MySQL
$sql = "
    SELECT
        `wmssp_checkup`.`checkup_id`,
        `wmain_emp`.`first_name`,
        `wmain_emp`.`last_name`,
        `wmssp_checkup`.`checkup_date`,
        `wmssp_checkup`.`checkup_time`,
        `wmssp_checkup`.`checkup_type`,
        `wmssp_checkup`.`request_from`,
        `wmssp_checkup`.`status`
    FROM
        `work_mssp_hw`.`checkup_appointment` AS `wmssp_checkup`
    INNER JOIN
        `work_main_db`.`employees` AS `wmain_emp`
    ON
        `wmssp_checkup`.`employee_code` = `wmain_emp`.`code`
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