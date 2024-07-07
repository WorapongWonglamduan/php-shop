<?php
include("condb.php");
include("config.php");
// receive params from register.php
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$phone = $_POST["phone"];
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

//has password by sha512
$password = hash('sha512', $password);

$sql = "INSERT INTO users(firstname,lastname,phone,email,username,password)
Values('$firstname','$lastname','$phone','$email','$username','$password')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('save successful')</script>";
    echo "<script> window.location='register.php'</script>";
} else {
    echo "Error:" . $sql . "<br/>" . mysqli_error($conn);
    echo "<script> window.location='register.php'</script>";
}
mysqli_close($conn);
