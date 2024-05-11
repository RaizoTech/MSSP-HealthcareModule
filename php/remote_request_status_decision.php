<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// Getting Variables POST METHOD VARIABLES
	$employee_id = $_POST['emp_id_identifier'];
	$decision = $_POST['decision_value'];
	// SQL Var
	$sql = "
		UPDATE
			`work_rf_api`.`remote_requests` AS `wrfapi_rr`
		INNER JOIN
			`work_main_db`.`employees` AS `wmain_emp`
		ON
			`wrfapi_rr`.`emp_id` = `wmain_emp`.`id`
		SET
			`wrfapi_rr`.`status` = '$decision',
			`wrfapi_rr`.`updated_at` = CURRENT_TIMESTAMP,
			`wmain_emp`.`work_setup` = 'remote'
		WHERE
			`wrfapi_rr`.`id` = $employee_id;
	";
	// Result & Execute
	if ($connection->query($sql) === TRUE) {
		if ($decision === "Approved") {
			echo 'Employee remote request approved!';
		}
		if ($decision === "Declined") {
			echo 'Employee remote request declined!';
		}
	}
}

?>