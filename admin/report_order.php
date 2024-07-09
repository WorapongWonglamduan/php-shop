<?php
include('condb.php');
include('config.php');


$statusOptions = [
    1 => 'Order Placed',
    2 => 'Awaiting Payment',
    3 => 'Payment Confirmed',
    4 => 'Processing/Preparing Order',
    5 => 'Shipped',
    6 => 'Delivered',
    7 => 'Cancelled',
    8 => 'Returned',
    9 => 'Refunded'
];
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
                            DataTable
                        </div>
                        <div class="mt-4 mx-3">
                            <button class="btn btn-outline-success" onclick="filterOrders(3)">Payment Confirmed</button>
                            <button class="btn btn-outline-success" onclick="filterOrders(1)">Order Placed</button>
                            <button class="btn btn-outline-success" onclick="filterOrders(7)">Cancelled</button>
                            <button class="btn btn-outline-secondary" onclick="filterOrders()">All Orders</button> <!-- ปุ่มสำหรับแสดงทั้งหมด -->
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatablesSimple">
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
                                            <th>Cancel Order</th>
                                            <th>Change Status</th>

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

                                        if (isset($_GET['status'])) {
                                            $status = intval($_GET['status']);
                                            $sqlOrders = "SELECT * FROM orders WHERE orders_status = '$status' ORDER BY date_time DESC";
                                        } else {
                                            $sqlOrders = "SELECT * FROM orders ORDER BY date_time DESC"; // แสดงคำสั่งซื้อทั้งหมด
                                        }
                                        $queryOrders  = mysqli_query($conn, $sqlOrders);
                                        while ($rowOrders = mysqli_fetch_array($queryOrders)) :

                                            $strStatus  = onStatus($rowOrders['orders_status'])


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

                                                <td> <?php if (showCancelOrder($rowOrders['orders_status'])) : ?><a href="cancel_order.php?id=<?= $rowOrders['orders_id'] ?>" class="btn btn-danger" onclick="delOrder(this.href);return false;">Cancel</a> <?php endif ?></td>
                                                <td>
                                                    <form method="POST" action="update_order_status.php">
                                                        <input type="hidden" name="orders_id" value="<?= $rowOrders['orders_id'] ?>">
                                                        <select name="orders_status" class="form-control" onchange="this.form.submit()">
                                                            <?php foreach ($statusOptions as $value => $label) : ?>
                                                                <option value="<?= $value ?>" <?= ($value == 7) ? 'disabled' : '' ?> <?= ($rowOrders['orders_status'] == $value) ? 'selected' : '' ?>>
                                                                    <?= $label ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endwhile;
                                        mysqli_close($conn) ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('footer.php')  ?>
        </div>
    </div>


</body>

</html>
<?php
function showCancelOrder($status)
{
    return $status != 3 && $status != 7;
}

function onStatus($orderStatus)
{
    switch ($orderStatus) {
        case 1:
            return  'Order Placed';
            break;
        case 2:
            return 'Awaiting Payment';
            break;
        case 3:
            return  '<div style="color:blue;font-weight:bold">Payment Confirmed</div>';
            break;
        case 4:
            return   'Processing/Preparing Order';
            break;
        case 5:
            return  'Shipped';
            break;
        case 6:
            return   'Delivered';
            break;
        case 7:
            return  '<div style="color:red;font-weight:bold">Cancelled</div>';
            break;
        case 8:
            return  'Returned';
            break;
        case 9:
            return 'Refunded';
            break;
    }
}
?>
<script>
    function delOrder(order) {
        const userConfirmed = confirm('Are you sure you will cancel this order?');
        if (userConfirmed) {
            window.location = order;
        }
    }

    function filterOrders(status) {
        if (status) {
            window.location.href = 'report_order.php?status=' + status;
        } else {
            window.location.href = 'report_order.php';
        }
    }
</script>