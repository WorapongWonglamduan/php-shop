<?php
session_start();
include("condb.php");
include("config.php");

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$address = $_POST["address"];
$phone = $_POST["phone"];

$qsl = "INSERT INTO orders (firstname, lastname, address, phone, total_price, orders_status) VALUES ('$firstname', '$lastname', '$address', '$phone', '" . $_SESSION['total_price'] . "', '1')";
$query = mysqli_query($conn, $qsl);
$orderId = mysqli_insert_id($conn);

$total_price = 0;

for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
    if ($_SESSION["strProductID"][$i] != "") {
        $sqlProductSelect = "SELECT * FROM products WHERE product_id = '" . $_SESSION["strProductID"][$i] . "'";
        $queryProductSelect = mysqli_query($conn, $sqlProductSelect);
        $rowsProducts = mysqli_fetch_array($queryProductSelect);
        $price = $rowsProducts['price'];
        $sum = $_SESSION['strQty'][$i] * $price;
        $total_price += $sum;

        $sqlInsertOrderDetail = "INSERT INTO orders_details (orders_id, product_id, orders_price, orders_qty, total) VALUES ('$orderId', '" . $_SESSION['strProductID'][$i] . "', '$price', '" . $_SESSION['strQty'][$i] . "', '$sum')";
        if (mysqli_query($conn, $sqlInsertOrderDetail)) {
            $sqlUpdateAmount = "UPDATE products SET amount = amount - '" . $_SESSION['strQty'][$i] . "' WHERE product_id = '" . $_SESSION['strProductID'][$i] . "'";
            mysqli_query($conn, $sqlUpdateAmount);
        }
    }
}

mysqli_close($conn);
session_destroy();
echo '<script>alert("Insert Successful")</script>';
header("location: index.php");
