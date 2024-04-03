<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1740px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .dashboard {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .data {
            display: flex;
            justify-content: space-around;
        }

        /* Rectangular shape for data-box */
        .data-box {
            text-align: center;
            padding: 20px;
            border-radius: 5px;
            width: 250px;
            /* Set a fixed width */
            height: 150px;
            /* Set a fixed height */
            margin: 10px;
            /* Add margin for spacing */
        }

        /* Colors for data-box */
        .customer-box {
            background-color: #007BFF;
            /* Blue */
            color: #fff;
        }

        .order-box {
            background-color: #28A745;
            /* Green */
            color: #fff;
        }

        .sales-box {
            background-color: #FFC107;
            /* Yellow */
            color: #fff;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
            font-size: 20px;
            /* Adjust the font size to your preference */
        }

        th {
            background-color: #333;
            color: #fff;
        }

        .data-box p {
            font-size: 24px;
            /* Adjust the font size to your preference */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Dashboard</h1>
        </div>
        <div class="dashboard">
            <div class="data">
                <div class="data-box customer-box">
                    <h2>Total No. of Customers</h2>
                    <?php
                    // Database connection parameters
                    $db_host = 'localhost';
                    $db_user = 'root';
                    $db_pass = '';
                    $db_name = 'fitstart'; // Replace with your actual database name

                    // Connect to the database
                    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

                    if (!$conn) {
                        die("Database connection failed: " . mysqli_connect_error());
                    }

                    // Query to fetch the total number of customers
                    $query = "SELECT COUNT(*) as total_customers FROM customer";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $total_customers = $row['total_customers'];
                        echo "<p>$total_customers</p>";
                    } else {
                        echo "<p>Error fetching data</p>";
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </div>
                <div class="data-box order-box">
                    <h2>Total No. of Orders</h2>
                    <?php
                    // Connect to the database (You can reuse the existing $db_* variables)
                    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

                    if (!$conn) {
                        die("Database connection failed: " . mysqli_connect_error());
                    }

                    // Query to fetch the total number of orders
                    $query = "SELECT COUNT(*) as total_orders FROM orders";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $total_orders = $row['total_orders'];
                        echo "<p>$total_orders</p>";
                    } else {
                        echo "<p>Error fetching data</p>";
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </div>
                <div class="data-box sales-box">
                    <h2>Total Sales</h2>
                    <?php
                    // Connect to the database (You can reuse the existing $db_* variables)
                    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

                    if (!$conn) {
                        die("Database connection failed: " . mysqli_connect_error());
                    }

                    // Query to fetch the total sales amount by summing the 'total' column in 'order_item' table
                    $query = "SELECT SUM(total) as total_sales FROM order_item";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $total_sales = $row['total_sales'];
                        echo "<p>₹" . number_format($total_sales, 2) . "</p>"; // Use ₹ for Rupee symbol
                    } else {
                        echo "<p>Error fetching data</p>";
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
            <div class="table-container">
                <h2>Recent Orders</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Order Date</th>
                            <th>Product ID</th> <!-- Added Product ID column -->
                            <th> Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connect to the database (You can reuse the existing $db_* variables)
                        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

                        if (!$conn) {
                            die("Database connection failed: " . mysqli_connect_error());
                        }

                        // Query to fetch recent orders with customer name, order date, product ID, and total amount, including Order ID from the orders table
                        $query = "SELECT o.order_id, o.order_date, c.c_name, oi.product_id, oi.total
                                  FROM orders o
                                  JOIN customer c ON o.c_id = c.c_id
                                  JOIN order_item oi ON o.order_id = oi.order_id
                                  ORDER BY o.order_date DESC ";


                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['order_id'] . "</td>";
                                echo "<td>" . $row['c_name'] . "</td>";
                                echo "<td>" . $row['order_date'] . "</td>";
                                echo "<td>" . $row['product_id'] . "</td>";
                                echo "<td>₹" . number_format($row['total'], 2) . "</td>"; // Use ₹ for Rupee symbol
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No recent orders found</td></tr>";
                        }

                        // Close the database connection
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>