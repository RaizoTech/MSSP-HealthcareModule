<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$id_emp = $_POST['service_id'];
$sql = "
        SELECT employees.`first_name`, employees.`last_name`, employees.`department`, employees.`position`, counselling_appointment.`appointment_date`, counselling_appointment.`appointment_time`
        FROM employees
        INNER JOIN counselling_appointment ON employees.`employee_id` = counselling_appointment.`employee_id`
        INNER JOIN counselling_service ON counselling_appointment.`service_id` = counselling_service.`service_id`
        WHERE counselling_appointment.`service_id` = '$id_emp'
        GROUP BY counselling_appointment.`appointment_date`, counselling_appointment.`appointment_time`
        ORDER BY counselling_appointment.`appointment_date` ASC, counselling_appointment.`appointment_time` ASC
    ";
$result = $connection->query($sql);

$data = array();

if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$data[] = $row;
	}
}

$connection->close();

echo json_encode(array("data1" => $data));

?>