<?php
include('condb.php');
include('config.php')
?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php') ?>

<body class="sb-nav-fixed">
    <?php include("navbar_admin.php") ?>
    <div id="layoutSidenav">
        <?php include("side_nav.php") ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-4 ">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>OrderId</th>
                                        <th>FirstName</th>
                                        <th>LastName</th>
                                        <th>Address</th>
                                        <th>Phone</th>

                                        <th>Total</th>
                                        <th>Date</th>
                                        <th>Order Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>orders_id</th>
                                        <th>firstname</th>
                                        <th>lastname</th>
                                        <th>address</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $sqlOrders = "SELECT * FROM orders ORDER BY date_time DESC";
                                    $queryOrders  = mysqli_query($conn, $sqlOrders);
                                    while ($rowOrders = mysqli_fetch_array($queryOrders)) :

                                        switch ($rowOrders['orders_status']) {
                                            case 1:
                                                $strStatus = 'Order Placed';
                                                break;
                                            case 2:
                                                $strStatus = 'Awaiting Payment';
                                                break;
                                            case 3:
                                                $strStatus = '<div style="color:blue;font-weight:bold">Payment Confirmed</div>';
                                                break;
                                            case 4:
                                                $strStatus = 'Processing/Preparing Order';
                                                break;
                                            case 5:
                                                $strStatus = 'Shipped';
                                                break;
                                            case 6:
                                                $strStatus = 'Delivered';
                                                break;
                                            case 7:
                                                $strStatus = '<div style="color:red;font-weight:bold">Cancelled</div>';
                                                break;
                                            case 8:
                                                $strStatus = 'Returned';
                                                break;
                                            case 9:
                                                $strStatus = 'Refunded';
                                                break;
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $rowOrders['orders_id'] ?></td>
                                            <td><?= $rowOrders['firstname'] ?></td>
                                            <td><?= $rowOrders['lastname'] ?></td>
                                            <td><?= $rowOrders['address'] ?></td>
                                            <td><?= $rowOrders['phone'] ?></td>

                                            <td><?= number_format($rowOrders['total_price']) ?></td>
                                            <td><?= $rowOrders['date_time'] ?></td>
                                            <td><?= $strStatus ?></td>
                                        </tr>
                                    <?php endwhile;
                                    mysqli_close($conn) ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('footer.php')  ?>
        </div>
    </div>


</body>


</html>