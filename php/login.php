<?php
require_once 'config.php';
session_start();
date_default_timezone_set('Asia/Manila');

class Login {
    private $db;

    public function __construct(){
        $this->db = new Config();
    }

    public function login($username, $password){
        $connection = $this->db->getConnection();
        $loginResult = ['success' => false, 'message' => ''];

        // SQL Injection Prevention: Use prepared statements
        //$stmt = $connection->prepare("SELECT * FROM user_credentials WHERE username=? OR email=?");
        //$stmt->bind_param("ss", $username, $username);
        //$stmt->execute();
        //$result = $stmt->get_result();

        $sql = "SELECT * FROM user_credentials WHERE username='$username' OR email='$username'";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['emp_id'] = $row['employee_code'];
                
                $loginResult['success'] = true;
                $loginResult['message'] = 'Login successful.';
                // end attendance
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