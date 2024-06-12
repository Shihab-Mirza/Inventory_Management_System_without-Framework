<?php 

$hostname ="localhost";
$username = "root";
$password = "";
$database_name = "ims";

$Connection = new mysqli($hostname, $username , $password, $database_name);
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}
