<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION["user_id"])) {
    // Check if productId is provided in the POST request
    if (isset($_POST["productId"])) {
        // Get the customer ID from the session
        $customerId = $_SESSION["user_id"];

        // Get the productId from the POST data
        $productId = $_POST["productId"];

        // ... Database connection code

        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'fitstart';

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // Insert the product into the bag table
        $insertQuery = "INSERT INTO bag (c_id, product_id) VALUES ($customerId, $productId)";

        if (mysqli_query($conn, $insertQuery)) {
            // Product added to the bag successfully

            // Now, you can delete the product from the wishlist
            $deleteQuery = "DELETE FROM wishlist WHERE c_id = $customerId AND product_id = $productId";

            if (mysqli_query($conn, $deleteQuery)) {
                // Product removed from the wishlist successfully
                echo "Product moved to the bag successfully!";
            } else {
                echo "Error removing product from wishlist: " . mysqli_error($conn);
            }
        } else {
            echo "Error adding product to bag: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        echo "Product ID not provided in the request.";
    }
} else {
    echo "User is not logged in.";
}
