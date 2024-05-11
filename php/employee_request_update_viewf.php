<?php 

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if (!empty($_POST['id_emp'])) {

		$id = $_POST['id_emp'];

		$data = array();

		$sql = "
			SELECT
				CONCAT(`weim_emp_req`.`first_name`, ' ', `weim_emp_req`.`middle_name`, ' ', `weim_emp_req`.`last_name`) AS fullname,
   				`weim_emp_req`.`date_of_birth`,
   				`weim_emp_req`.`place_birth`,
   				`weim_emp_req`.`gender`,
   				`weim_emp_req`.`email`,
   				`weim_emp_req`.`contact_number`,
   				`weim_emp_req`.`address`,
   				`weim_emp_req`.`civil_status`,
   				`weim_emp_req`.`request_date`
   			FROM
   				`work_eia_tss`.`employee_request_info` AS `weim_emp_req`
   			WHERE
   				`weim_emp_req`.`id` = '$id'
		";

		$result = $connection->query($sql);

		if ($result->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {

				$data[] = $row;

			}

		}

		echo json_encode(array("data_view_information_request" => $data));

	}

}

?>