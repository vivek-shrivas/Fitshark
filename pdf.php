<head>
    <meta charset="UTF-8" />
    <title>Invoice</title>

    <link rel="stylesheet" href="pdf.css">
    <?php
    session_start();
    // Step 1: Establish a database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fitstart";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_SESSION["user_id"])) {
        $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;

        // Assuming you receive user_id from a form POST
        $user_id = $_SESSION["user_id"];
        // Fetch user data
        $userQuery = "SELECT * FROM customer WHERE c_id = $user_id";
        $userResult = $conn->query($userQuery);

        if ($userResult->num_rows > 0) {
            $userData = $userResult->fetch_assoc();
        } else {
            die("User not found");
        }

        // Fetch order data (modify the query according to your database structure)
        $orderQuery = "SELECT * FROM orders WHERE order_id = $order_id";
        $orderResult = $conn->query($orderQuery);

        if ($orderResult->num_rows > 0) {
            $orderData = $orderResult->fetch_assoc();
        } else {
            die("No orders found");
        }

        // Fetch all product data along with discounts
        // Fetch all product data along with discounts and quantities
        $productQuery = "SELECT p.*, d.discount_percent, oi.quantity
                 FROM product p
                 LEFT JOIN discount d ON p.product_id = d.product_id
                 INNER JOIN order_item oi ON p.product_id = oi.product_id
                 WHERE oi.order_id = $order_id";
        $productResult = $conn->query($productQuery);

        $products = array();
        while ($row = $productResult->fetch_assoc()) {
            $products[] = $row;
        }

        // Calculate total amount, GST, SGST, and other necessary calculations
        $subtotal = 0;
        foreach ($products as $product) {
            $subtotal += ($product['product_price'] * $product['quantity']) - ($product['discount_percent'] * $product['product_price'] * $product['quantity'] / 100);
        }

        $gstAmount = $subtotal * 9 / 100; // Assuming 18% GST
        $sgstAmount = $subtotal * 9 / 100;
        $totalAmount = ($subtotal - ($gstAmount + $sgstAmount)); // Assuming 9% SGST
    }
    // Step 3: Insert the retrieved data into the HTML template
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Invoice</title>
        <style>
            /* Add your CSS styles here */
            /* For example, you can style the table and addresses */
            /* ... */
        </style>
    </head>

<body>
    <div class="invoice-container">
        <!-- Logo -->
        <div class="logo">
            <img src="uploads/logo.svg" alt="Website Logo" style="max-width: 150px">
        </div>

        <!-- Address section -->
        <div class="address-section">
            <!-- Insert user's billing and shipping addresses here -->
            <!-- For example: -->
            <div class="address" id="billingAddress">
                <div>FITSHARK</div>
                <div>Billed From :</div>
                <div>Fitshark Pvt. Ltd.</div>
                <div>123 Main street </div>
                <div>MUMBAI</div>
                <div>MAHARASTRA</div>
                <div>410058</div>
            </div>

            <!-- Insert shipping address here if needed -->
            <!-- For example: -->
            <div class="address" id="shippingAddress">
                <div>Shipping Address</div>
                <?php
                $cId = 2;
                $cAddressQuery = "SELECT * FROM c_address WHERE c_id = $cId";
                $cAddressResult = $conn->query($cAddressQuery);

                if ($cAddressResult->num_rows > 0) {
                    $cAddressData = $cAddressResult->fetch_assoc();

                    // Populate the HTML template with the retrieved c_address data
                    echo '<div class="address" id="billingAddress">';
                    echo '<div> ' . $cAddressData['address_line1'] . '</div>';
                    echo '<div>' . $cAddressData['address_line2'] . '</div>';
                    echo '<div>' . $cAddressData['city'] . '</div>';
                    echo '<div>' . $cAddressData['state'] . '</div>';
                    echo '<div>' . $cAddressData['postal_code'] . '</div>';
                    echo '</div>';
                } else {
                    die("c_address not found");
                }
                ?>
            </div>
        </div>

        <!-- Product table -->
        <table id="productTable">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Discount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) { ?>
                    <tr>
                        <td><?php echo $product['product_name']; ?></td>
                        <td><?php echo $product['product_price']; ?></td>
                        <td><?php echo $product['quantity'] ?></td>
                        <td><?php echo $product['discount_percent']; ?>%</td>
                        <td><?php echo (($product['product_price'] * $product['quantity']) - ($product['discount_percent'] * $product['product_price'] * $product['quantity'] / 100)) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Total section -->
        <div class="total-section">
            <div class="total-row">
                <span>Total</span>
                <span><span id="totalAmount"><?php echo $totalAmount; ?></span></span>
            </div>
            <div class="total-row">
                <span>GST (9%)</span>
                <span><span id="gstAmount"><?php echo $gstAmount; ?></span></span>
            </div>
            <div class="total-row">
                <span>SGST (9%)</span>
                <span><span id="sgstAmount"><?php echo $sgstAmount; ?></span></span>
            </div>
            <div class="total-row">
                <span>*Including GST</span>

            </div>

            <div class="total-row">
                <span>Final Amount</span>
                <span><span id="subtotalAmount"><?php echo $subtotal; ?></span></span>
            </div>
        </div>
        <button id="generatePDF">Download Invoice</button>
        <a href="index.php"><button id="generatePDF">Back to Home</button></a>
    </div>
</body>

</html>

<?php
// Step 4: Close the database connection
$conn->close();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.0/html2pdf.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('generatePDF').addEventListener('click', function() {
            const element = document.querySelector('.invoice-container'); // Replace with the selector of your invoice container
            const options = {
                margin: 10,
                filename: 'invoice.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                },
                pagebreak: {
                    mode: 'avoid-all',
                    before: '.page-break'
                } // Optional: Customize page breaks
            };

            html2pdf()
                .from(element)
                .set(options)
                .toPdf()
                .get('pdf')
                .then(function(pdf) {
                    pdf.save();
                });
        });
    });
</script>