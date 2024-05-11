<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

if(isset($_POST['prog_id'])){
	$id = $_POST['prog_id'];
	$sql = "SELECT hwprogram_description FROM health_wellness_program WHERE hwprogram_id='$id'";
	$result = $connection->query($sql);
	if($result->num_rows > 0){

		$content = $result->fetch_assoc();
		$decoded = htmlspecialchars_decode($content['hwprogram_description']);
		echo $decoded;

	}
}

?>