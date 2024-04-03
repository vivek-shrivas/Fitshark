<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION["user_id"])) {
    // Initialize your database connection parameters
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'fitstart';

    // Create a database connection
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $customerId = $_SESSION["user_id"];

    // Modify the SQL query to fetch the product count for the specific customer
    $sql = "SELECT COUNT(*) AS productCount FROM wishlist WHERE c_id = $customerId";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $productCount = $row['productCount'];
        
        // Return the product count as a response
        echo trim($productCount);
    } else {
        echo "0"; // Return 0 if there are no items in the wishlist or an error occurs
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "0"; // Return 0 if the user is not logged in
}
