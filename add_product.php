<?php
include("condb.php");
include("config.php");

$sql = "SELECT * FROM category ORDER BY category_id";
$query = mysqli_query($conn, $sql);
$rows =  mysqli_num_rows($query);
?>
<!doctype html>
<html lang="en">

<?php
include("./includes/head.php")
?>

<body>
    <div class="container">
        <div class="alert alert-primary h4 mt-4 text-center" role="alert">
            Add Product
        </div>
        <div class="row">
            <div class="col">
                <form name="form" method="POST" action="insert_product.php" enctype="multipart/form-data">
                    <label>Product Name</label>
                    <input type="text" name="product_name" class="form-control" placeholder="product name" required />
                    <br />
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <?php
                        while ($category = mysqli_fetch_assoc($query)) :
                        ?>
                            <option value="<?php echo $category["category_id"]; ?>">
                                <?php echo $category["category_name"]; ?>
                            </option>
                        <?php
                        endwhile;
                        ?>
                        <?php mysqli_close($conn) ?>

                    </select>
                    <br />
                    <label>Price</label>
                    <input type="number" name="price" min="1" class="form-control" placeholder="price" required />
                    <br />
                    <label>Amount</label>
                    <input type='number' name="amount" min="1" class="form-control" placeholder="amount" required />
                    <br />
                    <label>Image</label>
                    <input type='file' name="file" id="file" class="form-control" required />
                    <br />
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="list_product.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>

    </div>
</body>

</html>