<?php
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ''; // Change this to your database password
$dbname = "fitstart"; // Change this to your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_name = $_POST["c_name"];
    $c_email = $_POST["c_email"];
    $c_phone_no = $_POST["c_phone_no"];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO customer (c_name, c_email, c_phone_no) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $c_name, $c_email, $c_phone_no);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
