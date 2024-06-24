<?php
session_start(); ?>



<?php 
require_once 'database_connection.php';
class Login {

    public function verify($username, $password) {
        global $Connection; 
        $query = "SELECT * FROM users WHERE username=? AND password=?";
        $stmt = mysqli_prepare($Connection, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);;

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            header("location: inventory_home.php");
            exit();
        } 
        else {

            $_SESSION['error'] = 'Invalid username or password';
            header("location: index.php");
            exit();
             }
    }
}

if(isset($_POST['username']) && isset($_POST['password'])) {
    $Login = new Login();
    $Login->verify($_POST['username'], $_POST['password']);
}

 






