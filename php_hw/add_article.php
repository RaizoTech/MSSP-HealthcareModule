<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();
$addarticlenotif = ['success' => false, 'message' => ''];

$filepath = '../images_article/';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize Variables from the form submission
    $article_content = $connection->real_escape_string($_POST['new_article_content']);
    $article_title = $connection->real_escape_string($_POST['new_article_title']);
    $article_author = $connection->real_escape_string($_POST['new_article_author']);
    
    // File Upload Process
    if (isset($_FILES['profile_image_arc']) && $_FILES['profile_image_arc']['error'] != UPLOAD_ERR_NO_FILE && isset($_FILES['content_image_arc']) && $_FILES['content_image_arc']['error'] != UPLOAD_ERR_NO_FILE) {
        // Set Target Path
        $targetFile1 = $filepath . basename($_FILES["profile_image_arc"]["name"]);
        $targetFile2 = $filepath . basename($_FILES["content_image_arc"]["name"]);
        
        // Moving files
        if (move_uploaded_file($_FILES["profile_image_arc"]["tmp_name"], $targetFile1) && move_uploaded_file($_FILES["content_image_arc"]["tmp_name"], $targetFile2)) {
            // Target File names for saving into database
            $imagefilename1 = $_FILES['profile_image_arc']['name'];
            $imagefilename2 = $_FILES['content_image_arc']['name'];
            
            // Process Into MySQL
            $sql = "INSERT INTO health_wellness_arc(hwarticle_title, hwarticle_image, hwarticle_image_content, hwarticle_content, hwarticle_author) VALUES('$article_title','$imagefilename1','$imagefilename2','$article_content','$article_author')";
            
            // Result
            if ($connection->query($sql) === TRUE) {
                $addarticlenotif['success'] = true;
                $addarticlenotif['message'] = 'Article added successfully.';
            } else {
                $addarticlenotif['message'] = 'Failed to add article.';
            }
        } else {
            $addarticlenotif['message'] = 'Failed to move uploaded files.';
        }
    } else {
        $addarticlenotif['message'] = 'No files were uploaded.';
    }
    
    $connection->close();
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode(['result' => $addarticlenotif]);

?>