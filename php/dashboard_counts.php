<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$data = array();

$sql_queries = array(
    "SELECT COUNT(*) AS total_employees FROM `work_main_db`.`employees`",
    "SELECT COUNT(*) AS total_remoterequest FROM `work_rf_api`.`remote_requests` WHERE status='For Reveiwing'",
    "SELECT COUNT(*) AS total_leaverequest FROM `work_lm_ba`.`tblleaves` WHERE Status='0'",
    "SELECT COUNT(*) AS total_onboarding FROM `work_ra_too`.`hr_onboardings` WHERE status='Pending'"
);

foreach ($sql_queries as $sql) {
    $result = $connection->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        $data[] = $row;
    } else {
        // Handle query error if needed
        $data[] = array("error" => $connection->error);
    }
}

echo json_encode(array("data" => $data));
?>
