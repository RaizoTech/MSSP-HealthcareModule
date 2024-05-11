<?php 

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	// POST
	$idapp = $_POST['applicant_id'];
	// Array
	$data = array();
	// SQL 
	$sql = "
		SELECT
			`wrato_app`.`applicant_id`,
			CONCAT(`wrato_app`.`fname`, ' ', `wrato_app`.`lname`) AS fullname,
			`wrato_app`.`gender`,
			`wrato_app`.`birthdate` AS birthday,
			`wrato_app`.`age`,
			`wrato_app`.`civil_status`,
			`wrato_app`.`email`,
			`wrato_app`.`address`,
			`wrato_app`.`contact_no`,
			`wrato_app`.`applicant_image`,
			`wrato_app`.`registration_date`,
			`wrato_comp`.`name` AS company_name,
			`wrato_jobs`.`name` AS position_,
			`wrato_jobcat`.`name` AS job_category
		FROM
			`work_ra_too`.`hr_tbl_applicants` AS `wrato_app`
		INNER JOIN
			`work_ra_too`.`hr_companies` AS `wrato_comp`
		ON
			`wrato_app`.`company_id` = `wrato_comp`.`id`
		INNER JOIN
			`work_ra_too`.`hr_jobs` AS `wrato_jobs`
		ON
			`wrato_app`.`job_id` = `wrato_jobs`.`id`
		INNER JOIN
			`work_ra_too`.`hr_job_categories` AS `wrato_jobcat`
		ON
			`wrato_jobs`.`category_id` = `wrato_jobcat`.`id`
		WHERE
			`wrato_app`.`applicant_id` = '$idapp'
	";

	$result = $connection->query($sql);

	if ($result->num_rows > 0) {

		$row = $result->fetch_assoc();

		$data[] = $row;

	}

	echo json_encode(array("app_data" => $data));

}

?>