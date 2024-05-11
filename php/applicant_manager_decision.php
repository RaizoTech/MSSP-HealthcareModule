<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// Post Array
	$app_id = $_POST['applicant_id'];
	$decision = $_POST['decision_value'];
	$sql = '';
	// SQL Query
	if ($decision === 'Approved') {
		$sql = "
		UPDATE
			`work_ra_too`.`hr_tbl_applicants` AS `wrato_app`
		SET
			`wrato_app`.`status` = '$decision',
			`wrato_app`.`datetime_approved` = CURRENT_TIMESTAMP
		WHERE
			`wrato_app`.`applicant_id` = '$app_id'
		";
	}
	if ($decision === 'Qualified') {
		$sql = "
		UPDATE
			`work_ra_too`.`hr_tbl_applicants` AS `wrato_app`
		SET
			`wrato_app`.`status` = '$decision',
			`wrato_app`.`datetime_approved` = CURRENT_TIMESTAMP
		WHERE
			`wrato_app`.`applicant_id` = '$app_id'
		";
	}
	if ($decision === 'Failed') {
		$sql = "
		UPDATE
			`work_ra_too`.`hr_tbl_applicants` AS `wrato_app`
		SET
			`wrato_app`.`status` = '$decision'
		WHERE
			`wrato_app`.`applicant_id` = '$app_id'
		";
	}
	// Result & Execute
	if ($connection->query($sql) === TRUE) {
		if ($decision === "Approved") {
			echo 'Applicant '.$app_id.' approved!';
		}
		if ($decision === "Qualified") {
			echo 'Applicant '.$app_id.' qualified!';
		}
		if ($decision === "Failed") {
			echo 'Applicant '.$app_id.' set to failed!';
		}
	}

}

?>