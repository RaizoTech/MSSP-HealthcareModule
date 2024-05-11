<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

if(isset($_POST['arc_id'])){
	$id = $_POST['arc_id'];
	$sql = "SELECT hwarticle_content FROM health_wellness_arc WHERE hwarticle_id='$id'";
	$result = $connection->query($sql);
	if($result->num_rows > 0){

		$content = $result->fetch_assoc();
		echo $content['hwarticle_content'];

	}
}

?>