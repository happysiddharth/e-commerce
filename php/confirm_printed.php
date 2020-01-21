<?php

session_start();

if (isset($_SESSION['login_email'])){
    if (isset($_POST['_buy_address'])&&isset($_POST['payment_option'])&&isset($_SESSION['image'])&&isset($_SESSION['product_id'])){
        if (!empty($_POST['_buy_address'])&&!empty($_POST['payment_option'])){
            require "config.php";
            $con= mysqli_connect($localhost,$un,$pw,$db);
            if (!$con)die("error");
            require "template/get_user_id.php";
           {
              {
                    $product = $_SESSION['product_id'];
                    $quantity = 1;
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('Y/m/d h:i:s a', time());
                    $amount = $_SESSION['total_money_need_to_paid'];
                    $payment_mode = mysqli_real_escape_string($con,htmlspecialchars($_POST['payment_option']));
                    $address = mysqli_real_escape_string($con,htmlspecialchars($_POST['_buy_address']));
                    $size = $_SESSION['size'];
                    $size_null_flag=0;
                    if($size==NULL){
                        $size_null_flag=1;
                        $size=0;
                    }
                    $query = "SELECT * from products WHERE id='$product'";
                    if ($ress = mysqli_query($con,$query)){
                        $data_product_table=mysqli_fetch_assoc($ress);
                        if ($data_product_table[$size]>0&&$data_product_table['instock']>=$quantity){
                            //test
                            if($size_null_flag==0){
                                $size_decrement = $data_product_table["$size"]-$quantity;
                                $new_quantity = $data_product_table['instock']-$size_decrement;
                                $query = "UPDATE products set $size='$size_decrement', `instock`='$new_quantity' WHERE id ='$product'";
                            }else{
                                $new_quantity = $data_product_table['instock']-$quantity;
                                $query = "UPDATE products set `instock`='$new_quantity' WHERE id ='$product'";
                            }

                            if (mysqli_query($con,$query)){
                                $query = "select * from addresses where id='$address'";
                                $result = mysqli_fetch_assoc(mysqli_query($con,$query));
                                $address_ = $result['address'];
                                $pin = $result['pin'];
                                $city = $result['city'];
                                $query = "INSERT INTO `orders`(`id`, `product`, `user`, `date`, `payment_mode`, `paid_amount`,`status`,`quantity`,`address_`,`city`,`pin`,`size`) VALUES (NULL,$product,$_user_id,'$date','$payment_mode',$amount,'pending','$quantity','$address_','$city','$pin','$size')";
                                if (mysqli_query($con,$query)){

                                    if (mysqli_query($con,$query)){
                                        header("location:../order?placed=successfully");
                                    }
                                }else{
                                    $query = "UPDATE products set instock='$quantity' WHERE id ='$product'";

                                    if (mysqli_query($con,$query)){
                                        die("action reverted");
                                    }

                                }
                            }
                        }
                    }else{
                        die("error");
                    }


                }
            }
        }
    }
}
?>