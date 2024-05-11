<?php
date_default_timezone_set('Asia/Manila');
require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

$data = array();

$sql = "
	SELECT
		CONCAT(`wmain_emp`.`first_name`, ' ', LEFT(`wmain_emp`.`middle_name`, 1), '. ', `wmain_emp`.`last_name`) AS fullname,
		`wess_pr`.`time_in`,
		`wess_pr`.`time_out`,
		`wess_pr`.`working_hours`,
		`wess_pr`.`status`,
		`wess_pr`.`date`
	FROM
		`work_ess_payroll`.`attendances` AS `wess_pr`
	INNER JOIN
		`work_main_db`.`employees` AS `wmain_emp`
	ON
		`wess_pr`.`employee_code` = `wmain_emp`.`code`
";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

$connection->close();

echo json_encode(array("data" => $data));

?>