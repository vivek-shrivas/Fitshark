<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Replace with your actual database connection code
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'fitstart';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $category_id = $_POST['category_id'];
    $discount = $_POST['discount_percent'];

    // Insert product information
    $insert_query = "INSERT INTO product (product_name, product_description, product_price, category_id)
    VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $insert_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssdi", $product_name, $product_description, $product_price, $category_id);

        if (mysqli_stmt_execute($stmt)) {
            $product_id = mysqli_insert_id($conn);

            // Get selected image filenames
            if (isset($_FILES["images"]["name"])) {
                $selected_filenames = $_FILES["images"]["name"];
                foreach ($selected_filenames as $filename) {
                    // Insert image filename into the product_image table
                    $image_insert_query = "INSERT INTO product_image (product_id, image_url) VALUES (?, ?)";
                    $stmt_image = mysqli_prepare($conn, $image_insert_query);
                    mysqli_stmt_bind_param($stmt_image, "is", $product_id, $filename);
                    mysqli_stmt_execute($stmt_image);
                }
            }

            // Insert discount information
            $discount_insert_query = "INSERT INTO discount (product_id, discount_percent) VALUES (?, ?)";
            $stmt_discount = mysqli_prepare($conn, $discount_insert_query);
            mysqli_stmt_bind_param($stmt_discount, "id", $product_id, $discount);
            mysqli_stmt_execute($stmt_discount);

            // Handle selected sizes
            if (isset($_POST["sizes"])) {
                $selected_sizes = $_POST["sizes"];
                foreach ($selected_sizes as $size_id) {
                    // Insert size information into product_sizes table
                    $size_insert_query = "INSERT INTO product_sizes (product_id, size_id) VALUES (?, ?)";
                    $stmt_size = mysqli_prepare($conn, $size_insert_query);
                    mysqli_stmt_bind_param($stmt_size, "ii", $product_id, $size_id);
                    mysqli_stmt_execute($stmt_size);
                }
            }

            // Product successfully added
            echo "Product added successfully!";
        } else {
            // Failed to execute the prepared statement
            echo "Error: " . mysqli_error($conn);
        }

        // Close prepared statements
        mysqli_stmt_close($stmt);
    } else {
        // Failed to prepare the statement
        echo "Error: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
