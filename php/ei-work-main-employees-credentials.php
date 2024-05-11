<?php 

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

$id_emp = $_POST['ei_emp_id'];

$data = array();

$sql = "

	SELECT
		CONCAT(
			`wmain_emp`.`first_name`,
			IF(`wmain_emp`.`middle_name` IS NOT NULL, CONCAT(' ', SUBSTRING(`wmain_emp`.`middle_name`, 1, 1), '.'), ''),
			IF(`wmain_emp`.`middle_name` IS NOT NULL, ' ', ''),
			' ',
			`wmain_emp`.`last_name`
	) AS `fullname`,
      	wmain_emp.`status` AS work_status,
      	wmain_job.`name` AS work_position,
      	wmain_dep.`name` AS work_department,
      	wmain_emp.`email` AS work_email
	FROM 
      	`work_main_db`.`employees` AS wmain_emp
	LEFT JOIN
      	`work_ra_too`.`hr_jobs` AS wmain_job
	ON
      	wmain_emp.`job_role_id` = wmain_job.`id`
	LEFT JOIN
	`work_ra_too`.`hr_job_categories` AS `wrato_job_cat`
	ON
	wmain_job.`category_id` = `wrato_job_cat`.`id`
	LEFT JOIN
      	`work_main_db`.`departments` AS wmain_dep
	ON
    	`wrato_job_cat`.`department_id` = wmain_dep.`id`
    WHERE
    	wmain_emp.`code` = '$id_emp'
";

$result = $connection->query($sql);

while($row = $result->fetch_assoc()){
	$data[] = $row;
}


echo json_encode(array("data" => $data));

?>