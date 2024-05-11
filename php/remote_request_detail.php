<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$data = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// Variable Array POST method
	$remote_id = $_POST['emp_id'];
	// SQL
	$sql = "
		SELECT
			`wrfapi_rr`.`id`,
			CONCAT(`wmain_emp`.`first_name`, ' ', `wmain_emp`.`last_name`) AS fullname,
			`wrfapi_rr`.`request_reason`,
			`wrfapi_rr`.`total_score`,
			`wrfapi_rr`.`request_date`,
			`wrfapi_rr`.`jobrole_suitability` AS q1,
			`wrfapi_rr`.`performance_accountability` AS q2,
			`wrfapi_rr`.`technological_readiness` AS q3,
			`wrfapi_rr`.`communication_skills` AS q4,
			`wrfapi_rr`.`work_environment` AS q5,
			`wrfapi_rr`.`flexibility_adaptability` AS q6,
			`wrfapi_rr`.`health_wellbeing` AS q7,
			`wrfapi_rr`.`organizational_needs` AS q8,
			`wrfapi_rr`.`legal_compliance` AS q9
		FROM
			`work_rf_api`.`remote_requests` AS `wrfapi_rr`
		INNER JOIN
			`work_main_db`.`employees` AS `wmain_emp`
		ON
			`wrfapi_rr`.`emp_id` = `wmain_emp`.`id`
		WHERE
			`wrfapi_rr`.`id` = '$remote_id'
	";
	// Result
	$result = $connection->query($sql);
	// Fetching and encoding JSON
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$data[] = $row;
	}
	// Echo JSON
	echo json_encode(array("remote_details" => $data));
}

?>