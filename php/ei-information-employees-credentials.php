<?php 

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

$id_emp = $_POST['ei_emp_id'];

$data = array();

$sql = "

	SELECT 
      weim_emp.`date_of_birth` AS date_of_birth,
      weim_emp.`place_birth` AS place_of_birth,
      weim_emp.`gender` AS sex,
      weim_emp.`civil_status` AS civil_stat
	FROM
      `work_main_db`.`employees` AS weim_emp
	WHERE
      weim_emp.`code` = '$id_emp'
";

$result = $connection->query($sql);

while($row = $result->fetch_assoc()){
	$data[] = $row;
}

echo json_encode(array("data" => $data));

?>