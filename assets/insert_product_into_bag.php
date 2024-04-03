<?php
// Start a session to access session variables (if not already started)
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the data sent via AJAX
    $product_id = $_POST['product_id'];
    $size_id = $_POST['size_id']; // Expecting size_id
    $quantity = $_POST['quantity'];

    // Check if user is logged in and has a valid session
    if (isset($_SESSION["user_id"])) {
        // Get the customer ID from the session
        $customer_id = $_SESSION["user_id"];

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

        // Check if the selected size_id exists in the product_sizes table
        $check_size_sql = "SELECT product_size_id FROM product_sizes WHERE product_id = ? AND size_id = ?";
        $check_size_stmt = $conn->prepare($check_size_sql);
        $check_size_stmt->bind_param("ii", $product_id, $size_id);
        $check_size_stmt->execute();
        $check_size_result = $check_size_stmt->get_result();

        if ($check_size_result->num_rows > 0) {
            // The selected size_id exists for the given product_id, proceed with insertion
            $insert_sql = "INSERT INTO bag (c_id, product_id, size_id, quantity)
                           VALUES (?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("iiii", $customer_id, $product_id, $size_id, $quantity);

            // Execute the insert statement
            if ($insert_stmt->execute()) {
                echo 'success';
            } else {
                echo 'Error: ' . $insert_stmt->error;
            }

            // Close the insert statement
            $insert_stmt->close();
        } else {
            echo 'select size to continue to add to cart';
        }

        // Close the check size statement
        $check_size_stmt->close();

        // Close the database connection
        $conn->close();
    } else {
        echo 'User is not logged in.';
    }
}
