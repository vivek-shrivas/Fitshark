<?php
session_start(); // Start the session

if (isset($_SESSION['user_id'])) {
    // User is logged in, proceed with adding to the wishlist
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve the product_id from the POST request
        $product_id = $_POST["product_id"];
        $c_id = $_SESSION['user_id'];

        // Database connection settings
        $servername = "localhost";
        $username = "root";
        $password = ""; // Assuming there is no password
        $dbname = "fitstart";

        // Create a new MySQLi connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the database connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert product_id into the "wishlist" table
        $insert_query = "INSERT INTO wishlist (c_id, product_id) VALUES (?, ?)";

        // Prepare and execute the statement
        if ($stmt = $conn->prepare($insert_query)) {
            $stmt->bind_param("ii", $c_id, $product_id);

            if ($stmt->execute()) {
                echo "success"; // Product added to the wishlist successfully
            } else {
                echo "failure"; // Failed to add the product to the wishlist
            }

            $stmt->close();
        } else {
            echo "failure"; // Failed to add the product to the wishlist
        }

        // Close the database connection
        $conn->close();
    }
} else {
    // User is not logged in, redirect to a different page
    header("Location: login.php"); // Change "login.php" to the page you want to redirect to
    exit(); // Terminate the script to ensure redirection
}
