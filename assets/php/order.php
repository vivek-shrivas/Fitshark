<?php
// Start the session
session_start();

// Assuming you have a database connection established already

// Receive the selectedProductIds as a comma-separated string
$selectedProductIds = isset($_POST['selectedProductIds']) ? $_POST['selectedProductIds'] : '';

// Split the comma-separated string into an array of product IDs
$selectedProductIdsArray = explode(',', $selectedProductIds);

// Get the user ID from the session
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    // Check if the user is logged in (you can adjust this condition as needed)
    if (!$user_id) {
        die("You are not logged in.");
    }

    // Database configuration (modify as needed)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fitstart";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize the order ID to store the generated order_id
    $order_id = null;

    // Create a new order in the "order" table
    $insertOrderQuery = "INSERT INTO orders (c_id) VALUES ($user_id)";

    if ($conn->query($insertOrderQuery) === TRUE) {
        // Get the generated order_id
        $order_id = $conn->insert_id;

        // Create an array to store order items
        $orderItems = array();
        // Initialize a variable to store the sum total
        $sumTotal = 0;

        // Loop through the selectedProductIdsArray and fetch data
        foreach ($selectedProductIdsArray as $productId) {
            // Construct SQL queries to fetch product_name, product_price, discount_percent, size, and quantity
            $productQuery = "SELECT product_price FROM product WHERE product_id = $productId";
            $discountQuery = "SELECT discount_percent FROM discount WHERE product_id = $productId";
            $bagQuery = "SELECT size_id, quantity FROM bag WHERE c_id = $user_id AND product_id = $productId";

            // Execute the product query and fetch data
            $productResult = $conn->query($productQuery);
            if ($productResult && $productResult->num_rows > 0) {
                $productData = $productResult->fetch_assoc();

                // Execute the discount query and fetch data
                $discountResult = $conn->query($discountQuery);
                if ($discountResult && $discountResult->num_rows > 0) {
                    $discountData = $discountResult->fetch_assoc();

                    // Execute the bag query and fetch data
                    $bagResult = $conn->query($bagQuery);
                    if ($bagResult && $bagResult->num_rows > 0) {
                        $bagData = $bagResult->fetch_assoc();

                        // Calculate total, MRP, and discount
                        $mrp = $productData["product_price"];
                        $discount = $discountData["discount_percent"];
                        $quantity = $bagData["quantity"];
                        $size_id = $bagData["size_id"];
                        $total = (($mrp * $quantity) - (($discount * $mrp) / 100));

                        // Add the calculated total to the sumTotal
                        $sumTotal += $total;

                        // Create an order item array
                        $orderItem = array(
                            "order_id" => $order_id,
                            "product_id" => $productId,
                            "size_id" => $bagData["size_id"],
                            "order_date" => date("Y-m-d H:i:s"), // Current date and time
                            "status" => "PAID", // Set an appropriate status
                            "mrp" => $mrp,
                            "discount" => $discount,
                            "total" => $total,
                            "quantity" => $quantity,
                        );

                        // Add the order item to the array
                        $orderItems[] = $orderItem;
                    }
                }
            }
        }

        // Now, $sumTotal contains the total sum of all product totals

        // Prepare and execute the SQL query to insert order items
        foreach ($orderItems as $orderItem) {
            $insertOrderItemQuery = "INSERT INTO order_item (order_id, product_id, size_id, order_date, status, mrp, discount, total, quantity)
                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($insertOrderItemQuery);
            $stmt->bind_param(
                "iiissdddi",
                $orderItem["order_id"],
                $orderItem["product_id"],
                $orderItem["size_id"],
                $orderItem["order_date"],
                $orderItem["status"],
                $orderItem["mrp"],
                $orderItem["discount"],
                $orderItem["total"],
                $orderItem["quantity"]
            );

            $stmt->execute();
        }
    }

    // Close the database connection
    $conn->close();

    // Return the order ID as a JSON response
    header("Content-Type: application/json");
    $order_id = (int)$order_id;

    // Echo the order_id as an integer
    echo $order_id;
} else {
    // Return an error response
    echo json_encode(array("status" => "error", "message" => "Error creating the order."));
}
