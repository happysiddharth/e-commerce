<?php
session_start();
if (isset($_SESSION['seller_login_email'])){
  {
        ?>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>My profile</title>
            <link href="images/main.png" type="image/x-icon" rel="icon">

            <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
            <link rel="stylesheet" href="css/navigation_bar.css">
            <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
            <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
            <script type="text/javascript">
                window.addEventListener('DOMContentLoaded',function () {
                    var x =  document.getElementById('_size_stock').innerHTML;
                    console.log(x);
                    document.getElementById('_size_stock').innerHTML='';
                 document.getElementById('_category').addEventListener('change',function (e) {

                        if (e.target.value==2){
                           document.getElementById('_size_stock').innerHTML=x;
                            document.getElementById('_add_instock').style.visibility='hidden';
                        }else{
                            if ( document.getElementById('_add_instock').style.visibility=='hidden'){
                                document.getElementById('_size_stock').innerHTML='';
                                document.getElementById('_add_instock').style.visibility='visible';
                            }
                        }
                    })


                })
            </script>
            <style>
                body{
                    padding:0;
                    margin: 0;
                    background: whitesmoke;
                }


                #aside .card{
                    width: 100%;

                }


                #collapseOne{
                    width: 100%;
                }



                .card{

                    margin-bottom: auto;

                    width: 100%;
                    animation-name: zoom;
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
                    transition: all linear  0.3s;
                }
                .card-body,form{
                    width: 100%;
                }

                form{
                    width:100%;
                }
                @keyframes zoom {
                    from{
                        -webkit-transform: scale(.5);
                        -moz-transform: scale(.5);
                        -ms-transform: scale(.5);
                        -o-transform: scale(.5);
                        transform: scale(.5);
                    }to{
                         transform: scale(1);
                     }

                }
                .divider-text span {
                    padding: 7px;
                    font-size: 12px;
                    position: relative;
                    z-index: 2;
                }
                .uploaded_sizes{
                    padding: 10px;
                                 }
                .uploaded_sizes input{
                    margin: ;

                }

            </style>
        </head>
        <body>
        <div class="container-fluid">
            <?php
            include "template/menu.php";


            if (isset($_GET['upload'])){
                if (strcmp($_GET['upload'],'true')==0){
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

            <div class="row" style="padding: 5px;">
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
                                        <div class="card-body">
                                            <a href="sellerdashboard" style="color: black;">
                                                Add new products
                                            </a>
                                        </div>
                                        <hr>
                                        <a href="update_seller" style="color: black;">
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

                    <div class="col justify-content-center">
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <a style="text-align: center;width: 100%" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
                                        Add new product
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body" >
                                    <form method="post" action="php/add_new_produt.php" enctype="multipart/form-data">
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                            </div>
                                            <input name="_product_name" class="form-control" placeholder="Product name"
                                                   type="text"
                                                   required>
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                            </div>
                                            <input name="_procduct_description" class="form-control" placeholder="Product description"
                                                   type="text"
                                                   required>
                                        </div>
                                        <h6 style="text-align: center;color: gray">
                                            SIZES IN STOCK
                                        </h6>
                                        <div class="form-group " id="_size_stock" style="">

                                            <div class="uploaded_sizes input-group">
                                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Extra small" style="text-decoration: none;color: #000;user-focus: none;user-select: none">XS-></a>
                                                <input name="_procduct_instock_xs"  placeholder="In stock"
                                                       type="number" style="width: 100px !important;"value="0"
                                                       required>

                                                    <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/rupee.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                    </div>
                                                    <input name="price_xs" class="form-control" placeholder="PRICE"
                                                           type="text"
                                                           required>
                                                </div>
                                            <div class="uploaded_sizes  input-group">
                                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Small" style="text-decoration: none;color: #000;user-focus: none;user-select: none">S-></a>

                                                <input name="_procduct_instock_s"  placeholder="In stock"
                                                       type="number" style="width: 100px !important;" value="0"
                                                       required>
                                                <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/rupee.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                </div>
                                                <input name="price_s" class="form-control" placeholder="PRICE"
                                                       type="text"
                                                       required>
                                            </div>
                                            <div class="uploaded_sizes  input-group">
                                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Medium" style="text-decoration: none;color: #000;user-focus: none;user-select: none">M-></a>

                                                <input name="_procduct_instock_m"  placeholder="In stock"
                                                       type="number" style="width: 100px !important;"value="0"
                                                       required>
                                                <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/rupee.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                </div>
                                                <input name="price_m" class="form-control" placeholder="PRICE"
                                                       type="text"
                                                       required>
                                            </div>
                                            <div class="uploaded_sizes  input-group">
                                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Large" style="text-decoration: none;color: #000;user-focus: none;user-select: none">L-></a>

                                                <input name="_procduct_instock_l"  placeholder="In stock"
                                                       type="number" style="width: 100px !important;" value="0"
                                                       required>
                                                <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/rupee.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                </div>
                                                <input name="price_l" class="form-control" placeholder="PRICE"
                                                       type="text"
                                                       required>
                                            </div>
                                            <div class="uploaded_sizes  input-group">
                                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Extra large" style="text-decoration: none;color: #000;user-focus: none;user-select: none">XL-></a>

                                                <input name="_procduct_instock_xl"  placeholder="In stock"
                                                       type="text" style="width: 100px !important;" value="0"
                                                       required>
                                                <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/rupee.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                </div>
                                                <input name="price_xl" class="form-control" placeholder="PRICE"
                                                       type="text"
                                                       required>
                                            </div>
                                            <div class="uploaded_sizes  input-group">
                                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Extra large large" style="text-decoration: none;color: #000;user-focus: none;user-select: none">XLL-></a>

                                                <input name="_procduct_instock_xxl"  placeholder="In stock"
                                                       type="number" style="width: 100px !important;" value="0"
                                                       required>
                                                <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/rupee.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                </div>
                                                <input name="price_xxl" class="form-control" placeholder="PRICE"
                                                       type="text"
                                                       required>
                                            </div>

                                        </div>
                                        <div class="form-group input-group" id="_add_instock">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <img src="images/icons/edit.png" style="height: 20px;width: 20px;"> </span>
                                            </div>
                                            <input name="procduct_instock" class="form-control" placeholder="In stock" type="number" value="" required="">
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                            </div>
                                            <select class="form-control" name="_product_category" id="_category" required>
                                                <?php
                                                require "config.php";
                                                $con = mysqli_connect($localhost,$un,$pw,$db);
                                                if (!$con)die("error");
                                                $query = "SELECT * FROM `categories`";
                                                if ($res1  = mysqli_query($con,$query)){
                                                    while($data = mysqli_fetch_assoc($res1)){
                                                        ?>

                                                        <option value="<?php echo $data['id'];?>"><?php echo strtoupper($data['categories']);?></option>

                                                        <?php

                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                       <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                            </div>
                                            <input name="_procduct_price" class="form-control" placeholder="Price"
                                                   type="number"
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
                                        <input type="hidden" value="add_new" name="add_new">

                                        <div class="form-group input-group" >
                                            <input type="submit" value="Add product" class="btn float-right login_btn btn-block" style="margin-top: 15px">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="container">
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
                        $query ="SELECT * FROM `products` WHERE _sellor_id=$id ORDER BY added_on DESC ";
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
                                                                            <?php
                                                                            if($data['product_category']==2){
                                                                                ?>
                                                                                <div class="form-group ">

                                                                                    <div class="uploaded_sizes input-group">
                                                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Extra small" style="text-decoration: none;color: #000;user-focus: none;user-select: none">XS-></a>
                                                                                        <input name="_procduct_instock_xs"  placeholder="In stock"
                                                                                               type="number" style="width: 100px !important;"value="<?php
                                                                                        echo $data['xs'];
                                                                                        ?>"
                                                                                               required>

                                                                                        <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/rupee.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                                                        </div>
                                                                                        <input name="price_xs" class="form-control" placeholder="PRICE"
                                                                                               type="text" value="<?php
                                                                                        echo $data['xs_price'];
                                                                                        ?>"
                                                                                               required>
                                                                                    </div>
                                                                                    <div class="uploaded_sizes  input-group">
                                                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Small" style="text-decoration: none;color: #000;user-focus: none;user-select: none">S-></a>

                                                                                        <input name="_procduct_instock_s"  placeholder="In stock"
                                                                                               type="number" style="width: 100px !important;" value="<?php
                                                                                        echo $data['s'];
                                                                                        ?>"
                                                                                               required>
                                                                                        <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/rupee.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                                                        </div>
                                                                                        <input name="price_s" class="form-control" placeholder="PRICE"
                                                                                               type="text" value="<?php
                                                                                        echo $data['s_price'];
                                                                                        ?>"
                                                                                               required>
                                                                                    </div>
                                                                                    <div class="uploaded_sizes  input-group">
                                                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Medium" style="text-decoration: none;color: #000;user-focus: none;user-select: none">M-></a>

                                                                                        <input name="_procduct_instock_m"  placeholder="In stock"
                                                                                               type="number" style="width: 100px !important;"value="<?php
                                                                                        echo $data['m'];
                                                                                        ?>"
                                                                                               required>
                                                                                        <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/rupee.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                                                        </div>
                                                                                        <input name="price_m" class="form-control" placeholder="PRICE"
                                                                                               type="text"value="<?php
                                                                                        echo $data['m_price'];
                                                                                        ?>"
                                                                                               required>
                                                                                    </div>
                                                                                    <div class="uploaded_sizes  input-group">
                                                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Large" style="text-decoration: none;color: #000;user-focus: none;user-select: none">L-></a>

                                                                                        <input name="_procduct_instock_l"  placeholder="In stock"
                                                                                               type="number" style="width: 100px !important;" value="<?php
                                                                                        echo $data['l'];
                                                                                        ?>"
                                                                                               required>
                                                                                        <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/rupee.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                                                        </div>
                                                                                        <input name="price_l" class="form-control" placeholder="PRICE"
                                                                                               type="text" value="<?php
                                                                                        echo $data['l_price'];
                                                                                        ?>"
                                                                                               required>
                                                                                    </div>
                                                                                    <div class="uploaded_sizes  input-group">
                                                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Extra large" style="text-decoration: none;color: #000;user-focus: none;user-select: none">XL-></a>

                                                                                        <input name="_procduct_instock_xl"  placeholder="In stock"
                                                                                               type="text" style="width: 100px !important;" value="<?php
                                                                                        echo $data['xl'];
                                                                                        ?>"
                                                                                               required>
                                                                                        <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/rupee.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                                                        </div>
                                                                                        <input name="price_xl" class="form-control" placeholder="PRICE"
                                                                                               type="text" value="<?php
                                                                                        echo $data['xl_price'];
                                                                                        ?>"
                                                                                               required>
                                                                                    </div>
                                                                                    <div class="uploaded_sizes  input-group">
                                                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Extra large large" style="text-decoration: none;color: #000;user-focus: none;user-select: none">XLL-></a>

                                                                                        <input name="_procduct_instock_xxl"  placeholder="In stock"
                                                                                               type="number" style="width: 100px !important;" value="<?php
                                                                                        echo $data['xxl'];
                                                                                        ?>"
                                                                                               required>
                                                                                        <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/rupee.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                                                        </div>
                                                                                        <input name="price_xxl" class="form-control" placeholder="PRICE"
                                                                                               type="text" value="<?php
                                                                                        echo $data['xxl_price'];
                                                                                        ?>"
                                                                                               required>
                                                                                    </div>

                                                                                </div>

                                                                                <?php
                                                                            }
                                                                            ?>

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
}else{
    echo "Unauthorised access";
}
?>

