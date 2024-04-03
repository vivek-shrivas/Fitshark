<?php
session_start();

// Database configuration
$host = 'localhost'; // Database host (usually "localhost")
$dbname = 'fitstart'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password (empty in this case)

// Create a MySQLi database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
  die("Database connection failed: " . $conn->connect_error);
}

// Assuming you have a valid user_id stored in the session
$user_id = $_SESSION['user_id'];

// Prepare and execute the SQL query
$sql = "SELECT c_name, c_email, c_phone_no FROM customer WHERE c_id = $user_id";
$result = $conn->query($sql);

// Check if a row was returned
if ($result->num_rows > 0) {
  // Fetch the results
  $row = $result->fetch_assoc();
  $c_name = $row['c_name'];
  $c_email = $row['c_email'];
  $c_phone_no = $row['c_phone_no'];
} else {
  // Handle the case where no matching customer was found
  echo "Customer not found.";
}
$order_id = $_GET['order_id'];
// Close the database connection
$conn->close();
?>





<form action="/fitstart/pdf.php?order_id=<?php echo $order_id ?>" method="POST">
  <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_4sKIKBCWQwl5z3" data-amount="<?php echo $_GET['amount']; ?>" data-currency="INR" data-id="11" data-buttontext="Pay with Razorpay" data-name="FITSHARK STORE" data-description="Fashion Lifestyle And Fitness." data-image="https://example.com/your_logo.jpg" data-prefill.name="<?php echo $c_name; ?>" data-prefill.email="<?php echo $c_email; ?>" data-theme.color="#F37254"></script>
  <input type="hidden" custom="Hidden Element" name="hidden" />
</form>