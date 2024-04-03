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

if (isset($_POST['category_id'])) {
    $selectedCategoryId = $_POST['category_id'];

    // Fetch subcategories based on the selected category
    $subcategory_query = "SELECT sub_cat_id, sub_cat_name FROM subcategory WHERE category_id = $selectedCategoryId AND is_deleted = 0";
    $subcategory_result = mysqli_query($conn, $subcategory_query);

    $subcategories = array();

    while ($row = mysqli_fetch_assoc($subcategory_result)) {
        $subcategories[$row['sub_cat_id']] = $row['sub_cat_name'];
    }

    // Return subcategories as JSON
    echo json_encode($subcategories);
}

mysqli_close($conn);
