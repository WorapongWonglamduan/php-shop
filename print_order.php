<?php
include("condb.php");
include("config.php");
session_start();

$sqlSelectOrder = "SELECT * FROM orders WHERE orders_id='" . $_SESSION['order_id'] . "'";
$queryOrder = mysqli_query($conn, $sqlSelectOrder);
$rowsOrder = mysqli_fetch_array($queryOrder);
$totalPrice = $rowsOrder['total_price'];
?>
<!DOCTYPE html>
<html lang="en">
<?php
include('./includes/head.php');
include('./includes/navbar.php');
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col ">
                <div class="alert alert-primary text-center h4 mt-4">
                    Orders List
                </div>
                <div class="mb-4"> <span>OrderId : <?php echo $rowsOrder['orders_id'] ?></span>
                    <br />
                    <span>FirstName : <?php echo $rowsOrder['firstname'] ?></span>
                    <br />
                    <span>LastName : <?php echo $rowsOrder['lastname'] ?></span>
                    <br />
                    <span>Phone : <?php echo $rowsOrder['phone'] ?></span>
                    <br />
                </div>

                <div class="card">
                    <div class="table-responsive card-body">
                        <table class="table  table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ProductId</th>
                                    <th>ProductName</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $sqlSelectOrderDetail = "SELECT * FROM orders_details,products WHERE   orders_details.product_id = products.product_id  AND  orders_id='" . $_SESSION['order_id'] . "'";
                                $queryOrderDetails = mysqli_query($conn, $sqlSelectOrderDetail);

                                ?>
                                <?php while ($product = mysqli_fetch_array($queryOrderDetails)) : ?>
                                    <tr>
                                        <td>No</td>
                                        <td><?php echo $product['product_id'] ?></td>
                                        <td><?php echo $product['product_name'] ?></td>
                                        <td><?php echo $product['price'] ?></td>
                                        <td><?php echo $product['orders_qty'] ?></td>
                                        <td><?php echo  number_format($product['price'] * $product['orders_qty']) ?></td>
                                    </tr>
                                <?php endwhile;
                                mysqli_close($conn) ?>
                            </tbody>
                        </table>
                        <h6 class="text-end">Total : <?= number_format($totalPrice) ?> ฿</h6>
                    </div>
                </div>
                <div class="text-center"> <span class="text-danger">*</span> Dear Customer,

                    Thank you for your recent purchase. Kindly ensure that the payment for your order is transferred within 7 days.

                    Please feel free to contact us if you have any questions or need further assistance.

                    Best regards,

                    Sale Shop

                    <div> <button onclick="window.print()" class="btn btn-primary ">Print</button>
                        <a href="index.php" class="btn btn-outline-secondary">Back</a>
                    </div>

                </div>



            </div>
        </div>
    </div>
</body>

</html>