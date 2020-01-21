<?php
session_start();


if (isset($_SESSION['seller_login_email'])){
    if (!empty($_SESSION['seller_login_email'])){
        if (isset($_POST['_new_seller_fname'])){
            require "config.php";
            $con = mysqli_connect($localhost,$un,$pw,$db);
            if(!$con)die("Something went wrong");
            $email = mysqli_real_escape_string($con,$_SESSION['seller_login_email']);
            $first_name =  mysqli_real_escape_string($con,$_POST['_new_seller_fname']);
            $phone = mysqli_real_escape_string($con,$_POST['_new_seller_phone']);


            $query =  "UPDATE `seller` SET `full name`='$first_name',`phone`='$phone' WHERE email='$email'";
            if (mysqli_query($con,$query)){

                header("location:../update_seller?update=success");
            }else{
                echo mysqli_error($con);
            }
        }
    }

}else{
    echo $_SESSION['login_email'];
    echo $_SESSION['power'];
}

