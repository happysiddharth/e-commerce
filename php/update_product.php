<?php
session_start();
if (isset($_SESSION['seller_login_email'])){
    if (isset($_POST['update'])){


        require "config.php";
        $con = mysqli_connect($localhost, $un, $pw, $db);
        if (!$con) die("Something went wrong");

        $email = $_SESSION['seller_login_email'];

        $product_name = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['product_name'])));
        $product_description = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['procduct_description'])));
        $instock = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['procduct_instock'])));
        $_procduct_price = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['procduct_price'])));
        $id = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['id'])));

        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y/m/d h:i:s a', time());
        if (isset($_POST['_procduct_instock_xs'])){
            $instock_xs = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['_procduct_instock_xs'])));
            $instock_s = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['_procduct_instock_s'])));
            $instock_m = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['_procduct_instock_m'])));
            $instock_l = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['_procduct_instock_l'])));
            $instock_xl = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['_procduct_instock_xl'])));
            $instock_xxl = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['_procduct_instock_xxl'])));

            $xs_price = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['price_xs'])));
            $s_price = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['price_s'])));
            $m_price = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['price_m'])));
            $l_price = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['price_l'])));
            $xl_price = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['price_xl'])));
            $xxl_price = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['price_xxl'])));
            //instock all the available sizes sum
            $instock = $instock_xs+$instock_s+$instock_m+$instock_l+$instock_xl+$instock_xxl;
        }









        if ($_FILES["img_file"]['size']!=0) {
            $img_file = $_FILES["img_file"]["name"];
            $validExt = array("jpg", "png", "jpeg");

            // upload script here

            // upload script here
            $folderName = "../images/products/product";

            //folder name to save in db
            $folderNameDB = "./images/products";


            //getting file extension
            $imageFileType = strtolower(pathinfo($img_file, PATHINFO_EXTENSION));

            // Generate a unique name for the image
            // to prevent overwriting the existing image
            $filePath = $folderName . rand(10000, 990000) . '_' . time() . '.' . "$imageFileType";

            if (move_uploaded_file($_FILES["img_file"]["tmp_name"], $filePath)) {



                $query = "Select image_path,product_category from products WHERE id=$id;";

                if ($res = mysqli_query($con, $query)) {
                    $data = mysqli_fetch_assoc($res);
                    if ($data['product_category']==2){
                        $query = "UPDATE `products` SET `image_path`='$filePath',`product_name`='$product_name',`product_description`='$product_name',`instock`='$instock',`price`='$_procduct_price',`xs`='$instock_xs',`s`='$instock_s',`m`='$instock_m',`l`='$instock_l',`xl`='$instock_xl',`xxl`='$instock_xxl',`xs_price`='$xs_price',`s_price`='$s_price',`m_price`='$m_price',`l_price`='$l_price',`xl_price`='$xl_price',`xxl_price`='$xxl_price' WHERE id=$id";

                    }else{
                        $query = "UPDATE `products` SET `image_path`='$filePath',`product_name`='$product_name',`product_description`='$product_description',`instock`='$instock',`added_on`='$date',`price`=$_procduct_price WHERE id =$id";

                    }
                    $file_path_old = mysqli_fetch_assoc($res)['image_path'];
                    if (1){
                        if($res = mysqli_query($con,$query)){

                            header("location:../sellerdashboard?upload=true");


                        }
                    }


                } else {
                    die(mysqli_error($con));
                }

            }
        }
        else{

            $query = "UPDATE `products` SET `product_name`='$product_name',`product_description`='$product_description',`instock`='$instock',`added_on`='$date',`price`=$_procduct_price WHERE id =$id";


            if (mysqli_query($con, $query)) {
                header("location:../sellerdashboard?upload=true");

            } else {
                die("errorr");
            }


        }


    }
}