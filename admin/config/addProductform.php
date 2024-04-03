<!-- add product form  -->

<div class="overlay" id="form-overlay" onclick="closeAddProductForm()"></div>
<div class="form-container" id="form-cnt">
    <h1 class="form-title">Add Product</h1>
    <form action="config\add.php" method="POST" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br><br>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" required></textarea><br><br>

        <label for="product_price">Product Price:</label>
        <input type="number" id="product_price" name="product_price" required><br><br>

        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>

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

            // Fetch categories from the category table
            $category_query = "SELECT category_id, category_name FROM category";
            $category_result = mysqli_query($conn, $category_query);

            while ($row = mysqli_fetch_assoc($category_result)) {
                echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
            }

            mysqli_close($conn);
            ?>

            <br><br>
            <label for="discount">Discount (%)</label>
            <input type="number" class="form-control" id="discount_percent" name="discount_percent" placeholder="Enter discount percentage">


        </select><br><br>
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
                echo '<div style="margin-left:10px" class="checkbox-item">';
                echo '<input type="checkbox" id="size_' . $row['size_id'] . '" name="sizes[]" value="' . $row['size_id'] . '">';
                echo '<label for="size_' . $row['size_id'] . '">' . $row['size_name'] . '</label>';
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
</div>