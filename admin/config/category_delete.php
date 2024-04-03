<?php
// Include your database connection code
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'fitstart';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$success = false; // Default value

if (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];

    // Perform the update in the database
    $sql = "UPDATE category SET is_deleted = 1 WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $category_id);

    if ($stmt->execute()) {
        $success = true;
    }

    $stmt->close();
}

mysqli_close($conn);

echo json_encode(['success' => $success]);
