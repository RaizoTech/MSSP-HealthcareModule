<?php

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

$data = array();

$sql = "

	SELECT
		`wrat_hronboard`.`id` AS `onboard_id`,
  		CONCAT(
		    `wrat_hrapp`.`fname`,
		        IF(`wrat_hrapp`.`mname` IS NOT NULL, CONCAT(' ', SUBSTRING(`wrat_hrapp`.`mname`, 1, 1), '.'), ''),
		        IF(`wrat_hrapp`.`mname` IS NOT NULL, ' ', ''),
		        ' ',
		    `wrat_hrapp`.`lname`
	    ) AS `fullname`,
  		`wrat_jobs`.`name` AS `position_`,
  		`wrat_hrcomp`.`name` AS `company`,
  		`wrat_hronboard`.`on_boarding_date`
	FROM
  		`work_ra_too`.`hr_onboardings` AS `wrat_hronboard`
	INNER JOIN
  		`work_ra_too`.`hr_tbl_applicants` AS `wrat_hrapp`
	ON
  		`wrat_hronboard`.`applicant_id` = `wrat_hrapp`.`id`
	INNER JOIN
  		`work_ra_too`.`hr_jobs` AS `wrat_jobs`
	ON
  		`wrat_hrapp`.`job_id` = `wrat_jobs`.`id`
	INNER JOIN
  		`work_ra_too`.`hr_companies` AS `wrat_hrcomp`
	ON
  		`wrat_hrapp`.`company_id` = `wrat_hrcomp`.`id`
	WHERE
  		`wrat_hronboard`.`status` = 'Pending'

";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()){
		$data[] = $row;
	}
}

echo json_encode(array("data" => $data));

?>