<?php
session_start();

class Delete_product{
    public function delete_product()
    {
        require_once 'database_connection.php';

        if (isset($_POST['product_id'])) { 
            $product_id = $_POST['product_id'];

            $sql = "SELECT * FROM inventory WHERE product_id = '$product_id'";
            $result = $Connection->query($sql);

            if ($result->num_rows > 0) {
                $sql = "DELETE FROM inventory WHERE product_id = '$product_id'";
                if ($Connection->query($sql) === TRUE) {
                    $_SESSION['success'] = "Product deleted successfully";
                } else {
                    $_SESSION['error'] = 'Product deletion failed';
                }
            } else {
                $_SESSION['error'] = 'Product ID not found';
            }
          
            $Connection->close();

            header("Location: delete_existing_product.php");
            exit();
        }
    }
}

$delete_product = new Delete_product();
$delete_product->delete_product();
?>

<html>
<head>
    <title>Delete Product</title>
</head>
<body>
<div class="container">
        <div class="sidebar">
            <h2>Inventory Management</h2>
            <ul>
                <li><a href="inventory_home.php">Inventory List</a></li>
            </ul>
        </div>
    <h1>Delete Product</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
        <label for="product_id">Enter Product ID:</label>
        <input type="text" id="product_id" name="product_id" required>
        <button type="submit">Delete</button>
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