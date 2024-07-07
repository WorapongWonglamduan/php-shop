<?php
include("config.php");
include("condb.php");

// Check if the necessary POST data is set
$product_id = $_POST["product_id"];
$product_name = trim($_POST["product_name"]);
$category_id = $_POST["category_id"];
$price = $_POST["price"];
$amount = $_POST["amount"];
$old_images = $_POST["old_images"];
$image = $_FILES["file"]["name"];
$image_tmp = $_FILES["file"]["tmp_name"]; // Correcting the key from 'temp_name' to 'tmp_name'
$uploads = 'uploads/';
$new_images = $uploads . basename($image);

// Ensure the uploads directory exists
if (!file_exists($uploads)) {
    mkdir($uploads, 0777, true);
}

// Move the uploaded file to the uploads directory
if (!empty($image) && move_uploaded_file($image_tmp, $new_images)) {
    $image = $image;
}
else {
    $image = $old_images;
}

$sql = "UPDATE products SET product_name='$product_name',category_id='$category_id',price='$price',amount='$amount',images='$image' WHERE product_id = '$product_id'";
$query = mysqli_query($conn, $sql);
if ($query) {
    echo "<script>alert('Update Product Successful');</script>";
    echo "<script>window.location = 'list_product.php';</script>";
}
else {
    echo "<script>alert('Update Product Fail');</script>";
}
