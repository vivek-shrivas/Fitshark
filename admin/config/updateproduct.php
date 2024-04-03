<?php
if (isset($_POST['product_id'])) {
    // Get the product ID from the POST data
    $product_id = $_POST['product_id'];
    $product_id = 12;
    // Replace with your actual database connection code
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'fitstart';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Fetch product details based on the product ID
    $product_query = "SELECT * FROM products WHERE product_id = $product_id";
    $product_result = mysqli_query($conn, $product_query);

    if ($product_result && mysqli_num_rows($product_result) > 0) {
        $product_details = mysqli_fetch_assoc($product_result);

        // Populate the form fields with the retrieved product details
        $product_name = $product_details['product_name'];
        $product_description = $product_details['product_description'];
        $product_price = $product_details['product_price'];
        $category_id = $product_details['category_id'];

        // Fetch sizes for the product from the product_sizes table
        $sizes_query = "SELECT s.size_id, s.size_name FROM sizes s 
                        INNER JOIN product_sizes ps ON s.size_id = ps.size_id
                        WHERE ps.product_id = $product_id";
        $sizes_result = mysqli_query($conn, $sizes_query);

        $selected_sizes = array();
        while ($row = mysqli_fetch_assoc($sizes_result)) {
            $selected_sizes[] = $row;
        }

        // Fetch discount information from the discount table
        $discount_query = "SELECT discount_percent FROM discount WHERE product_id = $product_id";
        $discount_result = mysqli_query($conn, $discount_query);

        if ($discount_result && mysqli_num_rows($discount_result) > 0) {
            $discount_details = mysqli_fetch_assoc($discount_result);
            $discount_percent = $discount_details['discount_percent'];
        } else {
            $discount_percent = ''; // Handle the case where there's no discount information
        }

        // Other details like images can also be fetched similarly

        // Close the database connection
        mysqli_close($conn);
    } else {
        // Product not found, handle the error as needed
    }
} else {
    // Handle the case where product_id is not set in POST data
    echo "Product ID is not set in POST data.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
</head>

<body>

    <div class="overlay" id="form-overlay" onclick="closeAddProductForm()"></div>
    <form action="config\add.php" method="POST" enctype="multipart/form-data" id="form-updt">
        <!-- Add a hidden input field for the product ID -->
        <input type="hidden" id="product_id" name="product_id" value="<?php echo isset($_POST['product_id']) ? $_POST['product_id'] : ''; ?>">

        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required value="<?php echo isset($product_name) ? $product_name : ''; ?>"><br><br>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" required><?php echo isset($product_description) ? $product_description : ''; ?></textarea><br><br>

        <label for="product_price">Product Price:</label>
        <input type="number" id="product_price" name="product_price" required value="<?php echo isset($product_price) ? $product_price : ''; ?>"><br><br>

        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            <!-- Options for categories can be populated as you did before -->
        </select><br><br>

        <label for="discount">Discount (%)</label>
        <input type="number" class="form-control" id="discount_percent" name="discount_percent" placeholder="Enter discount percentage" value="<?php echo isset($discount_percent) ? $discount_percent : ''; ?>"><br><br>

        <label>Select Sizes:</label><br>
        <div class="checkbox-group">
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

            // Fetch sizes from the sizes table
            $sizes_query = "SELECT size_id, size_name FROM sizes";
            $sizes_result = mysqli_query($conn, $sizes_query);

            while ($row = mysqli_fetch_assoc($sizes_result)) {
                $size_id = $row['size_id'];
                $checked = in_array($size_id, array_column($selected_sizes, 'size_id')) ? 'checked' : '';
                echo '<div style="margin-left:10px" class="checkbox-item">';
                echo '<input type="checkbox" id="size_' . $size_id . '" name="sizes[]" value="' . $size_id . '" ' . $checked . '>';
                echo '<label for="size_' . $size_id . '">' . $row['size_name'] . '</label>';
                echo '</div>';
            }

            mysqli_close($conn);
            ?>
        </div>

        <label for="images">Product Images</label>
        <input type="file" id="images" name="images[]" accept="image/*" multiple required onchange="showSelectedFiles()">
        <div id="selected-images" class="selected-images"></div>

        <button type="submit" style="margin-top: 10px;">Add Product</button>
        <button type="button" onclick="closeAddProductForm()">Cancel</button>
    </form>

</body>

</html>