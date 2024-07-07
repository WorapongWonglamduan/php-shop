<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
?>

<!doctype html>
<html lang="en">

<?php
include("./includes/head.php")
?>

<body>
    <div class="container">
        <div class="alert alert-primary h4 mt-4" role="alert">
            Welcome <?php $roles = $_SESSION["roles"];
                    if ($roles == '1') {
                        echo "ADMIN";
                    } else {
                        echo "SUPER ADMIN";
                    } ?>
        </div>
        <?php
        if (isset($_SESSION["firstname"])) {
            echo "<div class='text-success'>";
            echo $_SESSION["firstname"] . " " . $_SESSION["lastname"];
            echo '</div>';
        }
        ?>
        <br />
        <a href="logout.php" class="alert alert-primary">Logout</a>
    </div>
</body>

</html>