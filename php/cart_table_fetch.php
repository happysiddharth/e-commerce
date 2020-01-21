<?php


require "config.php";
$con = mysqli_connect($localhost, $un, $pw, $db);
if (!$con) die("Something went wrong");

$email = $_SESSION['login_email'];

$query  = "SELECT id FROM `users` WHERE email='$email'";


if ($res = mysqli_query($con,$query)){
    $_user_id  =  mysqli_fetch_assoc($res)['id'];

}else{
    die(mysqli_connect_error($con));
}

$query = "select * from cart WHERE user=$_user_id";


if ($res = mysqli_query($con,$query)){
    $num_of_item = mysqli_num_rows($res);
    $total_price = 0;


}else{
    die(mysqli_connect_error($con));

}
?>