<style>
    .category-outer-cnt {
        margin: 70px;
    }

    .category-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;

    }


    .category-card {
        padding: 5px;
    }

    .category-card button {
        position: relative;
        margin-top: 38rem;
        margin-left: 17px;
        border-radius: 20px;

    }

    .category-heading {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .image {
        height: 310px;
        width: 245px
    }
</style>

<?php
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP (empty)
$dbname = "fitstart";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<div class="category-outer-cnt">
    <h4>SHOP BY CATEGORY</h4>
    <div class="category-container">

        <?php
        $sql = "SELECT * FROM Category WHERE category_name IN ('mens', 'womens', 'accessories')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $category_id = $row['category_id'];
                echo '<div class="category-card">';
                echo '<div  style="width:30vw; height: 70vh; background-image: url(uploads/' . $row['image'] . '); background-size: cover; background-repeat: no-repeat; background-position: center center; border-radius: 10px;">';
                echo '<a href="#" class="category-card" onclick="loadCategoryProducts(' . $row["category_id"] . ')">';
                echo '<button type="button" class="btn btn-outline-light">SHOP ' . $row["category_name"] . '</button>';
                echo '</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No categories found.";
        }

        $conn->close();
        ?>
    </div>
</div>