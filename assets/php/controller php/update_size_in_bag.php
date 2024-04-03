<?php
// update_size_in_bag.php

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the POST data
    $productId = $_POST["productId"];
    $newSizeId = $_POST["newSizeId"];
    $customerId = $_POST["customerId"];
    $initialSize = $_POST["initialSize"];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fitstart";

    // Create a new MySQLi connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL update query to change the size_id in the bag table
    $sqlUpdateSize = "UPDATE bag SET size_id = ? WHERE product_id = ? AND c_id = ? AND size_id = ?";
    $stmt = $conn->prepare($sqlUpdateSize);
    $stmt->bind_param("iiii", $newSizeId, $productId, $customerId, $initialSize);

    if ($stmt->execute()) {
        echo "Size updated successfully!";
    } else {
        echo "Error updating size: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Handle invalid request method
    echo "Invalid request method.";
}
