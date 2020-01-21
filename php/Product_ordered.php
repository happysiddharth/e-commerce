<?php
session_start();
if (isset($_SESSION['seller_login_email'])) {
    ?>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Out of stock products</title>
        <link href="images/main.png" type="image/x-icon" rel="icon">

        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/navigation_bar.css">
        <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
        <style>
            body {
                padding: 0;
                margin: 0;
                background: whitesmoke;
            }

            #aside .card {
                width: 100%;

            }

            #collapseOne {
                width: 100%;
            }

            .card {

                margin-bottom: auto;

                width: 100%;
                animation-name: zoom;
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

            .card-body, form {
                width: 100%;
            }

            form {
                width: 100%;
            }

            @keyframes zoom {
                from {
                    -webkit-transform: scale(.5);
                    -moz-transform: scale(.5);
                    -ms-transform: scale(.5);
                    -o-transform: scale(.5);
                    transform: scale(.5);
                }
                to {
                    transform: scale(1);
                }

            }

            .divider-text span {
                padding: 7px;
                font-size: 12px;
                position: relative;
                z-index: 2;
            }


        </style>
    </head>
    <body>
    <div class="container-fluid">
        <?php
        include "template/menu.php";
        ?>
        <div class="row">
            <div class="col-lg-2">
                <div id="aside" style="margin-left: 5px ">
                    <div >

                        <div class="card" style="  width: 100%;
            margin-top: 2px;">
                            <div class="card-header" >
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Account settings
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show"  data-parent="#accordion">
                                <div class="card-body">
                                    <a href="profile" style="color: black;">
                                        Personal settings
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Products
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <a href="outofstockproducts" style="color: black;">
                                        Out of stock products
                                    </a><br>
                                    <a href="product_ordered" style="color: black;">
                                        Product placed
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <?php
                if (isset($_GET['update'])){
                    if (strcmp($_GET['update'],'success')==0){
                        ?>
                        <div class="container" style="padding:10px;">

                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>product shipped successfully</strong>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <?php

                require "../php/config.php";
                $con = mysqli_connect($localhost,$un,$pw,$db);
                if (!$con)die("error");

                require "../php/template/get_seller_id_by_email.php";


                $query = "SELECT * FROM products  INNER  JOIN `orders`  ON   products.id =orders.product where products._sellor_id =$_seller_id AND `orders`.status ='pending' ORDER BY orders.date DESC ";
                if ($res=mysqli_query($con,$query)){
                    if (mysqli_num_rows($res)>0){

                        while ($data = mysqli_fetch_assoc($res)){
                            $user = $data['user'];
                            $size = $data['size'];
                            $query = "select * from `users` INNER JOIN `addresses` ON users.id = addresses.user WHERE users.id=$user";
                            if ($result = mysqli_query($con,$query)){
                                while ($data_user = mysqli_fetch_assoc($result)){
                                    ?>
                                    <div class="card " style="margin-bottom: 10px">
                                        <div class="card-header">
                                            <div class="row" >
                                                <div class="order_id col-lg-3 " >
                                                    <button  class="btn-primary btn-block">
                                                      <a href="" style="color: white;">
                                                          <?php
                                                         echo($data['id']);
                                                          ?>
                                                      </a>
                                                    </button>

                                                </div>
                                                <div class="col-lg-6">

                                                </div>
                                                <div class="col-lg-3" style="background-color:#E0E0E0;text-align: center;vertical-align: 100%">
                                        <span >
                                            Order status
                                        </span>

                                                    <strong>
                                                        <?php
                                                        echo $data['status']
                                                        ?>
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <a href="detail_view?_product_id=<?php echo $data['product'];?>">
                                                        <img src="<?php echo substr($data['image_path'],1,strlen($data['image_path']));?> " style="height: 100px;width: 150px;">
                                                    </a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <p style="font-weight: bold">

                                                            <?php
                                                            echo $data['product_name'];
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <div class="row">
                                            <span style="color: gray">
                                                Quantity:
                                            </span>
                                                        <p style="font-weight: bold">
                                                            <?php
                                                            echo $data['quantity'];
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <?php
                                                    if ($size!=null){
                                                        ?>
                                                        <div class="row">
                                            <span style="color: gray">
                                                Size:
                                            </span>
                                                            <p style="font-weight: bold">
                                                                <?php
                                                                echo $size;
                                                                ?>
                                                            </p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>

                                                    <div class="row">
                                    <span style="color:gray">
                                        Name of customer:
                                    </span>
                                                        <?php
                                                        echo " ".$data_user['full name'];
                                                        ?>
                                                    </div>
                                                    <div class="row">
                                    <span style="color:gray">
                                        Address:
                                        <?php
                                        echo " ".$data['address_'];
                                        echo " ".$data['pin'];
                                        echo " ".$data['city'];
                                        ?>
                                    </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <?php
                                                    if (strcasecmp($data['status'],'pending')==0){
                                                        ?>
                                                        <form method="post" action="php/cancel.php">
                                                            <input type="hidden" name="order_id" value="<?php echo $data['id'];?>">
                                                            <div class="form-group">
                                                                <input type="submit" value="CANCEL ORDER"
                                                                       class="btn  btn-block btn-danger">
                                                            </div>
                                                        </form>

                                                            <div class="card" style="  width: 100%;
            margin-top: 2px;">

                                                                        <button class="btn  btn-block btn-success " data-toggle="collapse" data-target="#collapse<?php echo $data['id'];?>" >
                                                                           ENTER COURIER DETAILS
                                                                        </button>


                                                                <div id="collapse<?php echo $data['id'];?>" class="collapse"  data-parent="#accordion">
                                                                    <div class="card-body">
                                                                       <form method="post" action="php/save_tracking_info.php">
                                                                           <input type="hidden" name="order_id" value="<?php echo $data['id'];?>">
                                                                           <div class="form-group">
                                                                               <input type="text" name="_courier_name" placeholder="COURIES COMPANY NAME" required>
                                                                           </div>

                                                                           <div class="form-group">
                                                                               <input type="text" name="_tracking_no" placeholder="TRACKING NO" required>
                                                                           </div>
                                                                           <input type="submit" value="SUBMIT" class="btn btn-primary">

                                                                       </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <div class="row">
                                                <div class="order_id col-lg-3">
                                                    <span>Ordered on </span>
                                                    <strong><?php
                                                        echo $data['date'];
                                                        ?></strong>
                                                </div>
                                                <div class="col-lg-6">

                                                </div>
                                                <div class="col-lg-3">
                                <span>
                                    Order Total
                                </span>
                                                    <strong>
                                                        <?php
                                                        echo  $data['paid_amount'];
                                                        ?>
                                                    </strong>

                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <?php
                                }
                            }

                            ?>


                                    <?php





                        }

                    }else{
                        ?>
                        <h3>On orders
                        </h3>
                        <?php
                    }
                }else{
                    echo "error";
                }
                ?>

            </div>
        </div>
    </div>

    </body>
    </html>
    <?php
}
?>
