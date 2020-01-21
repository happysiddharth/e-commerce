<?php
session_start();
if (isset($_SESSION['login_email'])) {
    require "config.php";
    $con = mysqli_connect($localhost, $un, $pw, $db);
    if (!$con) die("Something went wrong");

    $email = $_SESSION['login_email'];

    $query = "SELECT id FROM `users` WHERE email='$email'";


    if ($res = mysqli_query($con, $query)) {
        $_user_id = mysqli_fetch_assoc($res)['id'];

    } else {
        die(mysqli_connect_error($con));
    }
    if (isset($_GET['remove_item'])){
        if (!empty($_GET['remove_item'])){
            $pid = mysqli_real_escape_string($con,htmlspecialchars($_GET['remove_item']));
            $query = "DELETE FROM `cart` WHERE product = $pid AND user=$_user_id";
            if (mysqli_query($con,$query)){
                header("location:../cart?removed=true");
            }
        }
    }

}
?>