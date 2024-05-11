<?php

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

$data = array();

$rowID = $_POST['row_id'];

$sql = "

	SELECT
		`wlmba_leaves`.`id`,
		`wmain_emp`.`code`,
		CONCAT(
		`wmain_emp`.`first_name`,
		IF(`wmain_emp`.`middle_name` IS NOT NULL, CONCAT(' ', SUBSTRING(`wmain_emp`.`middle_name`, 1, 1), '.'), ''),
		IF(`wmain_emp`.`middle_name` IS NOT NULL, ' ', ''),
		' ',
		`wmain_emp`.`last_name`
	    ) AS `fullname`,
		`wlmba_leaves`.`LeaveType`,
		`wlmba_leaves`.`ToDate`,
		`wlmba_leaves`.`FromDate`,
		`wlmba_leaves`.`PostingDate`,
		`wlmba_leaves`.`Description`,
		`wlmba_leaves`.`img` AS img_checker
	FROM
		`work_lm_ba`.`tblleaves` AS `wlmba_leaves`
	INNER JOIN
		`work_main_db`.`employees` AS `wmain_emp`
	ON
		`wlmba_leaves`.`empid` = `wmain_emp`.`id`
	WHERE
		`wlmba_leaves`.`id` = '$rowID'

";

$result = $connection->query($sql);
$row = $result->fetch_assoc();
$data[] = $row;
echo json_encode(array("leave_detail" => $data));

?>