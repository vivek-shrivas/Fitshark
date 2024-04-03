<?php
// Replace with your actual database connection code
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'fitstart';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Update the is_deleted value to TRUE for the specified product
    $update_query = "UPDATE product SET is_deleted = TRUE WHERE product_id = $product_id";
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        echo "Product marked as deleted.";
    } else {
        echo "Error marking product as deleted: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
