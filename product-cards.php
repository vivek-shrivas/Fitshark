

<?php
session_start(); // Start the session
$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "fitstart";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo '<div class="product-card-container">';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in
    // Fetch product information and discounts
    $sql = "SELECT p.product_id, p.product_name, p.product_description, p.product_price, d.discount_percent
                    FROM product AS p
                    LEFT JOIN discount AS d ON p.product_id = d.product_id";

    // Fetch wishlist data for the logged-in user
    $user_id = $_SESSION['user_id'];
    $wishlist_sql = "SELECT product_id FROM wishlist WHERE c_id = $user_id";
    $wishlist_result = $conn->query($wishlist_sql);
    $wishlist_products = [];

    if ($wishlist_result->num_rows > 0) {
        while ($wishlist_row = $wishlist_result->fetch_assoc()) {
            $wishlist_products[] = $wishlist_row["product_id"];
        }
    }
} else {
    // User is not logged in
    // Fetch product information and discounts only
    $sql = "SELECT p.product_id, p.product_name, p.product_description, p.product_price, d.discount_percent
                    FROM product AS p
                    LEFT JOIN discount AS d ON p.product_id = d.product_id";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $product_id = $row["product_id"];
        $product_name = $row["product_name"];
        $product_description = $row["product_description"];
        $product_price = $row["product_price"];
        $discount_percent = $row["discount_percent"];

        // Start a new product card
        echo '<div class="product-card" onmouseover="startImageChange(this)" onmouseout="stopImageChange(this)">';

        // Wishlist icon placed in the top right corner with padding
        // SVG for wishlist icon with a condition to change fill color to red if wishlisted and user is logged in
        if (isset($_SESSION['user_id']) && in_array($product_id, $wishlist_products)) {
            echo '<div class="legacy-wishlist-icon"  data-product-id="' . $product_id . '" onclick="addToWishlist(this)">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">';
            echo '<path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />';
            echo '</svg>';
            echo '</div>';
        } else {
            echo '<div class="legacy-wishlist-icon"  data-product-id="' . $product_id . '" onclick="addToWishlist(this)">';
            echo '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="grey" class="bi bi-heart-fill" viewBox="0 0 16 16">';
            echo '<path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />';
            echo '</svg>';
            echo '</div>';
        }


        // Product image container
        echo '<div class="l-product-image-container">';

        // Fetch and display images for this product
        $image_sql = "SELECT image_url FROM product_image WHERE product_id = $product_id AND is_deleted = FALSE";
        $image_result = $conn->query($image_sql);

        if ($image_result->num_rows > 0) {
            while ($image_row = $image_result->fetch_assoc()) {
                $image_url = $image_row["image_url"];
                echo '<img class="l-product-image" src="uploads/' . $image_url . '" alt="Product Image" />';
            }
        }

        // Close the product image container
        echo '</div>';


        // Close t


        // Assuming you have fetched the product_price and discount_percent from the database
        $product_price = $row["product_price"];
        $discount_percent = $row["discount_percent"];

        // Calculate the discounted price
        $discounted_price = $product_price - ($product_price * ($discount_percent / 100));

        // Product name, description, price, and discount
        echo '<div class="product-name">' . $product_name . '</div>';
        echo '<div class="product-description">' . $product_description . '</div>';
        echo '<div class="price-container">';
        echo '<div class="product-price price">₹' . number_format($discounted_price, 2) . '</div>';
        echo '<div class="l-mrp" style="text-decoration: line-through;">₹' . number_format($product_price, 2) . '</div>';
        echo '<div class="discount">' . $discount_percent . '% OFF</div>';
        echo '</div>'; // Close price container
        echo '</div>';
    }

    echo '</div>';
} else {
    echo "No products found.";
}

echo '</div>';
$conn->close();
