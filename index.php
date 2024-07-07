<?php
include("condb.php");
include("config.php");
session_start();

$sql = "SELECT * FROM products";
$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

?>
<!doctype html>
<html lang="en">

<?php
include("./includes/head.php");
include("./includes/navbar.php");
?>

<body>
  <div class="container">
    <div class="row mt-4">
      <?php
      $perpage = 6;
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }
      $start = ($page - 1) * $perpage;
      $sql = "SELECT * FROM products ORDER BY product_id LIMIT {$start}, {$perpage}";
      $queryProduct = mysqli_query($conn, $sql) or die(mysqli_error($conn));

      while ($product = mysqli_fetch_assoc($queryProduct)) {
        $price = $product["price"];
      ?>
        <div class="col-md-4 mb-4 p-4">
          <img src="<?php echo $uploadsPath . $product['images']; ?>" width="200" height="250" style="object-fit: cover;">
          <br />
          <div>Product ID: <?php echo $product['product_id']; ?></div>
          <h6 style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; font-weight: bold;"><?php echo $product['product_name']; ?></h6>
          <div>Price: <?php echo number_format($product['price'], 2); ?> ฿</div>
          <a href="#" class="btn btn-info">Add</a>
        </div>
      <?php } ?>
    </div>
    <!-- end row -->

    <?php
    $sqlProductCount = "SELECT COUNT(*) AS total FROM products";
    $resultProductCount = mysqli_query($conn, $sqlProductCount);
    $rowProductCount = mysqli_fetch_assoc($resultProductCount);
    $totalProducts = $rowProductCount['total'];
    $total_page = ceil($totalProducts / $perpage);
    ?>

    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
          <a class="page-link" href="index.php?page=<?php echo ($page > 1) ? ($page - 1) : 1; ?>">Previous</a>
        </li>
        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
          <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li class="page-item <?php if ($page >= $total_page) echo 'disabled'; ?>">
          <a class="page-link" href="index.php?page=<?php echo ($page < $total_page) ? ($page + 1) : $total_page; ?>">Next</a>
        </li>
      </ul>
    </nav>
  </div>
  <!-- container -->
</body>

</html>

<?php mysqli_close($conn); ?>