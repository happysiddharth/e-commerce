<?php
$email = $_SESSION['login_email'];

$query  = "SELECT id FROM `users` WHERE email='$email'";


if ($res = mysqli_query($con,$query)){
    $_user_id  =  mysqli_fetch_assoc($res)['id'];

}else{
    die(mysqli_connect_error($con));
}
?>