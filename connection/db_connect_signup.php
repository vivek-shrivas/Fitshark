<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($name) || empty($mobile) || empty($email) || empty($password)) {
        echo json_encode(['signup_success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $dbpassword = ""; // Assuming there is no password set for the root user, otherwise, provide the correct password
    $dbname = "fitstart";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the data into the "users" table
    $sql = "INSERT INTO customer (c_name, c_email, c_phone_no, c_password) VALUES ('$name', '$email', '$mobile', '$password')";

    if ($conn->query($sql) === true) {
        echo json_encode(['signup_success' => true]);
    } else {
        echo json_encode(['signup_success' => false, 'message' => 'Error in database operation.']);
    }

    // Close the database connection
    $conn->close();
}
