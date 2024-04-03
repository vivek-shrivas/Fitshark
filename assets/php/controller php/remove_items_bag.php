<?php
session_start(); // Start the session

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

// Check if the c_id session variable is set
if (isset($_SESSION["user_id"])) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get selected product IDs from the AJAX request
        $selectedProductIds = $_POST["selectedProductIds"];

        // Ensure user ID and product IDs are valid (you might want to add more validation)
        $userID = $_SESSION["user_id"];

        // Remove selected products from the bag table
        foreach ($selectedProductIds as $productId) {
            $sql = "DELETE FROM bag WHERE product_id = $productId AND c_id = $userID";

            if ($conn->query($sql) !== TRUE) {
                echo "Error deleting product: " . $conn->error;
                exit();
            }
        }

        // Echo "success" when products are successfully removed
        echo "success";
    } else {
        // Handle non-POST requests (if necessary)
        echo "Invalid request method";
    }
}

// Close the database connection
mysqli_close($conn);
