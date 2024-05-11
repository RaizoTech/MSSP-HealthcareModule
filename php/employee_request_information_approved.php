<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

if(isset($_POST['idmoto'])) {

    $toUpdate_id = $_POST['idmoto'];

    $sql = "
        UPDATE 
            `work_main_db`.`employees` AS `emp_info`
        INNER JOIN 
            `work_eia_tss`.`employee_request_info` AS `emp_req_info`
        ON 
            `emp_info`.`code` = `emp_req_info`.`employee_id` COLLATE utf8mb4_general_ci
        SET
            `emp_info`.`first_name` = `emp_req_info`.`first_name`,
            `emp_info`.`last_name` = `emp_req_info`.`last_name`,
            `emp_info`.`middle_name` = `emp_req_info`.`middle_name`,
            `emp_info`.`date_of_birth` = `emp_req_info`.`date_of_birth`,
            `emp_info`.`place_birth` = `emp_req_info`.`place_birth`,
            `emp_info`.`gender` = `emp_req_info`.`gender`,
            `emp_info`.`civil_status` = `emp_req_info`.`civil_status`,
            `emp_info`.`contact_no` = `emp_req_info`.`contact_number`,
            `emp_info`.`address` = `emp_req_info`.`address`,
            `emp_info`.`email` = `emp_req_info`.`email`,
            `emp_info`.`updated_at` = CURRENT_TIMESTAMP,
            `emp_req_info`.`status` = 'Approved'
        WHERE
            `emp_req_info`.`id` = '$toUpdate_id'
    ";

    if ($connection->query($sql) === TRUE) {
        echo 'Employee update information approve & updated!';
    } else {
        echo 'Employee not update something wrong';
    }

} else {
    echo 'Invalid Request';
}

?>
