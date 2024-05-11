<?php
require_once 'config.php';
session_start();

class Login {
    private $db;

    public function __construct(){
        $this->db = new Config();
    }

    public function login($username, $password){
        $connection = $this->db->getConnection();
        $loginResult = ['success' => false, 'message' => ''];

        $sql = "SELECT * FROM `counselling_mentors` WHERE username='$username' or email_address='$username'";
        $stmt = $connection->query($sql);

        if ($stmt->num_rows > 0) {
            $row = $stmt->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['cm_id'] = $row['cm_id'];
                $_SESSION['service_id'] = $row['service_id'];
                $loginResult['success'] = true;
                $loginResult['message'] = 'Login successful.';
            } else {
                // Handle incorrect password
                $loginResult['message'] = 'Wrong Password! Please Try Again';
            }
        } else {
            // Handle user not found
            $loginResult['message'] = 'User does not exist';
        }

        return $loginResult;
    }
}
?>
