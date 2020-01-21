<?php
session_start();
if(isset($_SESSION['login_email'])){
    ?>
    <!doctype html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Saved adderess</title>
        <link href="images/main.png" type="image/x-icon" rel="icon">

        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/navigation_bar.css">
        <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
        <style>
            .card{
                width: 100%;
            }
        </style>
    </head>
    <body>
    <div class="container-fluid">
        <?php
        include "template/menu.php";

        ?>

        <div class="row" >
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
                                        Address
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <a href="addresses" style="color: black;">
                                        Saved addresses
                                    </a><br>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-lg-9">
                <div class="container"  style="position:relative;;width: 100%">
                    <div class="row" style="margin-top: 2%">
                        <div class="col justify-content-center">
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h5 class="mb-0">
                                        <a style="text-align: center;width: 100%" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
                                            Add new address
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body" >
                                        <form method="post" action="save_a<?php if (isset($_GET['redirect'])){echo "?redirect=".$_GET['redirect'];}?>">
                                            <div class="form-group input-group">
                                                <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                </div>
                                                <input name="_city" class="form-control" placeholder="City"
                                                       type="text"
                                                       required>
                                            </div>
                                            <div class="form-group input-group">
                                                <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                </div>
                                                <input name="_pinCode" class="form-control" placeholder="Pin Code"
                                                       type="text"
                                                       required>
                                            </div>
                                            <div class="form-group input-group">
                                                <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                                                </div>
                                                <input name="Address" class="form-control" placeholder="Address"
                                                       type="text"
                                                       required>
                                            </div>
                                            <div class="form-group input-group" >
                                                <input type="submit" value="Save address" class="btn float-right login_btn btn-block">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        <h4 style="text-align: center">
                            Saved address
                        </h4>
                        <div style="position:relative;">
                            <?php
                            if (isset($_GET['delete'])){
                                if (strcmp($_GET['delete'],'success')==0){
                                    ?>
                                    <div class="container" style="padding:10px;">

                                        <div class="alert alert-success alert-dismissible">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Address deleted successfully</strong>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }

                            if (isset($_GET['update'])){
                                if (strcmp($_GET['update'],'success')==0){
                                    ?>
                                    <div class="container" style="padding:10px;">

                                        <div class="alert alert-success alert-dismissible">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Address Updated successfully</strong>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }

                            if (isset($_GET['added'])){
                                if (strcmp($_GET['added'],'success')==0){
                                    ?>
                                    <div class="container" style="padding:10px;">

                                        <div class="alert alert-success alert-dismissible">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Address added successfully</strong>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }

                            ?>
                            <?php
                            require "./config.php";
                            $con = mysqli_connect($localhost,$un,$pw,$db);
                            if(!$con)die("Something went wrong");
                            $email = $_SESSION['login_email'];

                            $query  = "SELECT id FROM `users` WHERE email='$email'";
                            if ( $result = mysqli_query($con,$query)){
                                $id = mysqli_fetch_assoc($result)['id'];
                            }else{
                                die();
                            }
                            $query  = "SELECT * FROM `addresses` WHERE user='$id'";

                            $result = mysqli_query($con,$query);

                            if (mysqli_num_rows($result)>0){
                                while ($data = mysqli_fetch_assoc($result)){
                                    ?>
                                    <div class="row" style="position:relative;margin-top:10px;border-radius: 5px;height: 150px;box-shadow: 2px 2px 14px 0px rgba(0,0,0,0.75);;padding: 5px;box-sizing: border-box;display: block;">
                                        <div class="delete" style="position: absolute;right: 5px;">
                                            <form method="post" action="php/delete_add.php">
                                                <input type="hidden" value="<?php echo $data['id'];?>" name="address_id">
                                                <input type="submit" value="Delete" style="border-radius: 5px;width: 100px;background-color: green">
                                            </form>
                                            <form action="update_a" method="post">
                                                <input type="hidden" value="<?php echo $data['id'];?>" name="address_id">
                                                <input type="hidden" value="delete" name="what">
                                                <input type="submit" value="Update" style="border-radius: 5px;width: 100px;margin-top: 5px;background-color: red">
                                            </form>
                                        </div>
                                        <div class="col-lg-4 col-md-6" style="display: inline-block;">
                                            <strong>City:</strong><p><?php echo $data['city'];?></p>

                                        </div>
                                        <div class="col-lg-4 col-md-6" style="display: inline-block;">
                                            <strong>Pin Code:</strong><p><?php echo $data['pin'];?></p>

                                        </div>
                                        <div class="col-lg-3 col-md-6" style="display: inline-block;">
                                            <strong>Address:</strong><p><?php echo $data['address'];?></p>

                                        </div>
                                    </div>
                                    <?php
                                }
                            }else
                            {
                                echo "No address found";
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
    echo "Unauthorised access";
}
?>
