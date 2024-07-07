<?php
include("condb.php");
include("config.php");

$productId = $_GET['id'];

$sqlProduct = "SELECT * FROM products WHERE product_id = '$productId' ";
$queryProduct = mysqli_query($conn, $sqlProduct);
$product =  mysqli_fetch_array($queryProduct);

$sql = "SELECT * FROM category ORDER BY category_id";
$query = mysqli_query($conn, $sql);

?>
<!doctype html>
<html lang="en">

<?php
include("./includes/head.php")
?>

<body>
    <div class="container">
        <div class="alert alert-primary h4 mt-4 text-center" role="alert">
            Edit Product
        </div>
        <div class="row">
            <div class="col">
                <form name="form" method="POST" action="update_product.php" enctype="multipart/form-data">
                    <label>Product Id</label>
                    <input type="text" name="product_id" readonly class="form-control" style="background-color: #e9ecef;" value="<?php echo $product['product_id'] ?>" required />
                    <br />
                    <label>Product Name</label>
                    <input type="text" name="product_name" class="form-control" value="<?php echo $product['product_name'] ?>" required />
                    <br />
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <?php
                        while ($category = mysqli_fetch_assoc($query)) :
                            $selected = ($product['category_id'] == $category['category_id']) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $category["category_id"]; ?>" <?php echo $selected ?>>
                                <?php echo $category["category_name"]; ?>
                            </option>
                        <?php
                        endwhile;
                        ?>
                        <?php mysqli_close($conn) ?>

                    </select>
                    <br />
                    <label>Price</label>
                    <input type="number" name="price" min="1" class="form-control" value="<?php echo $product['price'] ?>" required />
                    <br />
                    <label>Amount</label>
                    <input type='number' name="amount" min="1" class="form-control" value="<?php echo $product['amount'] ?>" required />
                    <br />
                    <label class="mb-4">Image</label>
                    <br />
                    <img src=<?php echo $uploadsPath . $product['images'] ?> width="120px" height="120px" style="object-fit: contain;" class="mb-4" />
                    <br>
                    <input type='file' name="file" id="file" class="form-control" />
                    <input type='hidden' name="old_images" class="form-control" value="<?php echo $product['images'] ?>" />
                    <br />
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="list_product.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>

    </div>
</body>

</html>