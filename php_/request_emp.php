<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$data = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$employee_id = $_POST['emp_id'];
	$sql = "SELECT * FROM employees WHERE employee_id='$employee_id'";
	$result = $connection->query($sql);
	//
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
	}
}

// Close connection
$connection->close();

// Send JSON response
echo json_encode(array("data" => $data));

?>