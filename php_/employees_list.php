<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$sql = "SELECT * FROM employees";
$result = $connection->query($sql);

$data = array();

if ($result->num_rows > 0) {
	// Creating While Loop
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

// Close connection
$connection->close();

// Send JSON response
echo json_encode(array("data" => $data));

?>