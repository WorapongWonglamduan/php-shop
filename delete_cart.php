<?php
ob_start();
session_start();


if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $_SESSION["strProductID"][$id] = "";
    $_SESSION["strQty"][$id] = "";
}
header("location: cart.php");
