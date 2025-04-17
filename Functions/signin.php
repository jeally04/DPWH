<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username === "admin" && $password === "admin") {
            $_SESSION['loggedin'] = true;
            $response = array('success' => true, 'message' => 'Login successful. Redirecting to home page.');
        } else {
            $response = array('success' => false, 'message' => 'Incorrect username or password.');
        }
    } else {
        $response = array('success' => false, 'message' => 'Username or password field is missing.');
    }
    echo json_encode($response);
    exit();
}
