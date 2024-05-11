<?php

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();


$sql = "
	SELECT 
    	`wrato_app`.`applicant_id`,
    	CONCAT(
        `wrato_app`.`fname`,
        IF(`wrato_app`.`mname` IS NOT NULL, CONCAT(' ', SUBSTRING(`wrato_app`.`mname`, 1, 1), '.'), ''),
        IF(`wrato_app`.`mname` IS NOT NULL, ' ', ''),
        	CASE
            	WHEN `wrato_app`.`mname` IS NOT NULL THEN `wrato_app`.`mname`
            	ELSE ''
        	END,
        	' ',
        	`wrato_app`.`lname`
    	) AS full_name,
    	`wrato_app`.`email`,
    	`wrato_app`.`contact_no`,
    	`wrato_job`.`name` AS applying_position,
    	`wrato_cat`.`name` AS category_position
	FROM 
    	`work_ra_too`.`hr_tbl_applicants` AS `wrato_app`
	LEFT JOIN 
    	`work_ra_too`.`hr_jobs` AS `wrato_job` 
	ON 
    	`wrato_app`.`job_id` = `wrato_job`.`id`
	LEFT JOIN 
    	`work_ra_too`.`hr_job_categories` AS `wrato_cat`
	ON 
    	`wrato_job`.`category_id` = `wrato_cat`.`id`
	WHERE 
    	`wrato_app`.`status` IN ('Active','Unactive','Reserved');
";
$result = $connection->query($sql);

$data = array();

if ($result->num_rows > 0) { while ($row = $result->fetch_assoc()) { $data[] = $row; } }

echo json_encode(array("data" => $data));

?>