<?php
session_start();
if (isset($_SESSION['seller_login_email'])){
    if (isset($_POST['order_id'])&&isset($_POST['_courier_name'])&&isset($_POST['_tracking_no'])){
        if (!empty($_POST['order_id'])&&!empty($_POST['_courier_name'])&&!empty($_POST['_tracking_no'])){
            require "config.php";
            $con = mysqli_connect($localhost,$un,$pw,$db);
            if (!$con)die("error");
            $order_id = mysqli_real_escape_string($con,$_POST['order_id']);
            $_courier_name = mysqli_real_escape_string($con,$_POST['_courier_name']);
            $_tracking_no = mysqli_real_escape_string($con,$_POST['_tracking_no']);
            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y/m/d h:i:s a', time());
            require "template/get_seller_id_by_email.php";

            $query = "SELECT `product` from `orders` WHERE id='$order_id'";

            if ($res  = mysqli_query($con,$query)){
                $product_id = mysqli_fetch_assoc($res)['product'];
                $query = "select _sellor_id from products WHERE id='$product_id'";
                if ($res = mysqli_query($con,$query)){
                    $id = mysqli_fetch_assoc($res)['_sellor_id'];
                    if ($_seller_id==$id){
                        $query = "UPDATE `orders` set `shipping_date`='$date', `shipped_with`='$_courier_name', `tracking_no`='$_tracking_no', `status`='shipped' WHERE id='$order_id'";
                        if (mysqli_query($con,$query)){
                          header("location:../product_ordered?update=success");
                        }
                    }
                }
            }else{
                echo "as";
            }
        }
    }
}