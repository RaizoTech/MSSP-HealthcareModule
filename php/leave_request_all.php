<?php

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

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
        `wlmba_leaves`.`FromDate`
    FROM
        `work_lm_ba`.`tblleaves` AS `wlmba_leaves`
    INNER JOIN
        `work_main_db`.`employees` AS `wmain_emp`
    ON
        `wlmba_leaves`.`empid` = `wmain_emp`.`id`
    WHERE
        `wlmba_leaves`.`Status` = '0'

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