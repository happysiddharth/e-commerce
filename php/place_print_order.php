<?php
session_start();

if (isset($_SESSION['login_email'])){
    if (isset($_POST['_buy_address'])&&isset($_POST['payment_option'])&&isset($_FILES['add_img'])){
        if (!empty($_POST['_buy_address'])&&!empty($_POST['payment_option'])){
            require "config.php";
            $con= mysqli_connect($localhost,$un,$pw,$db);
            if (!$con)die("error");
            require "template/get_user_id.php";


            if ($_FILES['add_img']['size']!=0) {
                $img_file = $_FILES["add_img"]["name"];
                $validExt = array("jpg", "png", "jpeg");

                // upload script here
                $folderName = "../images/products/tshirt_extra";

                //folder name to save in db
                $folderNameDB = "./images/tshirt_extra";


                //getting file extension
                $imageFileType = strtolower(pathinfo($img_file, PATHINFO_EXTENSION));

                // Generate a unique name for the image
                // to prevent overwriting the existing image
                $filePath = $folderName . rand(10000, 990000) . '_' . time() . '.' . "$imageFileType";
                if (move_uploaded_file($_FILES["add_img"]["tmp_name"], $filePath)) {
                    $product = $_SESSION['product_id'];
                    $quantity =1;
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('Y/m/d h:i:s a', time());
                    $amount = $_SESSION['total_money_need_to_paid'];
                    $payment_mode = mysqli_real_escape_string($con,htmlspecialchars($_POST['payment_option']));
                    $address = mysqli_real_escape_string($con,htmlspecialchars($_POST['_buy_address']));
                    $size = $_SESSION['size'];
                    $size_null_flag=0;
                    if($size==null){
                        $size='instock';
                    }
                    $query = "SELECT * from products WHERE id='$product'";
                    if ($ress = mysqli_query($con,$query)){
                        $data_product_table=mysqli_fetch_assoc($ress);
                        if ($data_product_table["$size"]>0&&$data_product_table["$size"]>=$quantity){
                            //test
                            if($size_null_flag==0){
                                $size_decrement = $data_product_table["$size"]-$quantity;
                                $new_quantity = $data_product_table['instock']-$quantity;
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
                                $image = $_POST['image'];

                                $query = "INSERT INTO `orders_images`(`id`, `product`, `user`, `date`, `payment_mode`, `paid_amount`,`status`,`quantity`,`address_`,`city`,`pin`,`size`,`image`) VALUES (NULL,$product,$_user_id,'$date','$payment_mode',$amount,'pending','$quantity','$address_','$city','$pin','$size','$filePath')";
                                if (mysqli_query($con,$query)){
                                    {
                                        header("location:../order?placed=successfully");
                                    }
                                }else{
                                    echo $image;
                                }
                            }
                        }
                    }else{
                        die("error");
                    }
                }
            }
            else{
                $product = $_SESSION['product_id'];
                $quantity =1;
                date_default_timezone_set('Asia/Kolkata');
                $date = date('Y/m/d h:i:s a', time());
                $amount = $_SESSION['total_money_need_to_paid'];
                $payment_mode = mysqli_real_escape_string($con,htmlspecialchars($_POST['payment_option']));
                $address = mysqli_real_escape_string($con,htmlspecialchars($_POST['_buy_address']));
                $size = $_SESSION['size'];
                $size_null_flag=0;
                if($size==null){
                    $size='instock';
                }
                $query = "SELECT * from products WHERE id='$product'";
                if ($ress = mysqli_query($con,$query)){
                    $data_product_table=mysqli_fetch_assoc($ress);
                    if ($data_product_table["$size"]>0&&$data_product_table["$size"]>=$quantity){
                        //test
                        if($size_null_flag==0){
                            $size_decrement = $data_product_table["$size"]-$quantity;
                            $new_quantity = $data_product_table['instock']-$quantity;
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
                                {
                                    header("location:../order?placed=successfully");
                                }
                            }else{
                                echo $image;
                            }
                        }
                    }
                }else{
                    die("error");
                }
            }





        }
    }else{
        echo "s";
    }
}
?>