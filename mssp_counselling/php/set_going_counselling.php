<?php

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

$id_appointment = $_POST['counselling_id'];

$sql = "

	UPDATE
		`work_mssp_hw`.`counselling_appointment` AS `wmssp_ca`
	SET
		`wmssp_ca`.`appointment_status` = 'Ongoing Counselling'
	WHERE
		`wmssp_ca`.`appointment_id` = '$id_appointment'

";

if ($connection->query($sql) === TRUE) {
	echo 'success';
} else{
	echo 'failed';
}

?>