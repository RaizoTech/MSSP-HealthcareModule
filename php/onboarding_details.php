<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$id = $_POST['onboardID'];

$data = array();

$sql = "

	SELECT
		`wrato_onboards`.`applicant_id`,
		CONCAT(
		    `wrato_apps`.`fname`,
		        IF(`wrato_apps`.`mname` IS NOT NULL, CONCAT(' ', SUBSTRING(`wrato_apps`.`mname`, 1, 1), '.'), ''),
		        IF(`wrato_apps`.`mname` IS NOT NULL, ' ', ''),
		        ' ',
		    `wrato_apps`.`lname`
	    ) AS `fullname`,
		`wrato_onboards`.`orient_date`,
		`wrato_onboards`.`on_boarding_date`,
		`wrato_onboards`.`approval_date`,
		`wrato_onboards`.`remarks`,
		`wrato_onboards`.`medical` AS req1,
		`wrato_onboards`.`nbi` AS req2,
		`wrato_onboards`.`philhealth` AS req3,
		`wrato_onboards`.`sss` AS req4,
		`wrato_onboards`.`brgy_clearance` AS req5,
		`wrato_onboards`.`tin_id` AS req6,
		`wrato_onboards`.`picture` AS req7
	FROM
		`work_ra_too`.`hr_onboardings` AS `wrato_onboards`
	INNER JOIN
		`work_ra_too`.`hr_tbl_applicants` AS `wrato_apps`
	ON
		`wrato_onboards`.`applicant_id` = `wrato_apps`.`id`
	WHERE
		`wrato_onboards`.`id` = '$id';

";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

echo json_encode(array("data" => $data));

?>