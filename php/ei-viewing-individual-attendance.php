<?php

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

$id_emp = $_POST['request_id'];

$data = array();

$sql = "

	SELECT
		`wess_pr`.`date` AS date_in,
		`wess_pr`.`time_in`,
		`wess_pr`.`time_out`,
		`wess_pr`.`working_hours`,
		`wess_pr`.`status`
	FROM
		`work_ess_payroll`.`attendances` AS `wess_pr`
	INNER JOIN
		`work_main_db`.`employees` AS `wmain_emp`
	ON
		`wess_pr`.`employee_code` = `wmain_emp`.`code`
	WHERE
		`wess_pr`.`employee_code` = '$id_emp'
";
$result = $connection->query($sql);

while ($row = $result->fetch_assoc()) {
	$data[] = $row;
}

echo json_encode(array("data" => $data));

?>