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

        require "config.php";
        $con = mysqli_connect($localhost,$un,$pw,$db);
        if (!$con)die("error");
        $seller_email = $_SESSION['seller_login_email'];

        $query= "select * from seller WHERE email='$seller_email'";
        if ($res = mysqli_query($con,$query)){
            $data = mysqli_fetch_assoc($res);

        }
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
                                    <a href="update_seller" style="color: black;">
                                        Personal settings
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a href="sellerdashboard" style="color: black;">
                                        Add new products
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
                //display update response

                if (isset($_GET['update'])){
                    if (strcmp($_GET['update'],'success')==0){
                        ?>

                        <div class="container" style="padding:10px;position:relative;width:80%;margin-left: 15%">

                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" >&times;</a>
                                <strong>Data updated successfully</strong>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="d-flex justify-content-center">

                    <div class="card" >
                        <article class="card-body mx-auto">
                            <div class="card-header">
                                <h4 class="card-title mt-3 text-center" style="color: black">Update profile</h4>
                            </div>

                            <div class="card-body">
                                <form method="post" action="php/update_seller_main_code.php">
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <img src="images/icons/avatar.png" style="height: 20px;width: 20px;"> </span>
                                        </div>
                                        <input name="_new_seller_fname" class="form-control" placeholder="Full name" type="text" <?php

                                        echo "value='".$data['full name']."'";
                                               ?>    required
                                        >
                                    </div>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">  <img src="images/icons/arroba.png" style="height: 20px;width: 20px;"></span>
                                        </div>
                                        <input name="_new_seller_email" class="form-control" placeholder="Email address" type="email"
                                          value="<?php echo $data['email'];?>" disabled required>
                                    </div>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                <span class="input-group-text"><img src="images/icons/phone-call.png"
                                                                    style="height: 20px;width: 20px;"></span>
                                        </div>
                                        <select class="custom-select" style="max-width: 70px;">
                                            <option selected="" value="91">+91</option>

                                        </select>
                                        <input name="_new_seller_phone" class="form-control" placeholder="Phone number"
                                               type="text" <?php


                                            echo "value=".$data['phone']."";


                                        ?>
                                               value="<?php
                                               echo $data['phone']
                                               ?>"
                                               maxlength="10" required>
                                    </div>







                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"> Update Profile  </button>
                                    </div>
                                </form>
                            </div>
                        </article>
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