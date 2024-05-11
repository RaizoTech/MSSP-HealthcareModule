<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$data = array();

$sql = "
	SELECT 
        `wmain_emp`.`code`,
        `wrw_rr`.`id`, 
        CONCAT(`wmain_emp`.`first_name`, ' ', `wmain_emp`.`last_name`) AS full_name,
        `wrw_rr`.`request_date` AS date_request,
        `wrw_rr`.`total_score`
	FROM 
        `work_rf_api`.`remote_requests` AS `wrw_rr`
	INNER JOIN 
        `work_main_db`.`employees` AS wmain_emp 
	ON 
        `wrw_rr`.`emp_id` = `wmain_emp`.`id`
	WHERE 
        `wrw_rr`.`status` = 'For Reveiwing'
";

$result = $connection->query($sql);

if ($result->num_rows > 0) { while ($row = $result->fetch_assoc()) { $data[] = $row; } }

echo json_encode(array("data" => $data));

?>