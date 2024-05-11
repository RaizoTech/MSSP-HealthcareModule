<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$data = array();

$sql = "
SELECT 
    `weim_emp_req`.id,
    CONCAT(`wmain_emp`.`first_name`, ' ', LEFT(`wmain_emp`.`middle_name`, 1), '. ', `wmain_emp`.`last_name`) AS full_name,
    `wmain_job`.`name` AS position_,
    `wmain_dep`.`name` AS department,
    `weim_emp_req`.request_date
FROM 
    `work_eia_tss`.`employee_request_info` AS `weim_emp_req`
INNER JOIN
    `work_main_db`.`employees` AS `wmain_emp`
ON
    `weim_emp_req`.`employee_id` = `wmain_emp`.`code`
INNER JOIN
    `work_main_db`.`job_roles` AS `wmain_job`
ON
    `wmain_emp`.`job_role_id` = `wmain_job`.`id`
INNER JOIN
    `work_main_db`.`departments` AS `wmain_dep`
ON
    `wmain_job`.`department_id` = `wmain_dep`.`id`
WHERE
    `weim_emp_req`.`status` = 'Pending'
";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

echo json_encode(array("employee_request_data" => $data));

?>