<?php
$hostname = "localhost";
$username = "root";
$password = "root";
$database  = "php_sale_shop";
// Create connection
$conn = mysqli_connect($hostname, $username, $password, $database,);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
