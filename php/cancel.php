<?php
session_start();
if (isset($_SESSION['login_email'])){
    if (isset($_POST['order_id'])){
        if (!empty($_POST['order_id'])){
            require "config.php";
            $con = mysqli_connect($localhost,$un,$pw,$db);
            if (!$con)die("error");
            require "template/get_user_id.php";
            $oid = mysqli_real_escape_string($con,htmlspecialchars($_POST['order_id']));
            $query = "select `quantity`,`product`,`size` from orders WHERE `user`=$_user_id AND id='$oid' AND status!='canceled'";
            if ($res = mysqli_query($con,$query)){
                $data = mysqli_fetch_assoc($res);
                $quantity = $data['quantity'];
                $product = $data['product'];
                $size = $data['size'];
                if ($size!=null&&$size!='ins'){
                    $query = "select `$size`,`instock` from products WHERE id=$product";
                    if ($res = mysqli_query($con,$query) ){
                        $data = mysqli_fetch_assoc($res);
                        $size_quantity = $data["$size"];
                    }
                    $new_quantity = $size_quantity+$quantity;
                    $instock = $data['instock']+$quantity;
                    //$query = "UPDATE orders set status='canceled' WHERE user=$_user_id AND id='$oid'";
                    $query = "UPDATE products set $size=$new_quantity,instock=$instock WHERE id=$product";
                    if (mysqli_query($con,$query)){
                        $query = "UPDATE orders set status='canceled' WHERE user=$_user_id AND id='$oid'";
                        if (mysqli_query($con,$query)){
                          header("location:../order?cancel=success");
                        }
                    }
                }else{
                    $query = "select instock from products WHERE id=$product";
                    if ($res = mysqli_query($con,$query) ){
                        $size_quantity = mysqli_fetch_assoc($res)["instock"];
                    }
                    $new_quantity = $size_quantity+$quantity;
                    $query = "UPDATE products set instock=$new_quantity WHERE id=$product";
                    if (mysqli_query($con,$query)){
                        $query = "UPDATE orders set status='canceled' WHERE user=$_user_id AND id='$oid'";
                        if (mysqli_query($con,$query)){
                           header("location:../order?cancel=success");
                        }
                    }else{
                        echo "as";
                    }
                }
            }


        }
    }
}