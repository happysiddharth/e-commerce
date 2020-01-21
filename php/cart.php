<?php
session_start();
if (isset($_SESSION['login_email'])){
    require "config.php";
    $con = mysqli_connect($localhost, $un, $pw, $db);
    if (!$con) die("Something went wrong");
require "../php/template/get_user_id.php";
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y/m/d h:i:s a', time());
    //to update the quantity
    if (isset($_POST['update_quantity'])){
        $q  = mysqli_real_escape_string($con,$_POST['update_quantity']);
        $Product =  mysqli_real_escape_string($con,$_POST['product']);
        $query = "SELECT * from products,cart WHERE products.id='$Product'";
        $in_stock = mysqli_fetch_assoc(mysqli_query($con,$query))['instock'];
        $size_cart =   mysqli_fetch_assoc(mysqli_query($con,$query))[mysqli_fetch_assoc(mysqli_query($con,$query))['size']];
            if ($in_stock>0&&$size_cart>$q){
                if ($q>0){
                    $query ="UPDATE `cart` SET `quantity` = '$q' WHERE `cart`.`user` = $_user_id AND `cart`.`product`=$Product;";

                }else{
                    $query = "DELETE FROM `cart` WHERE `cart`.`user` = $_user_id AND `cart`.`product`=$Product";
                }
                if (mysqli_query($con,$query)){

                    $successfully_update =1;
                }else{
                    echo 'error';
                }
            }elseif ($in_stock>0&&$size_cart==0){
                if ($q>0){
                    $query ="UPDATE `cart` SET `quantity` = '$q' WHERE `cart`.`user` = $_user_id AND `cart`.`product`=$Product;";

                }else{
                    $query = "DELETE FROM `cart` WHERE `cart`.`user` = $_user_id AND `cart`.`product`=$Product";
                }
                if (mysqli_query($con,$query)){

                    $successfully_update =1;
                }else{
                    echo 'error';
                }

            }else{
                if($in_stock<$q){
                    $more_product_adding_than_in_stock = 1;
                }else{
                    $product_out_of_stock_flag = 1;

                }
            }
    }
    //to add into cart when user click on add to cart button
    if (isset($_POST['_product_id'])){
        if (!empty($_POST['_product_id'])){
            $product_id = mysqli_real_escape_string($con,htmlspecialchars($_POST['_product_id']));
            if (isset($_POST['size'])){
                $size = mysqli_real_escape_string($con,htmlspecialchars($_POST['size']));
                $query = "select instock,product_category,$size from products WHERE id='$product_id'";

            }else{
                $query = "select instock,product_category from products WHERE id='$product_id'";

            }

            $category = mysqli_fetch_assoc(mysqli_query($con,$query))['product_category'];

            if ( mysqli_fetch_assoc(mysqli_query($con,$query))['instock']>0){
                if($category==2){
                    if (mysqli_fetch_assoc((mysqli_query($con,$query)))["$size"]>0){
                        $query = "SELECT * from cart WHERE user ='$_user_id' AND product = '$product_id' and size='$size'";

                        if ($res = mysqli_query($con,$query)){

                            if (mysqli_num_rows($res)>0){

                                $previous_quantity = mysqli_fetch_assoc($res)['quantity'];
                                $increase_by_one = (int)$previous_quantity+1;

                                $query = "UPDATE `cart` SET `quantity`='$increase_by_one' WHERE product ='$product_id' AND user='$_user_id'";
                                if (mysqli_query($con,$query)){
                                    $item_added_flag =1;

                                }


                            }else{
                                $query = "INSERT INTO `cart`(`id`, `user`, `product`, `quantity`, `added_on`,`size`) VALUES (NULL ,'$_user_id ','$product_id',1,'$date','$size')";
                                if (mysqli_query($con,$query)){
                                    $item_added_flag =1;
                                }else{
                                    echo "e";
                                }

                            }
                        }
                        else{
                            die("error");
                        }
                    }else{
                        $product_out_of_stock_flag =1;
                    }
                }else{
                    $query = "SELECT * from cart WHERE user ='$_user_id' AND product = '$product_id'";

                    if ($res = mysqli_query($con,$query)){

                        if (mysqli_num_rows($res)>0){

                            $previous_quantity = mysqli_fetch_assoc($res)['quantity'];
                            $increase_by_one = (int)$previous_quantity+1;

                            $query = "UPDATE `cart` SET `quantity`='$increase_by_one' WHERE product ='$product_id' AND user='$_user_id'";
                            if (mysqli_query($con,$query)){
                                $item_added_flag =1;

                            }


                        }else{
                            $query = "INSERT INTO `cart`(`id`, `user`, `product`, `quantity`, `added_on`,`size`) VALUES (NULL ,'$_user_id ','$product_id',1,'$date','$size')";
                            if (mysqli_query($con,$query)){
                                $item_added_flag =1;
                            }else{
                                echo "e";
                            }

                        }
                    }
                    else{
                        die("error");
                    }
                }


            }else{
               $product_out_of_stock_flag =1;
            }



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
        <link href="images/main.png" type="image/x-icon" rel="icon">

        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/navigation_bar.css">
        <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
        <style>
            .main{

                transform: scale(1);
                animation-name: zoom;
                opacity: 1;
                animation-duration: 0.3s;
                -webkit-animation-iteration-count: 1;
                -moz-animation-iteration-count: 1;
                -o-animation-iteration-count: 1;
                animation-iteration-count: 1;
                transform: scale(1);
                -webkit-transition: all linear  0.3s;
                -moz-transition: all linear  0.3s;
                -ms-transition: all linear  0.3s;
                -o-transition: all linear  0.3s;
                transition: all linear  0.3s;            }
            @keyframes zoom {
                from{
                    opacity: 0;
                    -webkit-transform: scale(.5);
                    -moz-transform: scale(.5);
                    -ms-transform: scale(.5);
                    -o-transform: scale(.5);
                    transform: scale(.5);
                }to{
                     opacity: 1;
                     transform: scale(1);
                 }

            }

        </style>
    </head>
    <body>

    <?php
    include "template/menu.php";
    ?>
    <?php


    $query = "select * from cart WHERE user=$_user_id";


    if ($res = mysqli_query($con,$query)){
        $num_of_item = mysqli_num_rows($res);
        $total_price = 0;


    }else{
        die(mysqli_connect_error($con));

    }
    ?>
    <div class="container-fluid main" >

        <div class="row" style="padding: 5px;">
            <?php
            if (isset($_GET['removed'])){
                if (strcmp($_GET['removed'],'true')==0){
                    ?>
                    <div class="container" style="padding:10px;">

                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Item removed</strong>
                        </div>
                    </div>
                    <?php
                }
            }

            if (isset($product_out_of_stock_flag)){
                if ($product_out_of_stock_flag==1){
                    ?>
                    <div class="container" style="padding:10px;">

                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Product that you are try to add is out of stock </strong>
                        </div>
                    </div>
                    <?php
                }
            }

            if (isset($more_product_adding_than_in_stock)){
                if ($more_product_adding_than_in_stock==1){
                    ?>
                    <div class="container" style="padding:10px;">

                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Product quantity overflow.</strong>
                        </div>
                    </div>
                    <?php
                }
            }


            if (isset($item_added_flag)){
                if ($item_added_flag==1){
                    ?>
                    <div class="container" style="padding:10px;">

                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Item Added</strong>
                        </div>
                    </div>
                    <?php
                }
            }

            if (isset($successfully_update)){
                if ($successfully_update=1){
                    ?>
                    <div class="container" style="padding:10px;">

                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Item quantity updated</strong>
                        </div>
                    </div>
                    <?php
                }
            }

            ?>
            <div class="col-lg-8" style="">
                <div class="card" style="width: 100%;height: 500px;overflow-y: scroll">
                    <h5 class="card-header" style="text-align: center">MY CART(<?php echo mysqli_num_rows($res);?>)</h5>
                    <div class="card-body">
                        <?php
                        if ($num_of_item==0){
                            echo "No item in cart";
                        }else {
                            while ($data = mysqli_fetch_assoc($res)) {


                            $product_id = $data['product'];

                            $query = "SELECT * FROM `products` WHERE id='$product_id' ";

                            if ($res1 = mysqli_query($con, $query)) {
                                $data_product = mysqli_fetch_assoc($res1);

                                $total_price+=$data_product['price'];

                                $seller_id = $data_product['_sellor_id'];
                                $query = "SELECT * FROM `seller` WHERE id='$seller_id'";
                                if ($res2 = mysqli_query($con, $query)) {
                                    $seller_info = mysqli_fetch_assoc($res2);
                                }


                            }

                            ?>

                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <?php
                                    if ($data_product['instock']>0){
                                        ?>
                                        <a href="detail_view?_product_id=<?php echo $product_id;?>">

                                            <img
                                                    src="<?php echo substr($data_product['image_path'], 1, strlen($data_product['image_path'])); ?>"
                                                    class="img-thumbnail rounded-top" style="height: 200px;width: 190px;">
                                        </a>
                                        <?php
                                    }else{
                                        ?>
                                        <div style="position:relative;height: 250px;width: 250px;">
                                            <img src="images/out_of_stock.png" style="position:absolute;height: 200px;width: 200px;z-index: 1">
                                            <img src="<?php echo substr($data_product['image_path'], 1, strlen($data_product['image_path'])); ?>" style="position:absolute;height: 200px;width: 200px;">
                                        </div>
                                        <?php
                                    }
                                    ?>

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
                                        Size: <?php
                                        echo $data['size'];
                                        ?><br>
                                        seller:
                                        <?php
                                        echo $seller_info['full name'];
                                        ?><br>
                                        price:
                                        <?php
                                        if ($data['size']!=null){
                                            $price_by_size =$data['size'] . "_price";
                                            echo $data_product[$price_by_size];
                                        }else{
                                            echo $data_product['price'];

                                        }
                                        ?>
                                    </div>
                                    <div class="row">
                                        <div class="row">
                                            <div class="col" style="width: 10px">
                                                <img src="images/icons/close_1-512.png" style="height: 10px;width: 10px;">
                                            </div>
                                            <div class="col" style="margin-left: -10px;">
                                                <a href="./php/remove_from_cart.php?remove_item=<?php echo $data_product['id']; ?>">remove</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="row">
                                        <form method="post" action="cart">
                                            <div class="form-group">
                                                <input type="number" value="<?php echo $data['quantity']; ?>"
                                                       class="form-check-inline" name="update_quantity">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" value="<?php echo $data_product['id']; ?>" name="product">
                                                <input type="submit" value="Update quantity"
                                                       class="btn float-right login_btn btn-block">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                <hr>
                            <?php
                        }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                    <div class="card" >
                        <h5 class="card-header" style="text-align: center">PRICE DETAILS</h5>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    $total_price = 0;
                                    $query = "SELECT * from cart WHERE user='$_user_id'";
                                    if ($res = mysqli_query($con,$query)){
                                        $num_rows = mysqli_num_rows($res);
                                        if ($num_rows>0){
                                            for ($i=0;$i<$num_rows;$i++){
                                                $data = mysqli_fetch_assoc($res);
                                                $p_id = $data['product'];
                                                $quantity = $data['quantity'];

                                                if($data['size']!=null){
                                                    $size_in_cart = $data['size'];
                                                    $which_size_price = $size_in_cart.'_price';
                                                    $query = "SELECT $which_size_price from products WHERE id='$p_id' AND `instock`>0";
                                                    $res1 = mysqli_query($con,$query);
                                                    if ($res1){
                                                        $price_of_product = mysqli_fetch_assoc($res1)[$which_size_price];
                                                        $total_price += $price_of_product * $quantity;
                                                    }
                                                }else{
                                                    $query = "SELECT price from products WHERE id='$p_id' AND `instock`>0";
                                                    $res1 = mysqli_query($con,$query);
                                                    if ($res1){
                                                        $price_of_product = mysqli_fetch_assoc($res1)['price'];
                                                        $total_price += $price_of_product * $quantity;
                                                    }

                                                }

                                            }
                                        }else{
                                        }
                                    }else{
                                        die("error");
                                    }
                                   echo "Total Price: ".$total_price;
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-center">
                                <?php
                                if ($total_price>0){
                                    ?>
                                    <form method="post" action="payment">

                                        <div class="form-group">
                                            <input type="submit" value="PROCEED PAYMENT"
                                                   class="btn float-right  btn-block btn-success">
                                        </div>
                                    </form>
                                    <?php
                                }else{
                                    ?>

                                    <input type="button" VALUE="PROCEED PAYMENT" class="btn float-right  btn-block btn-success" disabled>

                                    <?php
                                }
                                ?>

                            </div>


                        </div>
                    </div>
            </div>
        </div>
    </div>

    </body>
    </html>
<?php
}else{
    echo "unauthorised access";
}