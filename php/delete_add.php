<?php

session_start();
if (isset($_SESSION['login_email'])&&isset($_SESSION['power'])){
    if (strcmp($_SESSION['power'],'user')==0){
        if (isset($_POST['address_id'])){
            require "./config.php";
            $con = mysqli_connect($localhost,$un,$pw,$db);
            if(!$con)die("Something went wrong");
            $id = mysqli_real_escape_string($con,htmlspecialchars($_POST['address_id']));

            $query = "DELETE FROM `addresses` WHERE `addresses`.`id` = $id" ;
            $result = mysqli_query($con,$query);
            if ($result){

                header("location:../addresses?delete=success");
            }
        }

    }
}else{
    echo "Something went wrong";
}


?>