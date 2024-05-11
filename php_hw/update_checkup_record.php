<?php

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (isset($_POST['checkup_note'], $_POST['setstatus_checkup_record'], $_POST['row_id_checkup_id'])) {
		// Identify POST variable's
		$row_id = $_POST['row_id_checkup_id'];
		$status = $_POST['setstatus_checkup_record'];
		$note = $_POST['checkup_note'];
		// Set SQL Command to update record
		$sql = "
			UPDATE
				`work_mssp_hw`.`checkup_appointment` AS `wmssp_cha`
			SET
				`wmssp_cha`.`status` = '$status',
				`wmssp_cha`.`note` = '$note'
			WHERE
				`wmssp_cha`.`checkup_id` = '$row_id'
		";
		if ($connection->query($sql) === TRUE) {
			echo 'success';
		} else {
			echo 'failed';
		}
	} else {
		echo 'Fill all forms!';
	}
}

?>