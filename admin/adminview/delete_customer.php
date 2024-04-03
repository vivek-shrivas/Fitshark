<?php
// Connect to the database (Replace with your database credentials)
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'fitstart';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get the customer ID to be deleted from the AJAX request
if (isset($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];

    // Perform the delete operation
    $sql = "DELETE FROM `customer` WHERE `c_id` = $customer_id";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request";
}

// Close the database connection
mysqli_close($conn);
?>
