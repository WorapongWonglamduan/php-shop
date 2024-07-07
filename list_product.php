<?php
include("config.php");
include("condb.php");
session_start();


$sql = "SELECT * FROM products,category WHERE products.category_id = category.category_id";
$query  = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($query);

?>
<!doctype html>
<html lang="en">

<?php
include("./includes/head.php")
?>


<body>
    <div class="container">
        <div class="alert alert-primary h4 mt-4" role="alert">
            List Products
        </div>
        <a href="add_product.php" role="button" class="btn btn-primary mb-4">Add +</a>
        <table class="table table-striped">
            <tr>
                <th>
                    ProductID
                </th>
                <th>
                    ProductName
                </th>
                <th>
                    Category
                </th>
                <th>
                    Price
                </th>
                <th>
                    Amount
                </th>
                <th>
                    Images
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
            </tr>
            <?php while ($product = mysqli_fetch_assoc($query)) :
            ?>
                <tr>
                    <td><?php echo $product['product_id'] ?></td>
                    <td><?php echo $product['product_name'] ?></td>
                    <td><?php echo $product['category_name'] ?></td>
                    <td><?php echo $product['price'] ?></td>
                    <td><?php echo $product['amount'] ?></td>
                    <td><img src="<?php echo $uploadsPath . $product['images'] ?>" width="80px" height="80px" style="object-fit: contain;" /></td>
                    <td><a href="edit_product.php?id=<?php echo $product['product_id'] ?>">Edit</a></td>
                    <td><a href="#">Delete</a></td>
                </tr>
            <?php
            endwhile; ?>
            <?php mysqli_close($conn) ?>

        </table>

    </div>
</body>

</html>