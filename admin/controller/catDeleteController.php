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

$c_id = $_POST['record'];
$query = "INSERT INTO category where category_id='$c_id' is_deleted=1";

$data = mysqli_query($conn, $query);

if ($data) {
    echo "Category Item Deleted";
} else {
    echo "Not able to delete";
}
