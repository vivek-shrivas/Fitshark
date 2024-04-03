<?php
// Replace with your actual database connection code
$db_host = 'localhost';
$db_user = 'your_db_user';
$db_pass = 'your_db_password';
$db_name = 'your_db_name';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if the category_id parameter is provided in the request
if (isset($_GET['category_id'])) {
    $category_id = intval($_GET['category_id']); // Sanitize and convert to integer

    // Query to fetch subcategories based on the selected category_id
    $subcategory_query = "SELECT sub_cat_id, sub_cat_name FROM subcategory WHERE category_id = $category_id AND is_deleted = 0";
    $subcategory_result = mysqli_query($conn, $subcategory_query);

    if ($subcategory_result) {
        $subcategories = array();

        while ($row = mysqli_fetch_assoc($subcategory_result)) {
            $subcategories[] = $row;
        }

        // Return subcategories as JSON
        header('Content-Type: application/json');
        echo json_encode($subcategories);
    } else {
        echo "Error fetching subcategories: " . mysqli_error($conn);
    }
} else {
    echo "category_id parameter is missing in the request.";
}

mysqli_close($conn);
