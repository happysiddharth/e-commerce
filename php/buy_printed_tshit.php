<?php
/**
 * Created by PhpStorm.
 * User: Siddharth
 * Date: 25-Oct-19
 * Time: 12:29 AM
 */

session_start();
if (isset($_SESSION['coupon'])) {
    unset($_SESSION['coupon']);
}
if ((isset($_SESSION['login_email'])&&isset($_POST['_product_id'])&&isset($_POST['size'])))
{
    if (1)
    {
        $size = htmlspecialchars($_POST['size']);
        $product_id = htmlspecialchars($_POST['_product_id']);
        $_SESSION['product_id']=$product_id;
        $_SESSION['size']=$_POST['size'];
        require "./config.php";
        $con = mysqli_connect($localhost, $un, $pw, $db);
        if (!$con) die("Something went wrong");
        $query = "select $size from products WHERE id='$product_id'";

        if (mysqli_fetch_assoc(mysqli_query($con,$query))["$size"]>0){



        if (1) {

   {
               // $query = "UPDATE `products` SET `image_path`='$filePath',`product_name`='$product_name',`product_description`='$product_description',`instock`='$instock',`added_on`='$date',`price`=$_procduct_price WHERE id =$id";
                if (isset($_SESSION['login_email'])) {

                    require "template/get_user_data.php";
                    $data = return_login_user_data($_SESSION['login_email']);

                    $email = $_SESSION['login_email'];

                    $query = "SELECT id FROM `users` WHERE email='$email'";
                    if ($result = mysqli_query($con, $query)) {
                        $id = mysqli_fetch_assoc($result)['id'];
                    } else {
                        die();
                    }



                    ?>

                    <!doctype html>
                    <html>
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport"
                              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        <title>Cart</title>
                        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
                        <link rel="stylesheet" href="css/navigation_bar.css">
                        <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
                        <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
                        <style>
                            .main {

                                transform: scale(1);
                                animation-name: zoom;
                                opacity: 1;
                                animation-duration: 0.3s;
                                -webkit-animation-iteration-count: 1;
                                -moz-animation-iteration-count: 1;
                                -o-animation-iteration-count: 1;
                                animation-iteration-count: 1;
                                transform: scale(1);
                                -webkit-transition: all linear 0.3s;
                                -moz-transition: all linear 0.3s;
                                -ms-transition: all linear 0.3s;
                                -o-transition: all linear 0.3s;
                                transition: all linear 0.3s;
                            }

                            @keyframes zoom {
                                from {
                                    opacity: 0;
                                    -webkit-transform: scale(.5);
                                    -moz-transform: scale(.5);
                                    -ms-transform: scale(.5);
                                    -o-transform: scale(.5);
                                    transform: scale(.5);
                                }
                                to {
                                    opacity: 1;
                                    transform: scale(1);
                                }

                            }
                        </style>
                    </head>
                    <body>

                    <?php
                    include "./template/menu.php";
                    ?>


                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row" style="padding:10px">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header" id="headingFour">
                                                <h5 class="mb-0">
                                                    <p style="height: 30px;width: 30px;background-color: gray;color: white;text-align: center;position: absolute;">
                                                        1</p>
                                                    <a style="text-align: center;width: 100%" class="btn btn-link collapsed"
                                                       data-toggle="collapse" data-target="#collapseOne" aria-expanded="false"
                                                       aria-controls="collapseOne">
                                                        Login as : <strong><?php echo $_SESSION['login_email']; ?></strong>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                <div class="card-body">
                                                    <span style="color: gray;">NAME</span>
                                                    <strong>
                                                        :<?php
                                                        echo strtoupper($data['full name']);
                                                        ?>
                                                    </strong><br>
                                                    <span style="color: gray;">PHONE</span>
                                                    <strong>
                                                        :<?php
                                                        echo strtoupper($data['phone']);
                                                        ?>
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <form method="post" action="php/place_print_order.php" enctype="multipart/form-data" id="main_form">
                                    <div class="row" style="padding:10px">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header" id="headingTwo">
                                                    <h5 class="mb-0">
                                                        <p style="height: 30px;width: 30px;background-color: gray;color: white;text-align: center;position: absolute;">
                                                            2</p>
                                                        <a style="text-align: center;width: 100%;font-weight: bolder"
                                                           class="btn btn-link collapsed"
                                                           data-toggle="collapse" data-target="#two" aria-expanded="false"
                                                           aria-controls="two">
                                                            SELECT ADDRESS
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="two" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                    <div class="card-body">

                                                        <?php
                                                        $query = "SELECT * FROM `addresses` WHERE user='$id'";
                                                        $result = mysqli_query($con, $query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($data = mysqli_fetch_assoc($result)) {
                                                                ?>
                                                                <div class="row">
                                                                    <input type="radio" name="_buy_address"
                                                                           value="<?php echo $data['id']; ?>"
                                                                           required>
                                                                    <div class="col-lg-4 col-md-6" style="display: inline-block;">
                                                                        <strong>City:</strong>
                                                                        <p><?php echo $data['city']; ?></p>

                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6" style="display: inline-block;">
                                                                        <strong>Pin Code:</strong>
                                                                        <p><?php echo $data['pin']; ?></p>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6" style="display: inline-block;">
                                                                        <strong>Address:</strong>
                                                                        <p><?php echo $data['address']; ?></p>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo "No address found";
                                                            ?>

                                                            <a href="addresses?redirect=payment">Add address</a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row" style="padding:10px">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header" id="headingFour">
                                                    <h5 class="mb-0">
                                                        <p style="height: 30px;width: 30px;background-color: gray;color: white;text-align: center;position: absolute;">
                                                            3</p>
                                                        <a style="text-align: center;width: 100%;font-weight: bolder"
                                                           class="btn btn-link collapsed"
                                                           data-toggle="collapse" data-target="#three" aria-expanded="false"
                                                           aria-controls="three">
                                                            ORDER SUMMARY
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="three" class="" aria-labelledby="headingTwo" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <?php
                                                            {
                                                             {
                                                                $query = "SELECT * FROM `products` WHERE id='$product_id' AND instock >0";
                                                                if ($res1 = mysqli_query($con, $query)) {
                                                                    $data_product = mysqli_fetch_assoc($res1);
                                                                    $total_price = $data_product['price'];
                                                                    $seller_id = $data_product['_sellor_id'];
                                                                    $query = "SELECT * FROM `seller` WHERE id='$seller_id'";
                                                                    if ($res2 = mysqli_query($con, $query)) {
                                                                        $seller_info = mysqli_fetch_assoc($res2);
                                                                    }
                                                                }
                                                                if ($data_product['price'] != null) {
                                                                    ?>

                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-12">
                                                                            <a href="detail_view?_product_id=<?php echo $product_id; ?>">
                                                                                <img
                                                                                    src="<?php echo substr($data_product['image_path'], 1, strlen($data_product['image_path'])); ?>"
                                                                                    class="img-thumbnail rounded-top"
                                                                                    style="height: 200px ;width: 200px;">
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-12">
                                                                            <div class="row">
                                                                                <strong>
                                                                                    <?php
                                                                                    echo $data_product['product_name'];
                                                                                    ?>
                                                                                </strong>
                                                                            </div>
                                                                            <div class="row">
                                                                                seller:
                                                                                <?php
                                                                                echo $seller_info['full name'];
                                                                                ?><br>
                                                                                Size:
                                                                                <?php
                                                                                echo $size;
                                                                                ?><br>
                                                                                price:
                                                                                <?php
                                                                                echo $data_product['price'];
                                                                                ?>

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-4 col-md-12">
                                                                            <div class="row">
                                                                                <div class="form-group">
                                                                                    <div id="drag" style="position: relative;padding: 10px;" >
                                                                                        <h6 style="text-align: center;font-weight: bold;color: #868686">Select image</h6>
                                                                                        <div id="preview" >

                                                                                        </div>
                                                                                        <input type="file" name="add_img" >
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <hr>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding:10px">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header" id="headingFour">
                                                    <h5 class="mb-0">
                                                        <p style="height: 30px;width: 30px;background-color: gray;color: white;text-align: center;position: absolute;">
                                                            4</p>
                                                        <a style="text-align: center;width: 100%;font-weight: bolder"
                                                           class="btn btn-link collapsed"
                                                           data-toggle="collapse" data-target="#four" aria-expanded="false"
                                                           aria-controls="four">
                                                            PAYMENT OPTION
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="four" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                    <div class="card-body justify-content-center" style="">
                                                        <div class="form-group">
                                                            <input type="radio" value="cod" name="payment_option" required>&nbsp;CASH ON DELIVERY
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="product_id" value="<?php echo $product_id;?>">

                                                            <input type="submit" value="PALCE ORDER"
                                                                   class="btn   btn-block  btn-primary">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </form>



                            </div>


                            <div class="col-lg-4"  style="padding: 10px;">
                                <div class="" style="width: 100%;">
                                    <div class="card">
                                        <h5 class="card-header" style="text-align: center">PRICE DETAILS</h5>
                                        <div class="card-body">

                                            <div class="card">

                                                <div class="card-body">

                                                    <?php
                                                    if (isset($_POST['coupon'])) {

                                                        if (!empty($_POST['coupon'])) {
                                                            if (isset($_SESSION['coupon'])) {
                                                                $coupon = mysqli_real_escape_string($con, $_POST['coupon']);
                                                                $query = "SELECT * FROM `coupons` where coupon = '$coupon'";
                                                                if ($res = mysqli_query($con, $query)) {
                                                                    if (mysqli_num_rows($res) > 0) {
                                                                        if ($data = mysqli_fetch_assoc($res)) {
                                                                            if ($data['id'] == $_SESSION['coupon']['id']) {
                                                                                echo "coupon already apply";
                                                                            } else {
                                                                                unset($_SESSION['coupon']);
                                                                                $total_price = 0;
                                                                               {

                                                                                   {


                                                                                      {
                                                                                            $data = mysqli_fetch_assoc($res);
                                                                                           // $p_id = $data['product'];
                                                                                            $quantity = $data['quantity'];
                                                                                            $query = "SELECT price from products WHERE id='$product_id' AND `instock`>0";
                                                                                            $res1 = mysqli_query($con, $query);
                                                                                            if ($res1) {
                                                                                                $price_of_product = mysqli_fetch_assoc($res1)['price'];
                                                                                                $total_price += $price_of_product ;
                                                                                            }


                                                                                            $_SESSION['total_money_need_to_paid'] = $total_price;


                                                                                        }
                                                                                    }
                                                                                }
                                                                                $query = "SELECT * FROM `coupons` where coupon = '$coupon'";
                                                                                date_default_timezone_set('Asia/Kolkata');
                                                                                $date = date('Y/m/d h:i:s a', time());
                                                                                if ($res = mysqli_query($con, $query)) {
                                                                                    if ($data = mysqli_fetch_assoc($res)) {
                                                                                        if (strcasecmp($data['coupon'], $coupon) == 0) {
                                                                                            if ($date >= $data['_to']) {
                                                                                                $_SESSION['coupon'] = array("id" => $data['id'], "coupon" => $data['coupon'], "discount" => $data['discount']);
                                                                                            } else {
                                                                                                echo "";
                                                                                            }
                                                                                        } else {
                                                                                            echo "Coupons did not exists";
                                                                                        }
                                                                                    } else {
                                                                                        echo "coupon expired";
                                                                                    }
                                                                                } else {
                                                                                    echo "error";
                                                                                }
                                                                            }
                                                                        }
                                                                    } else {
                                                                        unset($_SESSION['coupon']);
                                                                        $total_price = 0;
                                                                        {
                                                                            {
                                                                               {
                                                                                    $query = "SELECT price from products WHERE id='$product_id' AND `instock`>0 ";
                                                                                    $res1 = mysqli_query($con, $query);
                                                                                    if ($res1) {
                                                                                        $price_of_product = mysqli_fetch_assoc($res1)['price'];
                                                                                        $total_price += $price_of_product ;
                                                                                    }
                                                                                    if (isset($_SESSION['coupon'])) {
                                                                                        $total_price = $total_price - $_SESSION['coupon']['discount'];
                                                                                    }
                                                                                    $_SESSION['total_money_need_to_paid'] = $total_price;

                                                                                }
                                                                            }
                                                                        }
                                                                    }

                                                                }
                                                            } else {
                                                                $coupon = mysqli_real_escape_string($con, $_POST['coupon']);
                                                                $query = "SELECT * FROM `coupons` where coupon = '$coupon'";
                                                                date_default_timezone_set('Asia/Kolkata');
                                                                $date = date('Y/m/d h:i:s a', time());
                                                                if ($res = mysqli_query($con, $query)) {
                                                                    if ($data = mysqli_fetch_assoc($res)) {
                                                                        if (strcasecmp($data['coupon'], $coupon) == 0) {
                                                                            if ($date >= $data['_to']) {
                                                                                $_SESSION['coupon'] = array("id" => $data['id'], "coupon" => $data['coupon'], "discount" => $data['discount']);
                                                                            } else {
                                                                                echo "adsd";
                                                                            }
                                                                        } else {
                                                                            echo "Coupons did not exists";
                                                                        }
                                                                    } else {
                                                                        echo "coupon expired";
                                                                    }
                                                                } else {
                                                                    echo "error";
                                                                }
                                                            }

                                                        }
                                                    }
                                                    ?>

                                                    <?php
                                                    $total_price = 0;
                                                  {
                                                       {
                                                            {
                                                                $query = "SELECT price from products WHERE id='$product_id' AND `instock`>0";
                                                                $res1 = mysqli_query($con, $query);
                                                                if ($res1) {
                                                                    $price_of_product = mysqli_fetch_assoc($res1)['price'];
                                                                    $total_price = $price_of_product ;
                                                                }
                                                                if (isset($_SESSION['coupon'])) {
                                                                    $total_price = $total_price - $_SESSION['coupon']['discount'];
                                                                }
                                                                $_SESSION['total_money_need_to_paid'] = $total_price;
                                                            }
                                                        }
                                                    }
                                                    echo "Total Price: " . $total_price;
                                                    ?>

                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row justify-content-center">
                                                <form method="post" action="buy_printed">
                                                    <div class="form-group">
                                                        <input type="text" name="coupon" placeholder="COUPONS">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="submit" value="APPLY COUPON"
                                                               class="btn float-right  btn-block btn-success">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <script>
                         document.querySelector("input[name='add_img']").addEventListener('change',function (e) {
                         let reader = new FileReader();
                         reader.onload = function () {
                         let div = document.createElement('div');
                         div.style.cssText='position:absolute';
                         div.setAttribute('id','e_img')
                         let close = document.createElement('span');
                         close.innerText='x';
                         close.setAttribute('id','close');
                         close.style.cssText='color:red;height:20px;width:20px;border-radius:10px;position:absolute;top:-10px;right:0px;font-weight:bold;z-index:9999999;background:gray;text-align:center;box-shadow: 10px 10px 12px -5px rgba(0,0,0,0.75);cursor:pointer;';


                         let i = document.createElement('img');
                         x = reader.result;
                         i.setAttribute('src',reader.result);
                         i.setAttribute('id','e_img');


                         i.style.position='relative';
                         i.style.height='100px';
                         i.style.widht='100px';
                         i.style.userSelect='none';

                         div.style.zIndex="999999";



                         if(!document.getElementById('e_img')){
                         div.appendChild(close);
                         div.appendChild(i);
                         document.getElementById('preview').appendChild(div);
                         close.onclick=function () {
                         div.innerText='';
                         // ;

                         }

                         }else{
                         document.getElementById('e_img').appendChild(close);
                         document.getElementById('e_img').appendChild(i);
                         document.getElementById('close').onclick=function () {
                         div.innerText='';
                         // ;

                         }
                         }



                         }
                         reader.readAsDataURL(e.target.files[0]);
                         });
                    </script>

                    </body>
                    </html>



                    <?php
                }
            }
        }
    }else{
            echo'<h1>We are really sorry,the product you are try to add in out of stock</h1>';
        }
}
}else{
    header('location:login');
}