<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Inventory Management</h2>
            <ul>
                <li><a href="add_new_product.php">Add New Product</a></li>
                <li><a href="update_existing_product.php">Update product</a></li>
                <li><a href="delete_existing_product.php">Delete product</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2>Inventory</h2>
            <div class="inventory-list">
              <?php 
              require_once 'database_connection.php';

              $sql = "SELECT * FROM inventory";
              $result = $Connection->query($sql);

              if ($result->num_rows > 0) {
                  echo "<table>";
                  echo "<tr><th>Product ID</th><th>Product Name</th><th>Quantity</th><th>Unit Price</th><th>Total Price</th></tr>";
                  while($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row["id"] . "</td>";
                      echo "<td>" . $row["product_name"] . "</td>";
                      echo "<td>" . $row["quantity"] . "</td>";
                      echo "<td>$" . $row["unit_price"] . "</td>";
                      echo "<td>$" . $row["total_price"] . "</td>";
                      echo "</tr>";
                  }
                  echo "</table>";
              } else {
                  echo "0 results";
              }

              $Connection->close();
              ?>
            </div>
        </div>
    </div>
</body>
</html>



