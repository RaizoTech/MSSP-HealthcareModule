<?php

require_once 'config.php';

$config = new config();
$connection = $config->getConnection();

$deleteResponse = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['article_id'])) {
    // Sanitize the input
    $articleId = $connection->real_escape_string($_POST['article_id']);
    
    // Prepare and execute the delete query
    $sql = "DELETE FROM health_wellness_arc WHERE hwarticle_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $articleId);
    
    if ($stmt->execute()) {
        $deleteResponse['success'] = true;
        $deleteResponse['message'] = 'Article deleted successfully.';
    } else {
        $deleteResponse['message'] = 'Failed to delete article.';
    }
    
    // Close the statement
    $stmt->close();
}

// Close the connection
$connection->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode(['result' => $deleteResponse]);

?>
