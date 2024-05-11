<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$id_emp = $_POST['service_id'];
$sql = "
    SELECT
		CONCAT(
			`wmain_emp`.`first_name`,
			IF(`wmain_emp`.`middle_name` IS NOT NULL, CONCAT(' ', SUBSTRING(`wmain_emp`.`middle_name`, 1, 1), '.'), ''),
			IF(`wmain_emp`.`middle_name` IS NOT NULL, '', ''),
			' ',
			`wmain_emp`.`last_name`
		) AS fullname,
		`wmain_dept`.`name` AS `department`,
		`wrato_job`.`name` AS `position`,
		CONCAT(
			DATE_FORMAT(`wmssp_ca`.`appointment_date`, '%M %e, %Y - '),
			TIME_FORMAT(`wmssp_ca`.`appointment_time`, '%h:%i %p')
		) AS `datetime_appointment`
	FROM
		`work_mssp_hw`.`counselling_appointment` AS `wmssp_ca`
	INNER JOIN
		`work_main_db`.`employees` AS `wmain_emp` ON `wmssp_ca`.`employee_code` = `wmain_emp`.`code`
	INNER JOIN
		`work_ra_too`.`hr_jobs` AS `wrato_job` ON `wmain_emp`.`job_role_id` = `wrato_job`.`id`
	INNER JOIN
		`work_ra_too`.`hr_job_categories` AS `wrato_job_cat` ON `wrato_job`.`category_id` = `wrato_job_cat`.`id`
	INNER JOIN
		`work_main_db`.`departments` AS `wmain_dept` ON `wrato_job_cat`.`department_id` = `wmain_dept`.`id`
	INNER JOIN
		`work_mssp_hw`.`counselling_service` AS `wmssp_cs` ON `wmssp_ca`.`service_id` = `wmssp_cs`.`service_id`
	WHERE
		`wmssp_ca`.`service_id` = '$id_emp'
	GROUP BY 
        `wmssp_ca`.`appointment_date`, 
        `wmssp_ca`.`appointment_time`
    ORDER BY 
        `wmssp_ca`.`appointment_date` ASC,
        `wmssp_ca`.`appointment_time` ASC
    ";
$result = $connection->query($sql);

$data = array();

if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$data[] = $row;
	}
}

$connection->close();

echo json_encode(array("data1" => $data));

?>