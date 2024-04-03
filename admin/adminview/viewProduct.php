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
$sql = "SELECT p.*, c.category_id, c.category_name, pi.image_url, d.discount_percent,
        GROUP_CONCAT(DISTINCT s.size_name ORDER BY s.size_name ASC) AS available_sizes
        FROM product p
        LEFT JOIN category c ON p.category_id = c.category_id
        LEFT JOIN product_image pi ON p.product_id = pi.product_id
        LEFT JOIN discount d ON p.product_id = d.product_id
        LEFT JOIN product_sizes ps ON p.product_id = ps.product_id
        LEFT JOIN sizes s ON ps.size_id = s.size_id
        WHERE p.is_deleted = 0  
        GROUP BY p.product_id";
$result = mysqli_query($conn, $sql);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $product_id = $row['product_id'];
    if (!isset($products[$product_id])) {
        $products[$product_id] = [
            'category_id' => $row['category_id'],
            'category_name' => $row['category_name'],
            'product_id' => $row['product_id'],
            'product_name' => $row['product_name'],
            'images' => [],
            'discount_percent' => $row['discount_percent'],
            'product_price' => $row['product_price'],
            'available_sizes' => $row['available_sizes']
        ];
    }

    if ($row['image_url']) {
        $products[$product_id]['images'][] = $row['image_url'];
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... (Head section remains the same) -->
</head>

<body>

    <div class="container" style="min-width: 1600px">
        <button id="add-product-button" onclick="showAddProductForm()">Add Product</button>
        <div class="overlay" id="form-overlay">
            <?php include '../config/addProductform.php'; ?>

        </div>
        <h1 class="text-center my-4">Product Information</h1>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Category Name</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Images</th>
                            <th>Discount percent (%)</th>
                            <th>Product Price</th>
                            <th>Available Sizes</th>
                            <th>Discounted Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td><?php echo $product['category_id']; ?></td>
                                <td><?php echo $product['category_name']; ?></td>
                                <td><?php echo $product['product_id']; ?></td>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php foreach ($product['images'] as $image) : ?>
                                        <img src="../uploads/<?php echo $image; ?>" alt="Product Image" style="height: 50px; margin-right: 10px;">
                                    <?php endforeach; ?>

                                </td>
                                <td><?php echo $product['discount_percent']; ?></td>
                                <td><?php echo $product['product_price']; ?></td>
                                <td><?php echo $product['available_sizes']; ?></td>
                                <td>
                                    <?php
                                    $discounted_price = $product['product_price'] * (1 - $product['discount_percent'] / 100);
                                    echo number_format($discounted_price, 2);
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </script>

    </script>
</body>

</html>