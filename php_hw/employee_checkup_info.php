<?php 

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

$id = $_POST['idemp'];

$data = array();

$sql = "
	
	SELECT
		`wmain_emp`.`code`,
		CONCAT(
			`wmain_emp`.`first_name`,
			IF(`wmain_emp`.`middle_name` IS NOT NULL, CONCAT(' ', SUBSTRING(`wmain_emp`.`middle_name`,1, 1), '.'), ''),
			IF(`wmain_emp`.`middle_name` IS NOT NULL, '', ''),
			' ',
			`wmain_emp`.`last_name`
		) AS fullname,
		`wmain_emp`.`email`
	FROM
		`work_main_db`.`employees` AS `wmain_emp`
	WHERE
		`wmain_emp`.`code` = '$id'

";


$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

echo json_encode(array("data" => $data));

?>