<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

// Check if request_date_preview and id_seq_emp are set in $_POST
if(isset($_POST['id_seq_emp'])) {

    $toUpdate_id = $_POST['id_seq_emp'];

    $sql = "
        UPDATE
            `work_eia_tss`.`employee_request_info` AS `emp_req_info`
        SET
            `emp_req_info`.`status` = 'Rejected'
        WHERE
            `emp_req_info`.`id` = '$toUpdate_id'
    ";

    if ($connection->query($sql) === TRUE) {

        echo 'Employee update information request rejected!';

    } else {

        echo 'Not Update!';

    }
} else {
    // Handle the case when request_date_preview or id_seq_emp is not set
    echo 'Invalid request!';

}
?>
