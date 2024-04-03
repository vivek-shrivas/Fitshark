<!DOCTYPE html>
<html>

<head>
    <title>Product Images</title>
    <style>
        /* Add your CSS styling for thumbnails and main image here */
        .product-details-cnt-d {
            height: 100vh;
            display: flex;
        }

        /* Styles for image displayer and product details */
        .image-view-container {
            display: flex;
            flex-direction: row;
            margin-left: 300px;
            margin-right: 50px;
            row-gap: 10px;
        }

        .thumbnail-d {
            display: flex;
            flex-direction: column;
            height: 100px;
            width: 100px;
            margin-right: 5px;
        }

        .thumbnail-image {
            cursor: pointer;
            border: 1px solid #ccc;
            height: 500px;
            width: 100px;
            justify-content: center;
            align-items: center;
            margin-bottom: 5px;
        }

        .thumbnail-image img {
            height: 100px;
            width: 100px;
        }

        .main-image-d {
            justify-content: center;
            align-items: center;
            height: 480px;
            width: 400px;
            border: 1px solid #ccc;
            margin-left: 7px;
        }

        #main-image {
            width: 400px;
            height: 480px;
        }

        .product-details-container {
            display: flex;
            flex-direction: column;
            width: 500px;
            font-size: 1.5rem;
            /* Increased font size */
        }

        /* Additional styling */
        .description-heading {
            text-transform: uppercase;
            font-size: 13px;
            margin: 0;
        }

        .price {
            font-size: 20px;
            color: #fe6067;
        }

        .product-name {
            display: inline-block;
            text-transform: uppercase;
            margin: 0;
            font-size: 30px;
            letter-spacing: 0.5px;
        }

        .product-description {
            margin: 0;
            margin-top: 10px;
            margin-bottom: 30px;
            font-size: 12px;
            color: #8b8b8b;
            font-weight: 100;
            line-height: 23px;
            font-family: "Open Sans", sans-serif;
        }

        /* Dropdown styling */
        .dropdown {
            margin-top: 10px;
        }

        .dropdown select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Title for Size dropdown */
        .size-title,
        .quantity-title {
            text-transform: uppercase;
            font-size: 13px;
            margin: 0;
        }

        /* Styling for the horizontal line */
        hr {
            border: 1px solid rgb(0, 0, 0);
            margin-top: -21rem;
            margin-bottom: 1rem;
        }

        /* CSS for Recommended Products Heading */
        .recommended-heading {
            font-size: 24px;
            /* Adjust the font size as needed */
            font-weight: bold;
            /* Make the text bold */
            text-align: center;
            /* Center-align the text */
            margin-top: 20px;
            /* Add some top margin for spacing */
            color: #333;
            /* Choose your desired text color */
            text-transform: uppercase;
            /* Uppercase the text */
        }

        /* Additional styling for product cards */
        .product-card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .product-card {
            border: 1px solid #ccc;
            padding: 10px;
            width: 200px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="product-details-cnt-d">
        <div>
            <div class="image-view-container">
                <div class="thumbnail-d">
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
                    if (isset($_GET['product_id'])) {
                        // Retrieve the product_id from the GET parameter
                        $product_id = $_GET['product_id'];

                        // Prepare and execute the SQL query to fetch product images
                        $sql = "SELECT image_url
                                FROM product_image
                                WHERE product_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $product_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Check if there are images to display
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $image_url = $row["image_url"];
                                echo '<div class="thumbnail-image" onclick="displayImage(\'uploads/' . $image_url . '\')">';
                                echo '<img src="uploads/' . $image_url . '" alt="Thumbnail Image" />';
                                echo '</div>';
                            }
                        } else {
                            echo 'No images found for this product.';
                        }

                        // Close the image stateme
                        $sql = "SELECT image_url
                        FROM product_image
                        WHERE product_id = ?
                        LIMIT 1";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $product_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        echo '</div>';
                        echo '<div class="main-image-d">';
                        $row = $result->fetch_assoc();
                        $image_url = $row["image_url"];
                        echo '<img id="main-image" src="uploads/' . $image_url . '" alt="Main Image" />';
                        $stmt->close();
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="product-details-container">
            <?php
            if (isset($_GET['product_id'])) {
                // Retrieve the product_id from the GET parameter
                $product_id = $_GET['product_id'];

                // Prepare and execute the SQL query to fetch product details
                $product_sql = "SELECT product_name, product_description, product_price
                                FROM product
                                WHERE product_id = ?";
                $product_stmt = $conn->prepare($product_sql);
                $product_stmt->bind_param("i", $product_id);
                $product_stmt->execute();
                $product_result = $product_stmt->get_result();

                // Check if there are product details to display
                if ($product_result->num_rows > 0) {
                    $product_row = $product_result->fetch_assoc();
                    $product_name = $product_row["product_name"];
                    $product_description = $product_row["product_description"];
                    $product_price = $product_row["product_price"];

                    // Display the product details
                    echo '<h2 class="product-name">' . $product_name . '</h2>';
                    echo '<p class="description-heading">Description:</p>';
                    echo '<p class="product-description">' . $product_description . '</p>';
                    echo '<div class="size-radio-container">';
                    echo '<p class="size-title">Sizes:</p>';

                    // Prepare and execute the SQL query to fetch sizes dynamically
                    $size_sql = "SELECT s.size_id, s.size_name
                                 FROM sizes s
                                 INNER JOIN product_sizes ps ON s.size_id = ps.size_id
                                 WHERE ps.product_id = ?";
                    $size_stmt = $conn->prepare($size_sql);
                    $size_stmt->bind_param("i", $product_id);
                    $size_stmt->execute();
                    $size_result = $size_stmt->get_result();

                    // Generate radio buttons for each size option
                    while ($size_row = $size_result->fetch_assoc()) {
                        $size_id = $size_row["size_id"];
                        $size_name = $size_row["size_name"];
                        echo '<label><input type="radio" name="size" value="' . $size_id . '"> ' . $size_name . '</label>';
                    }

                    echo '</div>';

                    // Add a new dropdown for quantity
                    echo '<div class="dropdown">';
                    echo '<p class="quantity-title">Quantity:</p>';
                    echo '<select name="quantity" id="quantity">';
                    for ($i = 1; $i <= 4; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    echo '</select>';
                    echo '</div>';

                    echo '<p class="price">Rs: ' . number_format($product_price, 2) . '</p>';

                    // Add the button to add to the bag
                    echo '<button type="button" onclick="addtobag(' . $product_id . ')" class="btn btn-outline-dark">Add to Bag</button>';
                } else {
                    echo 'No product details found for this product.';
                }

                // Close the product statement
                $product_stmt->close();
            }



            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Script to set the initial main image source -->
    <script>
        window.onload = function() {
            const mainImage = document.getElementById("main-image");
            const thumbnailImages = document.querySelectorAll(".thumbnail-image img");

            thumbnailImages.forEach((thumbnailImg) => {
                thumbnailImg.addEventListener("click", function() {
                    mainImage.src = thumbnailImg.src;
                });
            });

            // Set the initial main image source to the first thumbnail image
            if (thumbnailImages.length > 0) {
                mainImage.src = thumbnailImages[0].src;
            }
        };
    </script>


    <!-- Script to add product to bag table -->
    <script>
        function addtobag(product_id) {
            // Retrieve the selected size_id (radio button) and quantity from the form
            const sizeRadios = document.querySelectorAll('input[name="size"]');
            let selectedSizeId = null;

            sizeRadios.forEach((radio) => {
                if (radio.checked) {
                    selectedSizeId = radio.value;
                }
            });

            const selectedQuantity = document.getElementById('quantity').value;

            // Make an AJAX request to insert the product into the bag table
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        const response = xhr.responseText;
                        if (response === 'success') {
                            alert('Product added to bag successfully.');
                        } else {
                            alert(response);
                        }
                    } else {
                        alert('Error: ' + xhr.status);
                    }
                }
            };

            // Define the URL where your PHP script handles the insertion
            const url = 'assets/insert_product_into_bag.php';

            // Create the data to be sent in the request
            const data = new FormData();
            data.append('product_id', product_id);
            data.append('size_id', selectedSizeId); // Pass the selected size_id
            data.append('quantity', selectedQuantity); // Ensure quantity is passed as an integer

            // Open and send the AJAX request
            xhr.open('POST', url, true);
            xhr.send(data);
        }
    </script>

</body>

</html>