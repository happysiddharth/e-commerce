<?php
session_start();
if (isset($_SESSION['seller_login_email']))
    {
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


            if (isset($_GET['upload'])) {
                if (strcmp($_GET['upload'], 'true') == 0) {
                    ?>
                    <div class="container" style="padding:10px;margin-left: 18%;width: 80%">

                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Product added successfully</strong>
                        </div>
                    </div>
                    <?php
                }
            }

            ?>


            <div class="row">
                <div class="col-lg-2">
                    <div id="aside" style="margin-left: 5px ">
                        <div>
                            <div class="card" style="  width: 100%;
            margin-top: 2px;">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                            Account settings
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
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
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
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
                    <h3 style="text-align: center">OUT OF STOCK PRODUCTS</h3>
                    <div class="container-fluid ">
                        <?php
                        require "config.php";
                        $con = mysqli_connect($localhost,$un,$pw,$db);
                        if(!$con)die("Something went wrong");

                        $email = $_SESSION['seller_login_email'];

                        $query  = "SELECT id FROM `seller` WHERE email='$email'";
                        if ( $result = mysqli_query($con,$query)){
                            $id = mysqli_fetch_assoc($result)['id'];
                        }else{
                            die("error");
                        }
                        $query ="SELECT `id`, `image_path`, `product_name`, `product_description`,`price`, `instock`, `product_category`, `added_on`, `_sellor_id` FROM `products` WHERE _sellor_id=$id AND `instock`='0'";
                        if ($result=mysqli_query($con,$query)){
                            while ($data= mysqli_fetch_assoc($result)){
                                ?>
                                <div class="card" style="width: 100%;">
                                    <div class="card-header" id="heading<?php echo $data['id'];?>">
                                        <h5 class="mb-0">
                                            <p style="text-align: center;width: 100%" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $data['id'];?>" aria-expanded="false" aria-controls="collapseTwo">
                                                <strong>Product name:</strong><?php echo $data['product_name'];?>
                                            </p>
                                        </h5>
                                    </div>
                                    <div id="collapse<?php echo $data['id'];?>" class="collapse" aria-labelledby="heading<?php echo $data['id'];?>" data-parent="#accordion">
                                        <div class="card-body">

                                            <div class="row" >
                                                <div class="col">
                                                    <a href = "#" class = "thumbnail">
                                                        <img src = "<?php echo substr($data['image_path'],1,strlen($data['image_path']));?>" alt = "Generic placeholder thumbnail" style="height: 100px;width: 100px">
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <strong>Product name:</strong><?php echo $data['product_name'];?>
                                                </div>
                                                <div class="col">
                                                    <strong>Product description:</strong><?php echo $data['product_description'];?>
                                                </div>
                                                <div class="col">
                                                    <strong>In stock:</strong><?php echo $data['instock'];?>
                                                </div>
                                                <div class="col">
                                                    <strong>Price:</strong><?php echo $data['price'];?>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <div class="row">

                                                <div class="col">
                                                    <div class="row" style="margin-top: 1%">
                                                        <div class="col justify-content-center">
                                                            <div class="card">
                                                                <div class="card-header" id="headingTwo<?php echo $data['id'];?>">
                                                                    <h5 class="mb-0">
                                                                        <a style="text-align: center;width: 100%" class="btn btn-link collapsed btn-success" data-toggle="collapse" data-target="#collapseTwo<?php echo $data['id'];?>" aria-expanded="false" aria-controls="collapseTwo">
                                                                            Update Details
                                                                        </a>
                                                                    </h5>
                                                                </div>
                                                                <div id="collapseTwo<?php echo $data['id'];?>" class="collapse" aria-labelledby="headingTwo<?php echo $data['id'];?>" data-parent="#accordion">
                                                                    <div class="card-body" >
                                                                        <form method="post" action="php/update_product.php" enctype="multipart/form-data">
                                                                            <div class="form-group input-group">
                                                                                <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                                                </div>
                                                                                <input name="product_name" class="form-control" placeholder="Product name"
                                                                                       type="text"
                                                                                       required value="<?php echo $data['product_name']; ?>">
                                                                            </div>
                                                                            <div class="form-group input-group">
                                                                                <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                                                </div>
                                                                                <input name="procduct_description" class="form-control" placeholder="Product description"
                                                                                       type="text" value="<?php echo $data['product_description']; ?>"
                                                                                       required>
                                                                            </div>
                                                                            <div class="form-group input-group">
                                                                                <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                                                </div>
                                                                                <input name="procduct_instock" class="form-control" placeholder="In stock"
                                                                                       type="number" value="<?php echo $data['instock']; ?>"
                                                                                       required>
                                                                            </div>



                                                                            <div class="form-group input-group">
                                                                                <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                                                </div>
                                                                                <input name="procduct_price" class="form-control" placeholder="Price"
                                                                                       type="number" value="<?php echo $data['price']; ?>"
                                                                                       required>
                                                                            </div>

                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                                                </div>
                                                                                <div class="custom-file">
                                                                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                                                                           aria-describedby="inputGroupFileAddon01" name="img_file">
                                                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" value="<?php echo $data['id']; ?>" name="id">
                                                                            <input type="hidden" value="true" name="update">
                                                                            <div class="form-group input-group" >
                                                                                <input type="submit" value="Update details" class="btn float-right login_btn btn-block" style="margin-top: 15px">
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>

                                    </div>



                                </div>



                                <?php
                            }
                        }else{
                            die("e");
                        }
                        ?>
                    </div>

                </div>
            </div>




        </div>

        </body>
        </html>
        <?php
    }
    ?>