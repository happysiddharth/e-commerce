<?php
session_start();
if (isset($_SESSION['login_email'])){
    if (isset($_POST['_city'])&&isset($_POST['_pinCode'])&&isset($_POST['Address'])){
        if (!empty($_POST['_city'])&&!empty($_POST['_pinCode'])&&!empty($_POST['Address'])){

                require "./config.php";
                $con = mysqli_connect($localhost,$un,$pw,$db);
                if(!$con)die("Something went wrong");
                $email = $_SESSION['login_email'];

                $query  = "SELECT id FROM `users` WHERE email='$email'";
               if ( $result = mysqli_query($con,$query)){
                   $id = mysqli_fetch_assoc($result)['id'];
               }else{
                   die();
               }
               $city = mysqli_real_escape_string($con,$_POST['_city']);
               $_pinCode = mysqli_real_escape_string($con,$_POST['_pinCode']);
               $Address = mysqli_real_escape_string($con,$_POST['Address']);
                $query  = "INSERT INTO `addresses`(`id`, `user`, `address`, `pin`, `city`) VALUES (NULL ,$id,'$Address','$_pinCode','$city')";
                if (mysqli_query($con,$query)){
                    mysqli_close($con);
                    if (isset($_GET['redirect'])){
                        $redirect_page = $_GET['redirect'];
                        header("location:$redirect_page");
                    }else{
                        header("location:addresses?added=success");

                    }
                }


        }
    }
}else{
    echo "Something went wrong";
}