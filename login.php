<?php

session_start();
require_once 'database_connection.php';

class login {
    public function verify($username, $password) {
        global $Connection; 

        $query = "SELECT * FROM users WHERE username=? AND password=?";
        $stmt = mysqli_prepare($Connection, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);;

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            header("location: Home.php");
            exit();
        } 
        else {
            header("location: xyz.php");
            exit();
             }
    }
}

if(isset($_POST['username']) && isset($_POST['password'])) {
    $login = new Login();
    $login->verify($_POST['username'], $_POST['password']);
}

 






