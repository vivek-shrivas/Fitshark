<?php
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

// Check if the product_id is sent via POST
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Prepare and execute the SQL query to fetch sizes based on the product_id
    $size_sql = "SELECT s.size_id, s.size_name
                 FROM sizes s
                 INNER JOIN product_sizes ps ON s.size_id = ps.size_id
                 WHERE ps.product_id = ?";
    $size_stmt = $conn->prepare($size_sql);
    $size_stmt->bind_param("i", $product_id);
    $size_stmt->execute();
    $size_result = $size_stmt->get_result();

    $size_options = array();

    // Fetch sizes and build an array of size options
    while ($size_row = $size_result->fetch_assoc()) {
        $size_id = $size_row["size_id"];
        $size_name = $size_row["size_name"];
        $size_options[] = array('size_id' => $size_id, 'size_name' => $size_name);
    }

    // Convert the array to JSON and echo it
    echo json_encode($size_options);
} else {
    // Handle the case where product_id is not provided
    echo 'Product ID is missing.';
}

// Close the database connection
$conn->close();
?>
