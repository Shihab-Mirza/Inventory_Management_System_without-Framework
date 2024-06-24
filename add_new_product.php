<?php session_start(); ?>

<?php

class Add_new_product{
    
    public function add_product()
    {
        require_once 'database_connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $product_id = $_POST['product_id'];
            $product_name = $_POST["product_name"];
            $quantity = $_POST["quantity"];
            $unit_price = $_POST["unit_price"];

            if (!is_numeric($product_id)) {
                $_SESSION['error'] = 'Invalid Product ID INPUT';
                header("Location: add_new_product.php");
                exit();
            }

            $check_sql = "SELECT * FROM inventory WHERE product_id = $product_id";
            $result = $Connection->query($check_sql);

            if ($result->num_rows > 0) {
                $_SESSION['error'] = 'Product ID already exists';
                header("Location: add_new_product.php");
                exit();
            }

            
            $total_price = $quantity * $unit_price;
            
            $sql = "INSERT INTO inventory (product_id, product_name, quantity, unit_price, total_price) VALUES ($product_id, '$product_name', $quantity, $unit_price, $total_price)";
            if ($Connection->query($sql) === TRUE) {
                $_SESSION['success'] = "New Product Added Successfully: $product_name ($quantity)";
            } else {
                $_SESSION['error'] = 'New Product Insertion Failed';
            }
          
            $Connection->close();

            header("Location: add_new_product.php");
            exit();
        }
    }
}

$add_products = new Add_new_product();
$add_products->add_product();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Inventory Management</h2>
            <ul>
                <li><a href="inventory_home.php">Inventory List</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2>Add Product</h2>
           
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for ="product_id"> product ID</label><br>
                <input type="text" id="product_id" name ="product_id" required><br>
                <label for="product_name">Product Name:</label><br>
                <input type="text" id="product_name" name="product_name" required><br>
                
                <label for="quantity">Quantity:</label><br>
                <input type="number" id="quantity" name="quantity" min="1" required><br>
                
                <label for="unit_price">Unit Price:</label><br>
                <input type="number" id="unit_price" name="unit_price" required><br><br>
                
                <input type="submit" name="submit" value="Add Product">
            </form>
            <?php if(isset($_SESSION['success'])){ 
                echo '<p style="color: green">'.$_SESSION['success'].'</p>';
                unset($_SESSION['success']);
            } elseif(isset($_SESSION['error'])){ 
                echo '<p style="color: red">'.$_SESSION['error'].'</p>';
                unset($_SESSION['error']);
            } ?>
        </div>
      
    </div>
</body>
</html>


