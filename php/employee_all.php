<?php

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

$sql = "
		SELECT
		`wmain_emp`.`code`,
		CONCAT(
			`wmain_emp`.`first_name`,
			IF(`wmain_emp`.`middle_name` IS NOT NULL, CONCAT(' ', SUBSTRING(`wmain_emp`.`middle_name`, 1, 1), '.'), ''),
			IF(`wmain_emp`.`middle_name` IS NOT NULL, ' ', ''),
			' ',
			`wmain_emp`.`last_name`
		) AS `fullname`,
		`wmain_emp`.`status` AS status,
		`wrato_jobs`.`name` AS position,
		`wmain_dept`.`name` AS department
	FROM
		`work_main_db`.`employees` AS `wmain_emp`
	INNER JOIN
		`work_ra_too`.`hr_jobs` AS `wrato_jobs`
	ON
		`wmain_emp`.`job_role_id` = `wrato_jobs`.`id`
	INNER JOIN
		`work_ra_too`.`hr_job_categories` AS `wrato_category`
	ON
		`wrato_jobs`.`category_id` = `wrato_category`.`id`
	INNER JOIN
		`work_main_db`.`departments` AS `wmain_dept`
	ON
		`wrato_category`.`department_id` = `wmain_dept`.`id`
";
$result = $connection->query($sql);

$data = array();

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

// Close connection
$connection->close();

// Send JSON response
echo json_encode(array("data" => $data));

?>