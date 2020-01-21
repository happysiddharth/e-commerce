<?php
session_start();

if (isset($_SESSION['coupon'])) {
    unset($_SESSION['coupon']);
}
if (isset($_SESSION['login_email'])) {

    require "template/get_user_data.php";
    $data = return_login_user_data($_SESSION['login_email']);
    require "./config.php";
    $con = mysqli_connect($localhost, $un, $pw, $db);
    if (!$con) die("Something went wrong");
    $email = $_SESSION['login_email'];

    $query = "SELECT id FROM `users` WHERE email='$email'";
    if ($result = mysqli_query($con, $query)) {
        $id = mysqli_fetch_assoc($result)['id'];
    } else {
        die();
    }

    if (isset($_POST['update_quantity'])) {

        $q = mysqli_real_escape_string($con, $_POST['update_quantity']);
        $Product = mysqli_real_escape_string($con, $_POST['product']);

        if ($q > 0) {
            $query = "UPDATE `cart` SET `quantity` = '$q' WHERE `cart`.`user` = $id AND `cart`.`product`=$Product;";

        } else {
            $query = "DELETE FROM `cart` WHERE `cart`.`user` = $id AND `cart`.`product`=$Product";
        }

        if (mysqli_query($con, $query)) {

            $successfully_update = 1;
        } else {
            echo 'error';
        }

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
                <form method="post" action="php/confirm.php">
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
                                <div id="two" class="collapsed" aria-labelledby="headingTwo" data-parent="#accordion">
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
                                <div id="three" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        <?php


                                        $query = "select * from cart WHERE user=$id";


                                        if ($res = mysqli_query($con, $query)) {
                                            $num_of_item = mysqli_num_rows($res);

                                            $total_price = 0;


                                        } else {
                                            die(mysqli_connect_error($con));

                                        }


                                        if ($num_of_item == 0) {
                                            ?>
                                            <a href="./"
                                               style="width: 150px;height: 100px;border: 1px solid gray;background-color: green;text-decoration: none;color: white;padding: 5px;">CONTINUE
                                                SHOPPING</a>
                                            <?php
                                        } else {
                                            while ($data = mysqli_fetch_assoc($res)) {


                                                $product_id = $data['product'];


                                                $query = "SELECT * FROM `products` WHERE id='$product_id' AND instock >0";
                                                if ($res1 = mysqli_query($con, $query)) {
                                                    if (  $data['size']!=null){
                                                        $size_cart = $data['size'];
                                                        $pr = $size_cart.'_price';


                                                    }else{
                                                        $pr = 'price';
                                                    }
                                                    $data_product = mysqli_fetch_assoc($res1);
                                                    $total_price += $data_product[$pr];
                                                    $seller_id = $data_product['_sellor_id'];
                                                    $query = "SELECT * FROM `seller` WHERE id='$seller_id'";
                                                    if ($res2 = mysqli_query($con, $query)) {
                                                        $seller_info = mysqli_fetch_assoc($res2);
                                                    }

                                                }
                                                if ($total_price != null) {
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

                                                                <?php
                                                                if ($data['size']!=null){
                                                                    echo " Size:".$data['size'];
                                                                }

                                                                ?><br>
                                                                price:
                                                                <?php
                                                                echo $data_product[$pr];
                                                                ?>

                                                            </div>

                                                            <div class="row">
                                                                <div class="row">
                                                                    <div class="col" style="width: 10px">
                                                                        <img src="images/icons/close_1-512.png"
                                                                             style="height: 10px;width: 10px;">
                                                                    </div>
                                                                    <div class="col" style="margin-left: -10px;">
                                                                        <a href="./php/remove_from_cart.php?remove_item=<?php echo $data_product['id']; ?>">remove</a>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="col-lg-4 col-md-12">
                                                            <div class="row">

                                                                <div class="form-group">
                                                                    <label>QUANTITY</label>
                                                                    <input type="number"
                                                                           value="<?php echo $data['quantity']; ?>"
                                                                           class="form-check-inline" name="update_quantity"
                                                                           disabled>
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
                                            if (!isset($_SESSION['coupon'])) {
                                                $coupon = mysqli_real_escape_string($con, $_POST['coupon']);
                                                $query = "SELECT * FROM `coupons` where coupon = '$coupon'";
                                                if ($res = mysqli_query($con, $query)) {
                                                    if (mysqli_num_rows($res) > 0) {
                                                        if ($data = mysqli_fetch_assoc($res)) {
                                                            if (0) {
                                                                echo "<h5>coupon already apply</h5>";
                                                            } else {
                                                                unset($_SESSION['coupon']);
                                                                $total_price = 0;
                                                                $query = "SELECT * from cart WHERE user='$_user_id'";
                                                                if ($res = mysqli_query($con, $query)) {
                                                                    $num_rows = mysqli_num_rows($res);
                                                                    if ($num_rows > 0) {
                                                                        for ($i = 0; $i < $num_rows; $i++) {
                                                                            $data = mysqli_fetch_assoc($res);
                                                                            $p_id = $data['product'];
                                                                            if (  $data['size']!=0){
                                                                                $size_cart = $data['size'];
                                                                                $pr = $size_cart.'_price';
                                                                                $stock=$size;

                                                                            }else{
                                                                                $pr = 'price';
                                                                                $stock='instock';
                                                                            }
                                                                            $quantity = $data['quantity'];
                                                                            $query = "SELECT $pr from products WHERE id='$p_id' AND `instock`>0";
                                                                            $res1 = mysqli_query($con, $query);
                                                                            if ($res1) {
                                                                                $price_of_product = mysqli_fetch_assoc($res1)[$pr];
                                                                                $total_price += $price_of_product * $quantity;
                                                                            }




                                                                        }                                                                            $_SESSION['total_money_need_to_paid'] = $total_price;
                                                                        $_SESSION['total_money_need_to_paid'] = $total_price;

                                                                    }
                                                                } else {
                                                                    die("error");
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
                                                                                echo "Coupon expired";
                                                                            }
                                                                        } else {
                                                                            echo "Coupons did not exists";
                                                                        }
                                                                    } else {
                                                                        echo "Coupons did not exists";
                                                                    }
                                                                } else {
                                                                    echo "error";
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        echo "Coupon does not exists";
                                                    /*    unset($_SESSION['coupon']);
                                                        $total_price = 0;
                                                        $query = "SELECT * from cart WHERE user='$_user_id'";
                                                        if ($res = mysqli_query($con, $query)) {
                                                            $num_rows = mysqli_num_rows($res);
                                                            if ($num_rows > 0) {


                                                                for ($i = 0; $i < $num_rows; $i++) {
                                                                    $data = mysqli_fetch_assoc($res);
                                                                    $p_id = $data['product'];
                                                                    $quantity = $data['quantity'];
                                                                    if (  $data['size']!=null){
                                                                        $size_cart = $data['size'];
                                                                        $pr = $size_cart.'_price';
                                                                    }else{
                                                                        $pr = 'price';
                                                                    }
                                                                    $query = "SELECT $pr from products WHERE id='$p_id' AND `instock`>0";
                                                                    $res1 = mysqli_query($con, $query);
                                                                    if ($res1) {
                                                                        $price_of_product = mysqli_fetch_assoc($res1)['$pr'];
                                                                        $total_price += $price_of_product * $quantity;
                                                                    }
                                                                    if (isset($_SESSION['coupon'])) {

                                                                        $total_price = $total_price - $_SESSION['coupon']['discount'];

                                                                    }
                                                                    $_SESSION['total_money_need_to_paid'] = $total_price;


                                                                }
                                                            } else {
                                                            }
                                                        } else {
                                                            die("error");
                                                        }*/
                                                    }

                                                }
                                            } else {
                                               /* $coupon = mysqli_real_escape_string($con, $_POST['coupon']);
                                                $query = "SELECT * FROM `coupons` where coupon = '$coupon'";
                                                date_default_timezone_set('Asia/Kolkata');
                                                $date = date('Y/m/d h:i:s a', time());
                                                if ($res = mysqli_query($con, $query)) {
                                                    if ($data = mysqli_fetch_assoc($res)) {
                                                        if (strcasecmp($data['coupon'], $coupon) == 0) {
                                                            if ($date >= $data['_to']) {
                                                                $_SESSION['coupon'] = array("id" => $data['id'], "coupon" => $data['coupon'], "discount" => $data['discount']);
                                                            } else {
                                                                echo "Coupon expired";
                                                            }
                                                        } else {
                                                            echo "Coupons did not exists";
                                                        }
                                                    }
                                                } else {
                                                    echo "error";
                                                }*/

                                                $coupon = mysqli_real_escape_string($con, $_POST['coupon']);
                                                $query = "SELECT * FROM `coupons` where coupon = '$coupon'";
                                                if ($res = mysqli_query($con, $query)) {
                                                    if (mysqli_num_rows($res) > 0) {
                                                        if ($data = mysqli_fetch_assoc($res)) {
                                                            if ($data['id'] == $_SESSION['coupon']['id']) {
                                                                echo "<h5>coupon already apply</h5>";
                                                            } else {
                                                                unset($_SESSION['coupon']);
                                                                $total_price = 0;
                                                                $query = "SELECT * from cart WHERE user='$_user_id'";
                                                                if ($res = mysqli_query($con, $query)) {
                                                                    $num_rows = mysqli_num_rows($res);
                                                                    if ($num_rows > 0) {
                                                                        for ($i = 0; $i < $num_rows; $i++) {
                                                                            $data = mysqli_fetch_assoc($res);
                                                                            $p_id = $data['product'];
                                                                            if (  $data['size']!=null){
                                                                                $size_cart = $data['size'];
                                                                                $pr = $size_cart.'_price';
                                                                                $stock=$size;

                                                                            }else{
                                                                                $pr = 'price';
                                                                                $stock='instock';
                                                                            }
                                                                            $quantity = $data['quantity'];
                                                                            $query = "SELECT $pr from products WHERE id='$p_id' AND $stock>0";
                                                                            $res1 = mysqli_query($con, $query);
                                                                            if ($res1) {
                                                                                $price_of_product = mysqli_fetch_assoc($res1)[$pr];
                                                                                $total_price += $price_of_product * $quantity;
                                                                            }




                                                                        }                                                                            $_SESSION['total_money_need_to_paid'] = $total_price;
                                                                        $_SESSION['total_money_need_to_paid'] = $total_price;

                                                                    }
                                                                } else {
                                                                    die("error");
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
                                                                                echo "Coupon expired";
                                                                            }
                                                                        } else {
                                                                            echo "Coupons did not exists";
                                                                        }
                                                                    } else {
                                                                        echo "Coupons did not exists";
                                                                    }
                                                                } else {
                                                                    echo "error";
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        echo "Coupon does not exists";

                                                    }

                                                }
                                            }

                                        }
                                    }
                                    ?>

                                    <?php
                                    $total_price = 0;
                                    $query = "SELECT * from cart WHERE user='$_user_id'";
                                    if ($res = mysqli_query($con, $query)) {
                                        $num_rows = mysqli_num_rows($res);
                                        if ($num_rows > 0) {
                                            for ($i = 0; $i < $num_rows; $i++) {
                                                $data = mysqli_fetch_assoc($res);
                                                $p_id = $data['product'];
                                                $quantity = $data['quantity'];
                                                if ($data['size'] != null) {
                                                    $size_cart = $data['size'];
                                                    $pr = $size_cart . '_price';
                                                    $stock = $data['size'];
                                                } else {
                                                    $pr = 'price';
                                                    $stock = 'instock';

                                                }
                                                $query = "SELECT $pr from products WHERE id='$p_id' AND $stock>0";
                                                $res1 = mysqli_query($con, $query);
                                                if ($res1) {
                                                    $price_of_product = mysqli_fetch_assoc($res1)[$pr];
                                                    $total_price += $price_of_product * $quantity;
                                                }
                                            }
                                                if (isset($_SESSION['coupon'])) {

                                                    $total_price = $total_price - $_SESSION['coupon']['discount'];

                                                }


                                            
                                            $_SESSION['total_money_need_to_paid'] = $total_price;

                                        } else {
                                        }
                                    } else {
                                        die("error");
                                    }
                                    echo "Total Price: " . $total_price;
                                    ?>

                                </div>
                            </div>


                            <hr>

                            <div class="row justify-content-center">
                                <form method="post" action="payment">
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


    </body>
    </html>


    <?php
}

?>