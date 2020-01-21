<?php
session_start();
if(isset($_SESSION['login_email'])){
    require "template/get_user_data.php";
    $data = return_login_user_data($_SESSION['login_email']);
    ?>
    <!doctype html>
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
        <style>
            body{
                padding:0;
                margin: 0;
                background: whitesmoke;
            }



            #aside .card{
                width: 100%;
                margin-top: 2px;

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
            .card-body{
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


        </style>
    </head>
    <body>
    <div class="container-fluid">
        <?php
        include "template/menu.php";



        ?>

        <?php
        //display update response

        if (isset($_GET['update'])){
            if (strcmp($_GET['update'],'success')==0){
                ?>

                <div class="container" style="padding:10px;position:relative;width:80%;margin-left: 15%">

                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Data updated successfully</strong>
                    </div>
                </div>
                <?php
            }
        }
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
                <div class="d-flex justify-content-center">

                    <div class="card" >
                        <article class="card-body mx-auto">
                            <div class="card-header">
                                <h4 class="card-title mt-3 text-center" style="color: black">Update profile</h4>
                            </div>

                            <div class="card-body">
                                <form method="post" action="php/update_user.php">
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <img src="images/icons/avatar.png" style="height: 20px;width: 20px;"> </span>
                                        </div>
                                        <input name="_new_user_fname" class="form-control" placeholder="Full name" type="text" <?php
                                        if (isset($empty_array["_new_user_fname"])&&$empty_array["_new_user_fname"]==0){
                                            echo "style='border:3px solid red'";
                                        }
                                        if (isset($first_name)){
                                            echo "value='$first_name'";
                                        }
                                        ?>
                                               value="<?php
                                               echo $data['full name']
                                               ?>"    required
                                        >
                                    </div>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">  <img src="images/icons/arroba.png" style="height: 20px;width: 20px;"></span>
                                        </div>
                                        <input name="_new_user_email" class="form-control" placeholder="Email address" type="email"
                                            <?php
                                            if (isset($empty_array["_new_user_email"])&&$empty_array["_new_user_email"]==0){
                                                echo "style='border:3px solid red'";
                                            }
                                            if (isset($_new_user_email)){
                                                echo "value='$_new_user_email'";
                                            }
                                            if (isset($_GET['email'])){
                                                $email =$_GET['email'];
                                                echo "value='$email'";
                                            }

                                            ?>
                                               value="<?php
                                               echo $data['email']
                                               ?>" disabled required>
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
                                        if (isset($empty_array["_new_seller_phone"]) && $empty_array["_new_seller_phone"] == 0) {
                                            echo "style='border:3px solid red'";
                                        }
                                        if (isset($_new_seller_phone)) {
                                            echo "value='$_new_seller_phone'";
                                        }

                                        ?>
                                               value="<?php
                                               echo $data['phone']
                                               ?>"
                                               maxlength="10" required>
                                    </div>

                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <img src="images/icons/mars.png" style="height: 20px;width: 20px;"></span>
                                        </div>

                                        <select class="form-control" name="_new_user_gender" required>
                                            <option value="m">Male</option>
                                            <option value="f">Female</option>
                                            <option value="o">Other</option>
                                        </select>
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
}else{
    echo "Unauthorised access";
}


?>

