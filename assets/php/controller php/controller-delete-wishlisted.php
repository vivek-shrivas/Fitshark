<?php
session_start();

if (isset($_SESSION["user_id"]) && isset($_POST["productId"])) {
    // Database connection parameters
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'fitstart';

    // Establish a database connection
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Get the customer_id (user_id) from the session
    $customerId = $_SESSION["user_id"];

    // Sanitize and get the productId from the POST data
    $productId = mysqli_real_escape_string($conn, $_POST["productId"]);
    error_log("Customer ID (user ID): " . $customerId);

    // Delete the product from the wishlist table
    $sql = "DELETE FROM wishlist WHERE c_id = $customerId AND product_id = $productId";

    if (mysqli_query($conn, $sql)) {
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
