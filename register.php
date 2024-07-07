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
                    register
                </div>
                <br />
                <form method="POST" action="insert_register.php">
                    <label>name</label> <input type="text" name="firstname" class="form-control" required />
                    <label>lastname</label><input type="text" name="lastname" class="form-control" required />
                    <label>email</label> <input type="text" name="email" class="form-control" required />
                    <label>phone</label> <input type='number' maxlength="10" name="phone" class="form-control" required />
                    <label>username</label> <input type="text" name="username" class="form-control" required />
                    <label>password</label><input type="password" name="password" class="form-control" required />
                    <br />
                    <input type="submit" name='submit' value="save" class="btn btn-primary">
                    <input type="reset" name='cancel' value="cancel" class="btn btn-secondary">
                    <br />

                    <a href="login.php">Login</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>