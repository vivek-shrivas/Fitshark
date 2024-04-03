<?php
session_start(); // Start the session

// Database configuration (modify as needed)
$servername = "localhost";
$username = "root";
$password = ""; // You mentioned password is empty
$dbname = "fitstart";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the c_id session variable is set
if (isset($_SESSION["user_id"])) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get selected product IDs from the AJAX request
        $selectedProductIds = $_POST["productIds"];

        // Ensure user ID and product IDs are valid (you might want to add more validation)
        $userID = $_SESSION["user_id"];

        // Insert selected products into the wishlist table
        foreach ($selectedProductIds as $productId) {
            $sqlInsertWishlist = "INSERT INTO wishlist (c_id, product_id) VALUES ($userID, $productId)";
            if ($conn->query($sqlInsertWishlist) !== TRUE) {
                echo "Error moving product to wishlist: " . $conn->error;
                exit();
            }

            // After moving to wishlist, remove the product from the bag
            $sqlRemoveFromBag = "DELETE FROM bag WHERE product_id = $productId AND c_id = $userID";
            if ($conn->query($sqlRemoveFromBag) !== TRUE) {
                echo "Error removing product from bag: " . $conn->error;
                exit();
            }
        }

        // Return a success message or any other response as needed
        echo "success";
    } else {
        // Handle non-POST requests (if necessary)
        echo "Invalid request method";
    }
}

// Close the database connection
mysqli_close($conn);
