<?php

require_once 'config.php';
$config  = new config();
$connection = $config->getConnection();

$data = array();

$employeecode = $_POST['employee_code'];

$sql = "
	SELECT 
		CONCAT(
			`wmain_emp`.`first_name`,
			IF(`wmain_emp`.`middle_name` IS NOT NULL, CONCAT(' ', SUBSTRING(`wmain_emp`.`middle_name`, 1, 1), '.'), ''),
			IF(`wmain_emp`.`middle_name` IS NOT NULL, ' ', ''),
			' ',
			`wmain_emp`.`last_name`
		) AS `fullname`,
		`wmain_emp`.`date_of_birth`,
		`wmain_job`.`name` AS position_,
		`wmain_dep`.`name` AS department
	FROM
		`work_main_db`.`employees` AS `wmain_emp`
	INNER JOIN 
		`work_ra_too`.`hr_jobs` AS `wmain_job`
	ON
		`wmain_emp`.`job_role_id` = `wmain_job`.`id`
	INNER JOIN
		`work_ra_too`.`hr_job_categories` AS `wrato_job_cat`
	ON
		`wmain_job`.`category_id` = `wrato_job_cat`.`id`
	INNER JOIN
		`work_main_db`.`departments` AS `wmain_dep`
	ON
		`wrato_job_cat`.`department_id` = `wmain_dep`.`id`
	WHERE
		`wmain_emp`.`code` = '$employeecode'
";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

echo json_encode(array("data" => $data));

?>