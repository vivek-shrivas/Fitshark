<?php
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ''; // Change this to your database password
$dbname = "fitstart"; // Change this to your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['upload'])) {

    $catname = $_POST['c_name'];

    $insert = mysqli_query($conn, "INSERT INTO category
         (category_name) 
         VALUES ('$catname')");

    if (!$insert) {
        echo mysqli_error($conn);
        header("Location: ../dashboard.php?category=error");
    } else {
        echo "category  added successfully.";
    }
}
