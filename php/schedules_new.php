<?php

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

$data = array();

$sql = "

	SELECT
    	`weiats_schedules`.`rotating_schedule` AS `rotate_sched`,
    	`weiats_schedules`.`shift_type` AS `shift`,
    	CONCAT(
        	CASE
            	WHEN `weiats_schedules`.`shift_type` = 'Morning' THEN TIME_FORMAT(`weiats_schedules`.`time_in`, '%h:%i %p')
            	WHEN `weiats_schedules`.`shift_type` = 'Afternoon' THEN TIME_FORMAT(`weiats_schedules`.`time_in`, '%h:%i %p')
            	WHEN `weiats_schedules`.`shift_type` = 'Evening' THEN TIME_FORMAT(`weiats_schedules`.`time_in`, '%h:%i %p')
            	WHEN `weiats_schedules`.`shift_type` = 'graveyard' THEN TIME_FORMAT(`weiats_schedules`.`time_in`, '%h:%i %p')
        	END,
        	'  -  ',
        	CASE
            	WHEN `weiats_schedules`.`shift_type` = 'Morning' THEN TIME_FORMAT(`weiats_schedules`.`time_out`, '%h:%i %p')
            	WHEN `weiats_schedules`.`shift_type` = 'Afternoon' THEN TIME_FORMAT(`weiats_schedules`.`time_out`, '%h:%i %p')
            	WHEN `weiats_schedules`.`shift_type` = 'Evening' THEN TIME_FORMAT(`weiats_schedules`.`time_out`, '%h:%i %p')
            	WHEN `weiats_schedules`.`shift_type` = 'graveyard' THEN TIME_FORMAT(`weiats_schedules`.`time_out`, '%h:%i %p')
        	END
    	) AS `time_inout`,
    	CONCAT(
        	FLOOR(`weiats_schedules`.`total_hours`), 'hr ',
        	MOD(`weiats_schedules`.`total_hours` * 60, 60), 'min'
    	) AS `formatted_total_hours`
	FROM
    	`work_eia_tss`.`schedules` AS `weiats_schedules`;

";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

echo json_encode(array("data" => $data));

?>