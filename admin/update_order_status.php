<?php
include('condb.php');
include('config.php');

if (isset($_POST['orders_id'])) {
    $orderId = $_POST['orders_id'];
    $orderStatus = $_POST['orders_status'];


    $sqlUpdate = "UPDATE orders SET orders_status = '$orderStatus' WHERE orders_id = '$orderId'";
    if (mysqli_query($conn, $sqlUpdate)) {

        echo "<script>alert('Status updated successfully');</script>";
        header("location: report_order.php");
    } else {
        echo "<script>alert('Error updating status');</script>";
        header("location: report_order.php");
    }
} else {
    echo "<script>alert('Error updating status no have orderId');</script>";
}
