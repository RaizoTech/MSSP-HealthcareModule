<?php

require_once 'config.php';
session_start();
$config = new config();
$connection = $config->getConnection();

$service_id = $_SESSION['service_id'];

$sql = "

	SELECT
		COUNT(`wmssp_ca`.`appointment_status`) AS total_finished
	FROM
		`work_mssp_hw`.`counselling_appointment` AS `wmssp_ca`
	WHERE
		`wmssp_ca`.`appointment_status` = 'Finished' AND `wmssp_ca`.`service_id` = '$service_id'

";

$result = $connection->query($sql);
$row = $result->fetch_assoc();

echo $row['total_finished'];

?>