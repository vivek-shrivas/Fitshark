<?php
session_start(); // Start the session

// Check if the user is logged in (adjust this condition as needed)
if (!isset($_SESSION["user_id"])) {
    die("You are not logged in.");
}

// Database configuration (modify as needed)
$servername = "localhost";
$username = "root";
$password = ""; // You mentioned the password is empty
$dbname = "fitstart";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from the session
$userID = $_SESSION["user_id"];

// Get JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Check if JSON data is valid
if ($data === null) {
    echo "error";
    exit; // Exit the script
}

// Get form data from the decoded JSON
$name = $data["name"];
$email = $data["email"];
$phone = $data["phone"];
$address1 = $data["address1"];
$address2 = $data["address2"];
$city = $data["city"];
$state = $data["state"];
$postalCode = $data["postal_code"];

// Update user information
$updateUserQuery = "UPDATE customer SET c_name='$name', c_email='$email', c_phone_no='$phone' WHERE c_id=$userID";

if ($conn->query($updateUserQuery) === TRUE) {
    // User information updated successfully

    // Insert address into the c_address table
    $insertAddressQuery = "UPDATE c_address SET address_line1='$address1', address_line2='$address2', city='$city', state='$state', postal_code='$postalCode'  WHERE c_id=$userID";

    if ($conn->query($insertAddressQuery) === TRUE) {
        // Address added successfully
        echo "success"; // Send a simple "success" string as the response
    } else {
        echo "error";
    }
} else {
    echo "error";
}

// Close the database connection
$conn->close();
