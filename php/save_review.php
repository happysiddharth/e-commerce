<?php
session_start();
if (isset($_SESSION['login_email'])){
    if (isset($_POST['review'])&&isset($_POST['_product_id'])){
        if (!empty($_POST['review'])&&!empty($_POST['_product_id'])){
            require 'config.php';
            $con = mysqli_connect($localhost,$un,$pw,$db);
            if (!$con)die('error');
            require 'template/get_user_id.php';
            $product_id = mysqli_real_escape_string($con,$_POST['_product_id']);
            $query = "SELECT `id` FROM `review` WHERE `user`='$_user_id' AND `product`=$product_id";
            $result = mysqli_query($con,$query);
            if (mysqli_num_rows($result)==0){
                date_default_timezone_set('Asia/Kolkata');
                $date = date('Y/m/d h:i:s a', time());
                $review = mysqli_real_escape_string($con,$_POST['review']);
                $query = "INSERT INTO `review`(`id`, `product`, `user`, `date`, `review`) VALUES (NULL ,$product_id,$_user_id,'$date','$review')";
                if (mysqli_query($con,$query)){
                   header("location:../detail_view?_product_id=$product_id&review=success");
                }
            }else{
                header("location:../detail_view?_product_id=$product_id&previous_submit=true");

            }
        }
    }
}