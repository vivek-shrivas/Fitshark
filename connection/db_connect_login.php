<?php
session_start(); // Start the session

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitstart";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare and execute the SQL statement
    $sql = "SELECT c_id, c_email, c_password FROM customer WHERE c_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result(); // Store the result for num_rows check
    $stmt->bind_result($c_id, $storedEmail, $storedPassword);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && $storedPassword === $password) {
        $_SESSION["user_email"] = $email; // Set session data
        $_SESSION["user_id"] = $c_id; // Set user ID session data
        header("Content-Type: application/json"); // Set response content type
        echo json_encode(array("login_success" => true)); // Send JSON response indicating success
    } else {
        header("Content-Type: application/json"); // Set response content type
        echo json_encode(array("login_success" => false, "message" => "Incorrect email or password."));
    }

    $stmt->close();

    exit; // Stop further script execution
} else {
    header("Location: index.php"); // Redirect if accessed directly
}

$conn->close();
