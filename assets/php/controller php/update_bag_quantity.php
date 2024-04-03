<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Password is empty
$dbname = "fitstart";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product_id and qty from the POST request
if (isset($_POST["product_id"]) && isset($_POST["qty"])) {
    $productId = $_POST["product_id"];
    $newQty = $_POST["qty"];

    // Update the quantity in the bag table
    $sql = "UPDATE bag SET quantity = $newQty WHERE product_id = $productId";

    if ($conn->query($sql) === TRUE) {
        // Quantity updated successfully
        echo "Quantity updated successfully.";
    } else {
        // Error updating quantity
        echo "Error: " . $conn->error;
    }
} else {
    // Invalid request
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
