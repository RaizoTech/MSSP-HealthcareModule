<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();
session_start();

$id_emp = $_SESSION['service_identifier'];
$sql = "
       SELECT
        `wmssp_ca`.`appointment_id`,
        `wmain_emp`.`code`,
		CONCAT(
			`wmain_emp`.`first_name`,
			IF(`wmain_emp`.`middle_name` IS NOT NULL, CONCAT(' ', SUBSTRING(`wmain_emp`.`middle_name`, 1, 1), '.'), ''),
			IF(`wmain_emp`.`middle_name` IS NOT NULL, ' ', ''),
			' ',
			`wmain_emp`.`last_name`
		) AS `fullname`,
        `wmssp_ca`.`employee_code`,
        `wmain_job`.`name` AS position_,
        `wmain_dep`.`name` AS department,
        `wmssp_ca`.`appointment_date`,
        `wmssp_ca`.`appointment_time`
        FROM
        `work_mssp_hw`.`counselling_appointment` AS `wmssp_ca`
        INNER JOIN
        `work_main_db`.`employees` AS `wmain_emp`
        ON
        `wmssp_ca`.`employee_code` = `wmain_emp`.`code`
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
        `wmssp_ca`.`service_id` = '$id_emp' AND `wmssp_ca`.`appointment_status` IN('Pending','Ongoing Counselling')
    ";
$result = $connection->query($sql);

$data = array();

if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$data[] = $row;
	}
}

$connection->close();

echo json_encode(array("data" => $data));

?>