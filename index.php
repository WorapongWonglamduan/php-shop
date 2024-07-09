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

      <!-- display -->
      <?php
      $perpage = 6;
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }
      $start = ($page - 1) * $perpage;

      $keyword = @$_POST['keyword'];
      if ($keyword != '') {
        $sql = "SELECT * FROM products WHERE product_id='$keyword' OR product_name like'%$keyword%' OR price <= '$keyword'  ORDER BY product_id LIMIT {$start}, {$perpage}";
      } else {
        $sql = "SELECT * FROM products ORDER BY product_id LIMIT {$start}, {$perpage}";
      }
      $queryProduct = mysqli_query($conn, $sql) or die(mysqli_error($conn));

      while ($product = mysqli_fetch_assoc($queryProduct)) :
        $price = $product["price"];
      ?>
        <div class="col-md-4 mb-4 p-4 text-center">
          <img src="<?php echo $uploadsPath . $product['images']; ?>" width="200" height="250" style="object-fit: cover;">
          <br />
          <div>Product ID: <?php echo $product['product_id']; ?></div>
          <div style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; font-weight: bold;"><?php echo $product['product_name']; ?></div>
          <div>Price: <?php echo number_format($product['price'], 2); ?> ฿</div>
          </br>
          <a href="product_detail.php?id=<?php echo $product['product_id'] ?>" class="btn btn-outline-success">Details</a>
        </div>
      <?php endwhile; ?>
    </div>
    <!-- end row -->

    <?php
    $sqlProductAll = "SELECT * FROM products";
    $resultProductCount = mysqli_query($conn, $sqlProductAll);
    $totalProducts = mysqli_num_rows($resultProductCount); // Count total rows
    $total_page = ceil($totalProducts / $perpage); // Calculate total pages
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

<?php
mysqli_close($conn); ?>