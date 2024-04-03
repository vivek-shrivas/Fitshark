<head>
    <title>Fitstart.wishlist</title>
    <link rel="icon" href="assets\images\favicon\favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="assets\images\favicon\favicon.ico" type="image/x-icon">
</head>
<style>
    * {
        font-family: "Segoe UI", "Helvetica Neue", Arial, sans-serif;
        text-decoration: none;
        text-decoration-line: none;
        padding: 0%;
        margin: 0%;
    }

    .not-wishlist-cnt {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: block;
        padding-top: 20vh;
        padding-bottom: 20vh;
    }

    .centered-div-not-login-wishlist {
        text-align: center;
        margin-bottom: 20vh;
    }

    .not-logged-in-container {
        display: block;
        overflow-x: hidden;
    }

    .not-login-container {
        text-align: center;
    }

    .not-login-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 3vh;
    }

    .not-login-description {
        margin-bottom: 5vh;
        font-size: 1rem;
        color: #666;
        margin-top: 10px;
    }

    .not-login-button {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 1px solid #1D85FC;
        border-radius: 5px;
        background-color: white;
        color: #1D85FC;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        text-decoration: none;
        display: block;
        margin-top: 7vh;
        margin-left: 47.5vw;
        width: fit-content;
    }

    .not-login-button:hover {
        background-color: #1D85FC;
        color: #fff;
    }

    .not-wishlist-image {
        margin-top: 20px;
        max-width: 100px;
    }

    .wishlist-text-top {
        margin-left: 10rem;
    }

    .wishlist-card-cnt {
        margin: 5rem 10rem;
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: flex-start;
    }

    .card {
        max-width: 220px;
        height: fit-content;
        text-align: left;
        font-family: arial;
        position: relative;
    }

    .card h6,
    .card p {
        padding-left: 1rem;
    }

    .price {
        color: grey;
        font-size: 17px;
    }

    .card button {
        border-top: 0.5px solid grey;
        border-bottom: 0.5px solid grey;
        border-left: none;
        border-right: none;
        outline: 0;
        padding: 12px;
        color: red;
        background-color: white;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 12px;
    }

    .card button:hover {
        opacity: 0.7;
    }

    .delete-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 25px;
        height: 25px;
        cursor: pointer;
    }

    .popup {
        display: none;
        position: fixed;
        top: 150px;
        right: 0;
        width: 250px;
        height: 70px;
        background-color: #3b1b5c;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        animation: slideInFromRight 0.3s ease-in-out;
        /* Apply the animation */
    }

    @keyframes slideInFromRight {
        from {
            right: -250px;
            /* Start position (completely outside the screen) */
        }

        to {
            right: 10;
            /* End position (fully visible on the right side) */
        }
    }

    .popup-content-wishlist {
        display: flex;
        padding: 10px;
        text-align: center;
    }

    #removed-product-image {
        max-height: 50px;
        width: 50px;
        /* Adjust the height as needed */
        margin-bottom: 10px;
    }

    #removed-product-message {
        padding: 5px;
        font-size: 0.7rem;
        color: white;
        font-weight: bolder;
    }
</style>


<?php
session_start(); // Start the session
// Check if the user is logged in
if (isset($_SESSION["user_id"])) {
    // ... Database connection and product fetching code
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'fitstart';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $customerId = $_SESSION["user_id"];

    // Modify the SQL query to fetch products that belong to the same user_id
    $sql = "SELECT w.product_id, p.product_name, p.product_price, p.product_description, i.image_url
    FROM wishlist AS w
    JOIN product AS p ON w.product_id = p.product_id
    JOIN (
        SELECT product_id, MIN(image_url) AS image_url
        FROM product_image
        GROUP BY product_id
    ) AS i ON w.product_id = i.product_id
    WHERE w.c_id = $customerId;
    ";

    $result = mysqli_query($conn, $sql);

    // Count the number of items in the wishlist
    $itemCount = mysqli_num_rows($result);

    // Display the count in the wishlist text
    echo '<div class="wishlist-text-top">';
    echo '<h5>My Wishlist (' . $itemCount . ' items)</h5>';
    echo '</div>';

    echo '<div class="wishlist-card-cnt" style="min-height:90vh"> ';
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productId = $row['product_id'];

            // ... Fetch product details and image URL
            $productName = $row['product_name'];
            $productPrice = $row['product_price'];
            $productDescription = $row['product_description'];
            $imageUrl = $row['image_url'];

            // Output the product card with the delete icon
            echo '<div class="card" id="product_' . $productId . '">';
            echo '<img src="uploads/' . $imageUrl . '" alt="' . $productName . '" style="width:100%">';
            echo '<img class="delete-icon" src="assets/php/images/icons/icons8-cross-26.png" alt="Delete Icon" onclick="deleteProduct(' . $productId . ')">';
            echo '<h6>' . $productName . '</h6>';
            echo '<p class="price">Rs' . number_format($productPrice, 2) . '</p>';
            echo '<button onclick="moveToBag(' . $productId . ')">MOVE TO BAG</button>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "Error fetching wishlist: " . mysqli_error($conn);
    }
    echo ' <div class="popup" id="wishlist-popup">';
    echo '<div class="popup-content-wishlist">';
    echo '<img src="" alt="Product Removed" id="removed-product-image">';
    echo '<p id="removed-product-message">Removed from wishlist</p>';
    echo '</div>';
    echo '</div>';

    mysqli_close($conn);
    exit();
}
?>

<div class="not-logged-in-container">
    <div class="not-wishlist-cnt">
        <div class="centered-div-not-login-wishlist">
            <div class="not-login-title">PLEASE LOG IN</div>
            <div class="not-login-description">Login to view items in your wishlist</div>
            <img src="assets\php\images\wishlist\wishlist.png" alt='Empty Wishlist' class='not-wishlist-image'>
        </div>
    </div>
</div>