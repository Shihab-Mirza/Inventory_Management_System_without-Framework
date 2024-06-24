<?php

class UpdateProduct{
    
    public function update_product()
    {
        require_once 'database_connection.php';

        if (isset($_POST['submit'])) {
            $product_id = $_POST['product_id'];
            $product_name = $_POST["product_name"];
            $new_quantity = $_POST["quantity"];
            $new_unit_price = $_POST["unit_price"];

            $sql = "SELECT * FROM inventory WHERE product_id = '$product_id'";
            $result = $Connection->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $previous_quantity = $row["quantity"];
                $previous_total_price = $row['total_price'];
                $new_total_price = $previous_total_price + ($new_quantity * $new_unit_price);
                $updated_quantity = $previous_quantity + $new_quantity;
                $sql = "UPDATE inventory SET quantity = '$updated_quantity', updated_unit_price = '$new_unit_price', total_price = '$new_total_price' WHERE product_id = '$product_id'";
                if ($Connection->query($sql) === TRUE) {
                    $_SESSION['success'] = "Product updated successfully: $product_name ($product_id)";
                } else {
                    $_SESSION['error'] = 'Product update failed';
                }
            } else {
                $_SESSION['error'] = 'Product ID not found';
            }
          
            $Connection->close();

            header("Location: update_existing_product.php");
            exit();
        }
    }
}

session_start();
$update_product = new UpdateProduct();
$update_product->update_product();

?>

<html>
<head>
    <title>Update Product</title>
</head>
<body>
<div class="container">
        <div class="sidebar">
            <h2>Inventory Management</h2>
            <ul>
                <li><a href="inventory_home.php">Inventory List</a></li>
            </ul>
        </div>
    <h1>Update Product</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for ="product_id">Product ID:</label><br>
        <input type="text" id="product_id" name ="product_id" required><br>
        
        <label for="quantity">New Quantity:</label><br>
        <input type="number" id="quantity" name="quantity" min="1" required><br>
        
        <label for="unit_price">New Unit Price:</label><br>
        <input type="number" id="unit_price" name="unit_price" required><br><br>
        
        <input type="submit" name="submit" value="Update Product">
    </form>

    <?php
    if (isset($_SESSION['success'])) {
        echo "<p style='color: green'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    } elseif (isset($_SESSION['error'])) {
        echo "<p style='color: red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>
</body>
</html>