<?php
session_start();

if (isset($_SESSION['seller_login_email'])){

            if (isset($_FILES["img_file"])) {
                $img_file = $_FILES["img_file"]["name"];
                $validExt = array("jpg", "png", "jpeg");

                // upload script here
                $folderName = "../images/products/product";

                //folder name to save in db
                $folderNameDB = "./images/products";


                //getting file extension
                $imageFileType = strtolower(pathinfo($img_file, PATHINFO_EXTENSION));

                // Generate a unique name for the image
                // to prevent overwriting the existing image
                $filePath = $folderName . rand(10000, 990000) . '_' . time() . '.' . "$imageFileType";

                //$file_path_to_save_in_db  =  $folderNameDB. rand(10000, 990000). '_'. time().'.'."$imageFileType";

                if (move_uploaded_file($_FILES["img_file"]["tmp_name"], $filePath)) {
                    require "config.php";
                    $con = mysqli_connect($localhost, $un, $pw, $db);
                    if (!$con) die("Something went wrong");

                    $email = $_SESSION['seller_login_email'];
                    echo $email;

                    $query = "SELECT id FROM `seller` WHERE email='$email'";
                    if ($result = mysqli_query($con, $query)) {
                        $id = mysqli_fetch_assoc($result)['id'];
                    } else {
                        die();
                    }


                    $product_name = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['_product_name'])));
                    $product_description = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['_procduct_description'])));

                    $product_category = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['_product_category'])));
                    if ($product_category==2)
                    {
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
                        $query = "INSERT INTO `products`(`id`, `image_path`, `product_name`, `product_description`, `instock`, `product_category`, `added_on`,`_sellor_id`,`price`, `xs`, `s`,`m`, `l`, `xl`, `xxl`, `xs_price`, `s_price`, `m_price`, `l_price`, `xl_price`, `xxl_price`) VALUES (NULL ,'$filePath','$product_name','$product_description','$instock','$product_category','$date','$id','$_procduct_price','$instock_xs','$instock_s','$instock_m','$instock_l','$instock_xl','$instock_xxl',$xs_price,$s_price,$m_price,$l_price,$xl_price,$xxl_price)";

                    }else{
                        $instock = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['procduct_instock'])));
                        $query = "INSERT INTO `products`(`id`, `image_path`, `product_name`, `product_description`, `instock`, `product_category`, `added_on`,`_sellor_id`,`price`) VALUES (NULL ,'$filePath','$product_name','$product_description','$instock','$product_category','$date','$id','$_procduct_price')";

                    }
                    $_procduct_price = mysqli_real_escape_string($con, htmlspecialchars(trim($_POST['_procduct_price'])));


                    date_default_timezone_set('Asia/Kolkata');

                    $date = date("y-m-d m:s:i");







                    if (mysqli_query($con, $query)) {
                        header("location:../sellerdashboard?upload=true");
                    } else {
                        die("errorr");
                    }

                } else {
                    echo "error";
                }


            }else{
                echo "errore";
            }


}