<?php

require_once 'config.php';
$config = new config();
$connection = $config->getConnection();

// Check if the search query is provided
if(isset($_POST['query'])) {
    // Sanitize the search query
    $searchQuery = htmlspecialchars($_POST['query']);
    
    // Prepare the SQL query with the search condition
    $sql = "
        SELECT
            `wmain_emp`.`code`,
            CONCAT(
                `wmain_emp`.`first_name`,
                IF(`wmain_emp`.`middle_name` IS NOT NULL, CONCAT(' ', SUBSTRING(`wmain_emp`.`middle_name`, 1, 1), '.'), ''),
                IF(`wmain_emp`.`middle_name` IS NOT NULL, '', ''),
                ' ',
                `wmain_emp`.`last_name`
            ) AS `fullname`,
            `wmain_emp`.`email`
        FROM
            `work_main_db`.`employees` AS `wmain_emp`
        WHERE
            `wmain_emp`.`first_name` LIKE ? OR
            `wmain_emp`.`middle_name` LIKE ? OR
            `wmain_emp`.`last_name` LIKE ? OR 
            `wmain_emp`.`code` LIKE ?
    ";

    // Prepare and execute the SQL statement
    $stmt = $connection->prepare($sql);
    $searchQuery = "%$searchQuery%";
    $stmt->bind_param("ssss", $searchQuery, $searchQuery, $searchQuery, $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the results
    $results = [];
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }

    // Return the results in JSON format
    echo json_encode($results);
} else {
    // If the search query is not provided, execute the default SQL query
    $sql = "
        SELECT
            `wmain_emp`.`code`,
            CONCAT(
                `wmain_emp`.`first_name`,
                IF(`wmain_emp`.`middle_name` IS NOT NULL, CONCAT(' ', SUBSTRING(`wmain_emp`.`middle_name`, 1, 1), '.'), ''),
                IF(`wmain_emp`.`middle_name` IS NOT NULL, '', ''),
                ' ',
                `wmain_emp`.`last_name`
            ) AS `fullname`,
            `wmain_emp`.`email`
        FROM
            `work_main_db`.`employees` AS `wmain_emp`
    ";
    
    $result = $connection->query($sql);
    $results = [];
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
    echo json_encode($results);
}

?>