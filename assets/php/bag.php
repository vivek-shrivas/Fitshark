<?php

use function PHPSTORM_META\elementType;

session_start(); // Start the session

// Database configuration (modify as needed)
$servername = "localhost";
$username = "root";
$password = ""; // You mentioned password is empty
$dbname = "fitstart";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the c_id session variable is set
if (isset($_SESSION["user_id"])) {
    // Fetch user and address data (customize these SQL queries based on your DB structure)
    $userID = $_SESSION["user_id"];
    $sqlAddress = "SELECT c_address.address_line1, c_address.address_line2, c_address.city, c_address.state, c_address.postal_code, customer.c_name
    FROM c_address
    JOIN customer ON c_address.c_id = customer.c_id
    WHERE c_address.c_id = $userID";

    $addressResult = $conn->query($sqlAddress);
    $sqlbagItems = "SELECT
    COUNT(*) AS item_count,
    MAX(product.product_id) AS product_id,
    MAX(product.product_name) AS product_name,
    MAX(product.product_description) AS product_description,
    MAX(product.product_price) AS product_price,
    MAX(product_image.image_url) AS image_url,
    MAX(discount.discount_percent) AS discount_percent,
    MAX(bag.quantity) AS quantity
FROM product
JOIN product_image ON product.product_id = product_image.product_id
LEFT JOIN bag ON product.product_id = bag.product_id AND bag.c_id = $userID
LEFT JOIN discount ON product.product_id = discount.product_id
WHERE bag.product_id IS NOT NULL
GROUP BY product.product_id";

    $bagItemsResult = $conn->query($sqlbagItems);
    echo '<div class="cart-cnt" style="min-height:100vh">';
    echo '<div class="b-container">';
    if ($addressResult->num_rows > 0) {

        while ($row = $addressResult->fetch_assoc()) {
            echo '<div>';
            echo '<div class="address-card" style="min-width:700px">';
            echo '<div class="address">';
            echo '<div style="display: inline-flex; gap: 5px; margin: 0%; padding: 0%">';
            echo '<p>Deliver to: <strong>' . $row["c_name"] . '</strong></p>';
            echo '<p>, ' . $row["postal_code"] . '</p>';
            echo '</div>';
            echo '<div style="display: inline-flex;  margin: 0%; padding: 0%">';
            echo '<p>Address :' . $row["address_line1"] . ", " .  $row["address_line2"] . '</p>';
            echo '<p>,' . $row["city"] . '</p>';
            echo '<p> ,' . $row["state"] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '<button class="change-address-button" style="padding:6px; border: 1px solid red; color:red; onclick="updateAddressModal()">Change Address</button>';
            echo '</div>';
        }
    } else {
        echo '<div>';
        echo '<div class="address-card" style="min-width:700px">';
        echo '<div class="address">';
        echo '<div style="display: inline-flex; gap: 50px; margin: 0%; padding: 0%">';
        echo '<p>Add Address to continue to checkout<strong></strong></p>';
        echo '</div>';
        echo '<div style="display: inline-flex;  margin: 0%; padding: 0%">';
        echo '<p></p>';
        echo '<p></p>';
        echo '<p></p>';
        echo '</div>';
        echo '</div>';
        echo '<button style="padding:6px; border: 1px solid red; color:red; margin-left:100px;" onclick="openAddressModal()">Add Address</button>';
        echo '</div>';
    }

    echo '<div style="display: flex; flex-direction: row">';
    echo '<div class="checkbox-container">';
    echo '<input type="checkbox" class="select-all-checkbox" id="select-all" onclick="selectAllItems()"/>';
    echo '<label for="select-all">SELECT All</label>';
    $totalItemCount = $bagItemsResult->num_rows;
    echo '<span class="selected-items-count"  id="item-count">0</span><span id="total-item-count">/' . $totalItemCount . '</span><span>ITEMS SELECTED</span>';
    echo '</div>';
    echo '<div style="position: relative; margin-left: 7rem; padding-top: 13px">';
    echo '<a id="remove-selected" onclick="removeSelected()">REMOVE</a>';
    echo '<span>|</span>';
    echo '<a onclick="moveToWishlist()">MOVE TO WISHLIST</a>';
    echo '</div>';
    echo '</div>';

    if ($bagItemsResult->num_rows > 0) {
        while ($row = $bagItemsResult->fetch_assoc()) {
            echo '<div class="cart-item">';
            echo '<div class="product-image-container">';
            echo '<input type="checkbox" class="product-checkbox" onclick="updateItemCount(this)" data-product-id="' . $row["product_id"] . '" data-product-mrp="' . $row["product_price"] . '" data-product-discount="' . $row["discount_percent"] . '"-quantity="' . $row["quantity"] . '"" />';
            echo '<img class="product-image" src="./uploads/' . $row["image_url"] . '" alt="Product Image" />';
            echo '</div>';
            echo '<div class="product-details">';
            echo '<h3>' . $row["product_name"] . '</h3>';
            echo '<p>' . $row["product_description"] . '</p>';

            echo '<select class="quantity-select" onchange="updateQuantity(' . $row["product_id"] . ', this.value)">';
            for ($i = 1; $i <= 10; $i++) {
                $selected = ($i == $row["quantity"]) ? 'selected' : '';
                echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
            }
            echo '</select>';
            // Fetch the initial selected size from the bag table
            $productId = $row["product_id"];
            $customerId = $_SESSION["user_id"]; // Assuming you have the customer ID in the session
            $sqlInitialSize = "SELECT bs.size_id FROM bag AS bs
        WHERE bs.product_id = $productId 
        AND bs.c_id = $customerId";

            $initialSizeResult = $conn->query($sqlInitialSize);

            $initialSize = null;

            if ($initialSizeResult->num_rows > 0) {
                $initialSizeRow = $initialSizeResult->fetch_assoc();
                $initialSize = $initialSizeRow["size_id"];
            }

            // Display product sizes in a dropdown with the JavaScript for updating
            echo '<select id="size-select-' . $productId . '" class="quantity-select" onchange="updateSize(' . $productId . ', this, ' . $customerId . ', ' . $initialSize . ')" data-initial-size="' . $initialSize . '">';
            // Fetch and populate available sizes for the current product
            $sqlProductSizes = "SELECT ps.size_id, s.size_name FROM product_sizes AS ps
        JOIN sizes AS s ON ps.size_id = s.size_id
        WHERE ps.product_id = $productId";

            $productSizesResult = $conn->query($sqlProductSizes);

            if ($productSizesResult->num_rows > 0) {
                while ($sizeRow = $productSizesResult->fetch_assoc()) {
                    $selected = ($sizeRow["size_id"] == $initialSize) ? 'selected' : '';
                    echo '<option value="' . $sizeRow["size_id"] . '" ' . $selected . '>' . $sizeRow["size_name"] . '</option>';
                }
            }
            echo '</select>';
            echo '<div style="display: flex; gap: 7px">';
            // Calculate the discounted price here based on the product price and discount
            $discountedPrice = $row["product_price"] - ($row["product_price"] * ($row["discount_percent"] / 100));
            echo '<p class="card-price">₹' . number_format($discountedPrice, 2) . '</p>';
            echo '<p class="card-MRP" style="text-decoration: line-through !important;">₹' . number_format($row["product_price"], 2) . '</p>';
            echo '<span class="discount-percentage">' . $row["discount_percent"] . '%</span>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="not-logged-in-container">
    <div class="not-bag-cnt">
        <div class="centered-div-not-login-bag">
            <img src="assets\php\images\bag\shopping-bag.png" alt="Empty Bag" class="not-bag-image"><br><br>
            <div class="bag-description">
                <h4>Hey, it feels so light!</h4>
            </div><br>
            <div class="not-login-description">There is nothing in your bag. Let\'s add some items</div>
            <span class="not-login-button" onclick="loadwishlist()">ADD ITEMS FROM WISHLIST</span>
        </div>
    </div>
</div>';
    }
    echo '</div>';
    echo '<div class="product-total-container">';
    echo '<div class="total-details">';
    echo '<div class="total-heading"><h4>Price Details</h4></div>';
    echo '<p id="total-mrp">Total MRP: <span id="total-mrp-value">0.00</span></p>';
    echo '<p id="discount-mrp" >Discount on MRP: <span id="discount-mrp-value">0.00</span></p>';
    echo '<p id="total-amount">Total Amount: <span id="total-amount-value">0.00</span></p>';
    echo '<button class="checkout-button" style="background-color: black; color: white;" onclick="sendTotalAmount()">Make Payment</button>
    </div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div id="addressModal" class="form-modal" style="position:absolute">';
    echo '<div class="modal-content">';
    echo '</div>';
    echo '</div>';

    exit();
}
mysqli_close($conn);
?>
<div class="not-logged-in-container">
    <div class="not-bag-cnt">
        <div class="centered-div-not-login-bag">
            <img src="assets\php\images\bag\shopping-bag.png" alt='Empty Bag' class='not-bag-image'>
            <br><br>
            <div class="bag-description">
                <h4>Hey, it feels so light!</h4>
            </div>
            <br>
            <div class="not-login-description">There is nothing in your bag. Let's add some items</div>
            <span class="not-login-button" onclick="loadwishlist()">ADD ITEMS FROM WISHLIST</span>
        </div>
    </div>
</div>
<script>
    function loadwishlist() {
        const page = "assets/php/wishlist.php"; // Specify the page you want to load
        loadContent(page);
    }
</script>
<!-- to open the address form -->
<script>
    // Your JavaScript code, including the openAddressDetailsPage function
    function openAddressDetailsPage() {
        // Specify the page URL you want to open
        const pageUrl = "assets/address_details.php";

        // Use window.location to navigate to the specified page
        window.location.href = pageUrl;
    }
</script>

<script>
    // Open the popup when the "Add Address" button is clicked
    document.getElementById("openPopupButton").addEventListener("click", function() {
        document.getElementById("addressPopup").style.display = "block";
    });

    // Close the popup when the close button is clicked
    function closePopup() {
        document.getElementById("closePopupButton").addEventListener("click", function() {
            document.getElementById("popup-content").style.display = "none";
        });
    }
</script>