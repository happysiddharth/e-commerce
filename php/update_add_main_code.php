<?php

session_start();
if (isset($_SESSION['login_email'])&&isset($_SESSION['power'])){
    if (strcmp($_SESSION['power'],'user')==0){
        if (isset($_POST['id'])&&isset($_POST['_city'])&&isset($_POST['_pinCode'])&&isset($_POST['Address'])){
            require "./config.php";
            $con = mysqli_connect($localhost,$un,$pw,$db);
            if(!$con)die("Something went wrong");
            $id = mysqli_real_escape_string($con,htmlspecialchars($_POST['id']));
            $_city = mysqli_real_escape_string($con,htmlspecialchars($_POST['_city']));
            $_pinCode = mysqli_real_escape_string($con,htmlspecialchars($_POST['_pinCode']));
            $Address = mysqli_real_escape_string($con,htmlspecialchars($_POST['Address']));
            $email = $_SESSION['login_email'];
            $query = "UPDATE `addresses` SET `address`='$Address',`pin`=$_pinCode,`city`='$_city' WHERE id=$id" ;
            $result = mysqli_query($con,$query);
            if ($result){
                mysqli_close($con);
                header("location:../addresses?update=success");
            }
        }

    }
}else{
    echo "Something went wrong";
}


?>