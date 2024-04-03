<!DOCTYPE html>
<html>
<head>
    <title>Order Management</title>
    <style>
        /* Center the table on the page */
        table {
            margin: 0 auto;
        }

        /* Increase font size for footer */
        tfoot {
            font-size: 16px;
        }

        /* Change button color to red */
        button {
            background-color: red;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        /* Increase padding and font size for table cells */
        table td, table th {
            padding: 12px;
            font-size: 18px;
        }
    </style>
</head>
<body>
<h1 style="text-align: center;">Order Database</h1>
    <table border="1">
        <tr>
            <th>Serial No.</th>
            <th>Customer ID</th>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Product ID</th>
            <th>Size ID</th>
            <th>Status</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Address Line 1</th>
            <th>Address Line 2</th>
            <th>City</th>
            <th>State</th>
            <th>Postal Code</th>
        </tr>
        <?php
        // Connect to your database here (Replace with your database credentials)
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'fitstart';

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // Fetch data from the 'orders' table and join with 'order_item' and 'c_address' tables
        $sql = "SELECT o.order_id, o.c_id, o.order_date, oi.product_id, oi.size_id, oi.status, oi.quantity, oi.total, ca.address_line1, ca.address_line2, ca.city, ca.state, ca.postal_code
                FROM orders o
                LEFT JOIN order_item oi ON o.order_id = oi.order_id
                LEFT JOIN c_address ca ON o.c_id = ca.c_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $serialNumber = 1; // Initialize serial number
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $serialNumber . "</td>"; // Display serial number
                echo "<td>" . $row["c_id"] . "</td>";
                echo "<td>" . $row["order_id"] . "</td>";
                echo "<td>" . $row["order_date"] . "</td>";
                echo "<td>" . $row["product_id"] . "</td>";
                echo "<td>" . $row["size_id"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td>" . $row["total"] . "</td>";
                echo "<td>" . $row["address_line1"] . "</td>";
                echo "<td>" . $row["address_line2"] . "</td>";
                echo "<td>" . $row["city"] . "</td>";
                echo "<td>" . $row["state"] . "</td>";
                echo "<td>" . $row["postal_code"] . "</td>";
                echo "</tr>";

                $serialNumber++; // Increment serial number for the next row
            }
        } else {
            echo "<tr><td colspan='14'>No records found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </table>
</body>
</html>
