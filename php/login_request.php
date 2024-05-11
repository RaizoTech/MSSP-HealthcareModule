<?php
require 'login.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if form data is received
    if (isset($_POST['username_or_email']) && isset($_POST['password'])) {
        // Proceed with login logic
        $usernameOrEmail = $_POST['username_or_email'];
        $password = $_POST['password'];

        // Create login instance
        $logs = new Login();
        $loginResult = $logs->login($usernameOrEmail, $password);

        // Return login result
        echo json_encode(['result' => $loginResult]);
    } else {
        // Handle invalid form data
        echo json_encode(['error' => 'Form data not received.']);
    }
} else {
    // Handle invalid request method
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
