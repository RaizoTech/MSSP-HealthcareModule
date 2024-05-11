<?php 

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

$sql = "
	SELECT 
		`wmain`.`code`, 
		`wmain`.`first_name`, 
		`wmain`.`last_name`, 
		`wpeam_pd`.`ave_feedback_rating`, 
		`wpeam_pd`.`ave_present`, 
		`wpeam_pd`.`ave_absent` 
	FROM 
		`work_pm_sep`.`performance_data` AS `wpeam_pd` 
	INNER JOIN 
		`work_main_db`.`employees` AS `wmain`
	ON 
		`wpeam_pd`.`employee_id` = `wmain`.`code`
";

$data = array();

$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

// Close connection
$connection->close();

// Send JSON response
echo json_encode(array("data" => $data));

?>