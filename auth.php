<?php

// Start session
session_start();
include("config.php");
include("condb.php");
$username = $_POST["username"];
$password = $_POST["password"];

$password = hash('sha512', $password);

// SQL query with parameters
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
$roles = $row["roles"];

// Check if a row was found
if ($row > 0) {
    $_SESSION['username'] = $row['username'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['roles'] = $row['roles'];
    if ($roles == '2') {
        $show = header("location: index.php");
    }
    else {
        $show = header("location: admin.php");
    }

    // Redirect to index.php on successful login

    exit;
}
else {
    // If no row was found, redirect with an error message
    $_SESSION["Error"] = "<p>Your username or password is invalid</p>";
    $show = header("location: login.php");
    exit;
}
// echo $show;
