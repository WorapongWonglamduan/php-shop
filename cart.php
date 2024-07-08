<?php
include("condb.php");
include("config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
include('./includes/head.php');
include('./includes/navbar.php');
?>


<body>
    <div class="container">
        <form action="" id="form" method="POST">
            <div class="row">
                <div class="col-md-10">
                    <div class="alert alert-primary h4" role="alert">
                        Orders Cart
                    </div>
                    <table class="table table-hover">
                        <tr>
                            <th>No.</th>
                            <th>Images</th>
                            <th>ProductId</th>
                            <th>ProductName</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Total Price</th>
                            <th>Delete</th>

                        </tr>
                        <?php
                        $total = 0;
                        $totalPrice = 0;
                        $m = 1;
                        for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) :

                            if ($_SESSION["strProductID"][$i] != "") {
                                $sql1 = "SELECT * FROM products WHERE product_id = '" . $_SESSION["strProductID"][$i] . "' ";
                                $query1 = mysqli_query($conn, $sql1);
                                $rowsProducts = mysqli_fetch_array($query1);

                                $_SESSION['price'] =  $rowsProducts['price'];
                                $total = $_SESSION["strQty"][$i];
                                $sum = $total * $rowsProducts['price'];
                                $sumPrice = number_format($sum);
                                $price = number_format($rowsProducts['price']);
                                $totalPrice += $sum;
                        ?>
                                <tr>
                                    <td><?php echo $m ?></td>
                                    <td><img src="<?php echo $uploadsPath . $rowsProducts['images'] ?>" width='80px' height="100px" alt="sale-shop" style="object-fit: cover" class="border"></td>
                                    <td><?php echo $rowsProducts['product_id'] ?></td>
                                    <td><?php echo $rowsProducts['product_name'] ?></td>
                                    <td><?php echo $price ?></td>
                                    <td><?php echo $_SESSION["strQty"][$i] ?></td>
                                    <td><?php echo $sumPrice ?></td>
                                    <td> <a href="delete_cart.php?id=<?php echo $i ?>"><button type="button" class="btn btn-outline-danger">Delete</button></a></td>


                                </tr>
                        <?php $m =  $m + 1;
                            }
                        endfor ?>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2">Total Price</td>
                            <td> <?php echo number_format($totalPrice) ?></td>
                            <td>฿</td>
                        </tr>
                    </table>
                    <div style="text-align: right;"><button type="submit" class="btn btn-outline-primary">Confirm</button>
                        <a href="index.php"><button type="button" class="btn btn-outline-secondary">Back</button></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>