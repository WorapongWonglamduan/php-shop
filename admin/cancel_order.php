<?php
include("condb.php");
include("config.php");
$id = $_GET['id'];

$sql = "UPDATE orders SET orders_status = '7' WHERE orders_id = '$id' ";
$query = mysqli_query($conn, $sql);
if ($query) {
    echo "<script>alert('Cancel order successful')</script>";
    echo "<script>window.location='report_order.php'</script>";
} else {
    echo "<script>alert('Can't cancel order !')</script>";
}
mysqli_close($conn);
