<?php
session_start();

$_SESSION['power'] = "user";
if (isset($_SESSION['login_email'])&&isset($_SESSION['power'])){
    if (!empty($_SESSION['login_email'])&&strcmp($_SESSION['power'],"user")==0){
        if (isset($_POST['_new_user_fname'])&&isset($_POST['_new_user_gender'])){
            require "config.php";
            $con = mysqli_connect($localhost,$un,$pw,$db);
            if(!$con)die("Something went wrong");
            $email = mysqli_real_escape_string($con,$_SESSION['login_email']);
            $first_name =  mysqli_real_escape_string($con,$_POST['_new_user_fname']);
            $_new_user_gender =  mysqli_real_escape_string($con,$_POST['_new_user_gender']);
            $phone = mysqli_real_escape_string($con,$_POST['_new_seller_phone']);


            $query =  "UPDATE `users` SET `full name`='$first_name',`phone`='$phone',`gender`='$_new_user_gender' WHERE email='$email'";
            if (mysqli_query($con,$query)){
                header("location:../profile?update=success");
            }else{
                echo mysqli_error($con);
            }
        }
    }

}else{
    echo $_SESSION['login_email'];
    echo $_SESSION['power'];
}

