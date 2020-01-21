<?php
function return_address($email,$address_id=NULL){
    require "config.php";
    $con = mysqli_connect($localhost,$un,$pw,$db);
    if(!$con)die("Something went wrong");
    $email = $_SESSION['login_email'];

    $query  = "SELECT id FROM `users` WHERE email='$email'";
    if ( $result = mysqli_query($con,$query)){
        $id = mysqli_fetch_assoc($result)['id'];
    }else{
        die();
    }
    $query  = "SELECT * FROM `addresses` WHERE user='$id' AND id='$address_id' ";

    $result = mysqli_query($con,$query);
    return mysqli_fetch_array($result);
}
?>