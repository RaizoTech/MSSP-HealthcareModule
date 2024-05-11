<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

// Fetch data from MySQL
$sql = "
SELECT
    `wmain_emp`.`first_name`,
    `wmain_emp`.`last_name`,
    COUNT(`wmssp_checkup`.`employee_code`) AS total_checkups,
    COUNT(`wmssp_ca`.`employee_code`) AS total_counselling_app
FROM
    `work_main_db`.`employees` AS `wmain_emp`
LEFT JOIN
    `work_mssp_hw`.`checkup_appointment` AS `wmssp_checkup`
ON
    `wmain_emp`.`code` = `wmssp_checkup`.`employee_code`
LEFT JOIN
    `work_mssp_hw`.`counselling_appointment` AS `wmssp_ca`
ON
    `wmain_emp`.`code` = `wmssp_ca`.`employee_code`
GROUP BY
    `wmain_emp`.`code`;
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