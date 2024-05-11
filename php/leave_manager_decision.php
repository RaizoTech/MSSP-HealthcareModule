<?php 

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if (isset($_POST['decision_value']) && isset($_POST['row_id_leave']) && isset($_POST['admin_remark_note'])) {

		$decision = $_POST['decision_value'];
		$row_id = $_POST['row_id_leave'];
		$remark_note = $_POST['admin_remark_note'];

		$sql = "

			UPDATE
				`work_lm_ba`.`tblleaves` AS `wlmba_leaves`
			SET
				`wlmba_leaves`.`AdminRemark` = '$remark_note',
				`wlmba_leaves`.`AdminRemarkDate` = CURRENT_TIMESTAMP,
				`wlmba_leaves`.`status` = $decision
			WHERE
				`wlmba_leaves`.`id` = $row_id

		";

		$result = $connection->query($sql);

		if ($result === TRUE) {
			if ($decision === '1') {
				echo 'Success1';
			}
			if ($decision === '2') {
				echo 'Success2';
			}
		} else {
			echo 'Failed';
		}

	}

}

?>