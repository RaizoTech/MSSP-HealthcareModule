<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();
$addarticlenotif = ['success' => false, 'message' => ''];

$filepath = '../images_article/';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize Variables from the form submission
    $article_content = $_POST['new_updated_content'];
    $article_title = $connection->real_escape_string($_POST['update_new_article_title']);
    $article_author = $connection->real_escape_string($_POST['update_new_article_author']);
    $article_id = $connection->real_escape_string($_POST['update_id_article']);
    
    // File Upload Process
    if (isset($_FILES['update_profile_image_arc']) && $_FILES['update_profile_image_arc']['error'] != UPLOAD_ERR_NO_FILE && isset($_FILES['update_content_image_arc']) && $_FILES['update_content_image_arc']['error'] != UPLOAD_ERR_NO_FILE) {
        // Set Target Path
        $targetFile1 = $filepath . basename($_FILES["update_profile_image_arc"]["name"]);
        $targetFile2 = $filepath . basename($_FILES["update_content_image_arc"]["name"]);
        
        // Moving files
        if (move_uploaded_file($_FILES["update_profile_image_arc"]["tmp_name"], $targetFile1) && move_uploaded_file($_FILES["update_content_image_arc"]["tmp_name"], $targetFile2)) {
            // Target File names for saving into database
            $imagefilename1 = $_FILES['update_profile_image_arc']['name'];
            $imagefilename2 = $_FILES['update_content_image_arc']['name'];
            
            // Process Into MySQL
            $sql = "UPDATE health_wellness_arc SET hwarticle_title=?, hwarticle_image=?, hwarticle_image_content=?, hwarticle_content=?, hwarticle_author=? WHERE hwarticle_id=?";
            
            // Prepare and bind parameters
            if ($stmt = $connection->prepare($sql)) {
                $stmt->bind_param("sssssi", $article_title, $imagefilename1, $imagefilename2, $article_content, $article_author, $article_id);
                
                // Execute the statement
                if ($stmt->execute()) {
                    $addarticlenotif['success1'] = true;
                    $addarticlenotif['message'] = 'Article updated successfully.';
                } else {
                    $addarticlenotif['message'] = 'Failed to update article: ' . $stmt->error;
                }
                
                // Close statement
                $stmt->close();
            } else {
                $addarticlenotif['message'] = 'Failed to prepare statement: ' . $connection->error;
            }
        } else {
            $addarticlenotif['message'] = 'Failed to move uploaded files.';
        }
    } else {
        // Process Into MySQL without file upload
        $sql = "UPDATE health_wellness_arc SET hwarticle_title=?, hwarticle_content=?, hwarticle_author=? WHERE hwarticle_id=?";
        
        // Prepare and bind parameters
        if ($stmt = $connection->prepare($sql)) {
            $stmt->bind_param("sssi", $article_title, $article_content, $article_author, $article_id);
            
            // Execute the statement
            if ($stmt->execute()) {
                $addarticlenotif['success1'] = true;
                $addarticlenotif['message'] = 'Article updated successfully.';
            } else {
                $addarticlenotif['message'] = 'Failed to update article: ' . $stmt->error;
            }
            
            // Close statement
            $stmt->close();
        } else {
            $addarticlenotif['message'] = 'Failed to prepare statement: ' . $connection->error;
        }
    }
    
    // Close connection
    $connection->close();
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode(['result' => $addarticlenotif]);

?>
