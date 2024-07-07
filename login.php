<?php
session_start();
?>
<!doctype html>
<html lang="en">

<?php
include("./includes/head.php")
?>

<body>
    <div class="container">
        <br />
        <div class="row">
            <div class="col-md-6 text-bg-light text-dark">

                <br />
                <div class="alert alert-primary h4" role="alert">
                    Login
                </div>
                <br />
                <form method="POST" action="auth.php">
                    <label>username</label>
                    <input type="text" name="username" placeholder="username" class="form-control" required />
                    <label>password</label><input type="password" name="password" placeholder="password" class="form-control" required />
                    <br />
                    <?php
                    if (isset($_SESSION["Error"])) {
                        echo "<div class='text-danger'>";
                        echo $_SESSION["Error"];
                        echo '</div>';
                    }
                    ?>
                    <input type="submit" name='submit' value="login" />
                </form>
                <br />
                <a href="register.php">Register</a>
            </div>
        </div>
    </div>
</body>

</html>