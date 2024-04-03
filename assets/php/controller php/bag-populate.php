<?php
// Database connection setup (replace with your credentials)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cart data from the database (replace with your query)
$sql = "SELECT product_name, product_description, product_price, image_url FROM your_cart_table";
$result = $conn->query($sql);

// Prepare an array to store cart data
$cartData = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cartData[] = $row;
    }
}

// Close the database connection
$conn->close();

// Send the cart data as JSON response
header('Content-Type: application/json');
echo json_encode($cartData);
