<?php
include("condb.php");
include("config.php");
session_start();

// if (!isset($_SESSION['username'])) {
//     header('location: login.php');
// }
$sql = "SELECT * FROM products";
$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
?>
<!doctype html>
<html lang="en">

<?php
include("./includes/head.php")
?>

<?php
include("./includes/navbar.php")
?>

<body>
  <div class="container">
    <!-- <div class="alert alert-primary h4 mt-4" role="alert">
            Welcome <?php echo $_SESSION["firstname"] ?>
        </div> -->
    <!-- <?php
          // if (isset($_SESSION["firstname"])) {
          //     echo "<div class='text-success'>";
          //     echo $_SESSION["firstname"] . " " . $_SESSION["lastname"];
          //     echo '</div>';
          // }
          ?> -->
    <!-- <br />
        <a href="logout.php" class="alert alert-primary">Logout</a> -->


    <div class="row mt-4">
      <?php
      while ($product = $query->fetch_object()) :
      ?>
        <div class="col-md-3 mb-4 p-4">
          <img src="<?php echo $uploadsPath . $product->images ?>" width="200" height="250" style="object-fit: cover">
          <br />
          <div>ProductId :<?php echo $product->product_id ?></div>
          <h6 style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;font-weight:bold"><?php echo $product->product_name ?></h6>
          <div>Price :<?php echo number_format($product->price, 2) ?> ฿</div>
        </div>
      <?php endwhile; ?>
      <?php mysqli_close($conn) ?>

    </div>
  </div>
</body>

</html>