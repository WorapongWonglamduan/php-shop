<?php
include("config.php");
include("condb.php");

$product_name = trim($_POST["product_name"]);
$category_id = $_POST["category_id"];
$price = $_POST["price"];
$amount = $_POST["amount"];
$image = $_FILES["file"]["name"];
$image_tmp = $_FILES["file"]["tmp_name"]; // Correcting the key from 'temp_name' to 'tmp_name'
$uploads = 'uploads/';
$new_images = $uploads . basename($image);

// Ensure the uploads directory exists
if (!file_exists($uploads)) {
    mkdir($uploads, 0777, true);
}

// Move the uploaded file to the uploads directory
if (move_uploaded_file($image_tmp, $new_images)) {
    $sql = "INSERT INTO products(product_name,category_id,price,amount,images) VALUES('$product_name','$category_id','$price','$amount','$new_images')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        echo "<script>alert('Add Product Successful');</script>";
        echo "<script>window.location = 'list_product.php';</script>";
    } else {
        echo "<script>alert('Add Product Fail');</script>";
    }
} else {
    echo "<script>alert('Failed to upload image.');</script>";
}
