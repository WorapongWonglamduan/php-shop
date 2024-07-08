<?php
include("condb.php");
include("config.php");
session_start();
$id = $_GET['id'];
$sql = "SELECT * FROM products,category WHERE products.category_id = category.category_id AND products.product_id = '$id' ";
$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$product =  mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">
<?php
include('./includes/head.php');
include('./includes/navbar.php');
?>

<body>

    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4">
                <img src="<?php echo $uploadsPath . $product['images'] ?>" width="200px" height="250px" style="object-fit: cover;" alt="sale-shop">
            </div>
            <div class="col-md-6">
                <div>Product ID: <?php echo $product['product_id']; ?></div>
                <h5><?php echo $product['category_name']; ?></h5>
                <h6 style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; font-weight: bold;"><?php echo $product['product_name']; ?></h6>
                <h7><?php echo $product['product_detail']; ?></h7>
                <div>Price: <?php echo number_format($product['price'], 2); ?> ฿</div>
                <a href="order.php?id=<?php echo $product['product_id'] ?>" class="btn btn-outline-success">Add cart</a>
            </div>
        </div>
    </div>

    <?php mysqli_close($conn) ?>
</body>

</html>