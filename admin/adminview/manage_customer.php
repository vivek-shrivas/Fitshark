<!DOCTYPE html>
<html>
<head>
    <title>Customer Management</title>
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
<h1 style="text-align: center;">Customer Database</h1>
    <table border="1">
        <tr>
            <th>Serial No.</th>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone No.</th>
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

        // Fetch data from the 'customer' table
        $sql = "SELECT `c_id`, `c_name`, `c_email`, `c_phone_no` FROM `customer`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $serialNumber = 1; // Initialize serial number
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $serialNumber . "</td>"; // Display serial number
                echo "<td>" . $row["c_id"] . "</td>";
                echo "<td>" . $row["c_name"] . "</td>";
                echo "<td>" . $row["c_email"] . "</td>";
                echo "<td>" . $row["c_phone_no"] . "</td>";
                echo "</tr>";

                $serialNumber++; // Increment serial number for the next row
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </table>



</body>
</html>
