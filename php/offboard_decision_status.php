<?php

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// POST METHOD VARIABLE
	$offboardID = $_POST['offbaord_id'];
	$decision = $_POST['decision_value'];
	// SQL
	$sql = "
		UPDATE
			`work_to_esf`.`offboarding_requests` AS `wtoesf_off`
		SET
			`wtoesf_off`.`status` = '$decision',
			`wtoesf_off`.`updated_at` = CURRENT_TIMESTAMP
		WHERE
			`wtoesf_off`.`id` = '$offboardID'
	";
	// Result
	if ($connection->query($sql) === TRUE) {
		// Condition
		if ($decision === "Approved") {
			echo 'Offboard Request Approved!';
		}
		if ($decision === "Denied") {
			echo 'Offboard Request Denied!';
		}
	}
}

?>