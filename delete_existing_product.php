<?php
session_start();

class Delete_product{
    public function delete_product()
    {
        require_once 'database_connection.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "DELETE FROM inventory WHERE id = '$id'";
            if ($Connection->query($sql) === TRUE) {
                $_SESSION['success'] = "Product deleted successfully";
            } else {
                $_SESSION['error'] = 'Product deletion failed';
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
    <h1>Delete Product</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <label for="id">Enter Product ID:</label>
        <input type="text" id="id" name="id">
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