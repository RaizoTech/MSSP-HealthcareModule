<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$addprogramnotif = ['success' => false, 'message' => ''];

$filepath = '../images_programs/';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize Variables from the form submission
    $program_content = $connection->real_escape_string($_POST['new_program_content']);
    $program_name = $connection->real_escape_string($_POST['new_program_name']);
    $program_organizer = $connection->real_escape_string($_POST['new_program_organizer']);
    $program_start_date = $connection->real_escape_string($_POST['start_progdate']);
    $program_end_date = $connection->real_escape_string($_POST['end_progdate']);

    // File Upload Process
    if (isset($_FILES['profile_image_prog']) && $_FILES['profile_image_prog']['error'] != UPLOAD_ERR_NO_FILE && isset($_FILES['content_image_prog']) && $_FILES['content_image_prog']['error'] != UPLOAD_ERR_NO_FILE) {
        // Set Target Path
        $targetFile1 = $filepath . basename($_FILES["profile_image_prog"]["name"]);
        $targetFile2 = $filepath . basename($_FILES["content_image_prog"]["name"]);

        // Moving files
        if (move_uploaded_file($_FILES["profile_image_prog"]["tmp_name"], $targetFile1) && move_uploaded_file($_FILES["content_image_prog"]["tmp_name"], $targetFile2)) {
            // Target File names for saving into database
            $imagefilename1 = $_FILES['profile_image_prog']['name'];
            $imagefilename2 = $_FILES['content_image_prog']['name'];

            // Sanitize HTML content
            $program_content = htmlspecialchars($program_content);

            // Process Into MySQL
            $sql = "INSERT INTO health_wellness_program(hwprogram_name, hwprogram_image, hwprogram_image_content, hwprogram_description, hwprogram_start_date, hwprogram_end_date, hwprogram_organizer) VALUES('$program_name','$imagefilename1','$imagefilename2','$program_content','$program_start_date','$program_end_date','$program_organizer')";

            // Result
            if ($connection->query($sql) === TRUE) {
                $addprogramnotif['success'] = true;
                $addprogramnotif['message'] = 'Health & Wellness Program added successfully.';
            } else {
                $addprogramnotif['message'] = 'Failed to add Program.';
            }
        } else {
            $addprogramnotif['message'] = 'Failed to move uploaded files.';
        }
    } else {
        $addprogramnotif['message'] = 'No files were uploaded.';
    }

    $connection->close();
}
// Return JSON response
header('Content-Type: application/json');
echo json_encode(['result' => $addprogramnotif]);
?>
