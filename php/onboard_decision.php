<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// Decision and Applicant  ID
	$app_id = $_POST['applicant_id'];
	$des_val = $_POST['decision_value'];
	// Set QUERY
	$sql = "
		UPDATE 
			`work_ra_too`.`hr_onboardings` AS `wrato_onb`
		SET
			`wrato_onb`.`status` = '$des_val'
		WHERE
			`wrato_onb`.`applicant_id` = '$app_id'
	";

	if ($connection->query($sql) === TRUE) {
		if($des_val === "Approved"){
			echo 'Onboard Approved!';
		}
		if($des_val === "Qualified"){
			echo 'Onboard Qualified!';
		}
		if($des_val === "Declined"){
			echo 'Onboard Declined!';
		}
	} else {
		echo 'failed';
	}

}

?>