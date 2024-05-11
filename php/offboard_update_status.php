<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$offboard_id = $_POST['offboard_id'];

$data = array();

// GET POST VAR METHOD
// SQL QUERY
$sql = "
	SELECT
	`wtoesf_off`.`id`,
    	`wmain_emp`.`code`,
    	CONCAT(
		`wmain_emp`.`first_name`,
		IF(`wmain_emp`.`middle_name` IS NOT NULL, CONCAT(' ', SUBSTRING(`wmain_emp`.`middle_name`, 1, 1), '.'), ''),
		IF(`wmain_emp`.`middle_name` IS NOT NULL, ' ', ''),
		' ',
		`wmain_emp`.`last_name`
	) AS `fullname`,
    	`wmain_dep`.`name` AS department,
    	`wmain_job`.`name` AS position,
    	`wmain_emp`.`status` AS workstatus,
    	`wmain_emp`.`work_setup` AS worksetup,
    	`wtoesf_off`.`type_of_request` AS request_type,
    	`wtoesf_off`.`description` AS offboard_reason,
    	`wtoesf_off`.`files` AS file_name,
    	`wtoesf_off`.`created_at` AS request_date
	FROM
    	`work_to_esf`.`offboarding_requests` AS `wtoesf_off`
	INNER JOIN
    	`work_main_db`.`employees` AS `wmain_emp` ON `wtoesf_off`.`employee_id` = `wmain_emp`.`id`
	INNER JOIN
    	`work_ra_too`.`hr_jobs` AS `wmain_job` ON `wmain_emp`.`job_role_id` = `wmain_job`.`id`
    	INNER JOIN
    	`work_ra_too`.`hr_job_categories` AS `wrato` ON `wmain_job`.`category_id` = `wrato`.`id`
	LEFT JOIN
    	`work_main_db`.`departments` AS `wmain_dep` ON `wrato`.`department_id` = `wmain_dep`.`id`
	WHERE
    	`wtoesf_off`.`id` = '$offboard_id';
";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

echo json_encode(array("offdetail" => $data));

?>