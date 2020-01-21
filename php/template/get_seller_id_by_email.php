<?php

$email_seller = $_SESSION['seller_login_email'];


$query  = "SELECT * FROM `seller` WHERE email='$email_seller'";


if ($res = mysqli_query($con,$query)){
    $_seller_id  =  mysqli_fetch_assoc($res)['id'];

}else{
    die("error");
}
?>