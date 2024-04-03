<div>
  <h3>Category Items</h3>
  <button type="button" class="btn btn-secondary" style="height:40px" data-toggle="modal" data-target="#myModal">
    Add Category
  </button>

  <table class="table" id="cat-tab">
    <thead>
      <tr>
        <th class="text-center">S.N.</th>
        <th class="text-center">Category id</th>
        <th class="text-center">Category Name</th>
        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
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

    $sql = "SELECT * from category WHERE is_deleted = 0";
    $result = $conn->query($sql);
    $count = 1;
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
    ?>
        <tr id="cat-row" data-category-id="<?= $row['category_id'] ?>">
          <td><?= $count ?></td>
          <td class="text-center"><?= $row["category_id"] ?></td>
          <td class="text-center"><?= $row["category_name"] ?></td>
          <!-- <td><button class="btn btn-primary" >Edit</button></td> -->
          <td class="text-center"><button class="btn btn-danger" style="height:40px" onclick="categoryDelete('<?= $row['category_id'] ?>')">Delete</button></td>
        </tr>
    <?php
        $count = $count + 1;
      }
    }
    ?>
  </table>

  <!-- Trigger the modal with a button -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Category Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form enctype='multipart/form-data' action="./controller/addCatController.php" method="POST">
            <div class="form-group">
              <label for="c_name">Category Name:</label>
              <input type="text" class="form-control" name="c_name" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary" name="upload" style="height:40px">Add Category</button>
            </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
        </div>
      </div>

    </div>
  </div>


</div>