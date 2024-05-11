<?php 

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

$data = array();

$sql = "

	SELECT
		`wtoesf_off`.`id`,
		`wmain_emp`.`code`,
		CONCAT(`wmain_emp`.`first_name`, ' ', `wmain_emp`.`last_name`) AS fullname,
		`wmain_job`.`name` AS position,
		`wtoesf_off`.`type_of_request` AS request_type,
		`wtoesf_off`.`created_at` AS request_date
	FROM
		`work_to_esf`.`offboarding_requests` AS `wtoesf_off`
	INNER JOIN
		`work_main_db`.`employees` AS `wmain_emp`
	ON
		`wtoesf_off`.`employee_id` = `wmain_emp`.`id`
	INNER JOIN
		`work_ra_too`.`hr_jobs` AS `wmain_job`
	ON
		`wmain_emp`.`job_role_id` = `wmain_job`.`id`
	WHERE
		`wtoesf_off`.`status` IN('Pending');

";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

echo json_encode(array("offboard_list" => $data));

?>