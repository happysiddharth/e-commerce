<?php
session_start();
if (isset($_POST['email'])&&isset($_POST['sec_question'])&&isset($_POST['sec_answer'])){
    if (!empty($_POST['email'])&&isset($_POST['sec_question'])&&isset($_POST['sec_answer'])){
        require "config.php";
        $con = mysqli_connect($localhost,$un,$pw,$db);
        if (!$con)die("error");
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $sec_question = mysqli_real_escape_string($con,$_POST['sec_question']);
        $sec_answer = md5(mysqli_real_escape_string($con,$_POST['sec_answer']));
        $query = "select * from seller WHERE email='$email'";
        if ($res=mysqli_query($con,$query)){
            if (mysqli_num_rows($res)>0){
                $data = mysqli_fetch_assoc($res);
                if ($data['sec_question']==$sec_question&&strcasecmp($data['sec_answer'],$sec_answer)==0){
                    $resset_seller_user = array('user_email'=>$email);
                    $_SESSION['reser_seller_email']=$email;
                }else{
                    $sec_wrong=1;
                }
            }else{
                $email_not_exists = 1;
            }
        }
    }
}

if (isset($_SESSION['reser_seller_email'])){
    if (isset($_POST['password'])&&isset($_POST['confirm_password'])){
        if (!empty($_POST['password'])&&!empty($_POST['confirm_password'])){
            if (strcmp($_POST['confirm_password'],$_POST['password'])==0){
            }
            require "config.php";
            $con = mysqli_connect($localhost,$un,$pw,$db);
            if (!$con)die("error");
            $password = md5(mysqli_real_escape_string($con,$_POST['password']));

            $query = "update seller set password='$password'";
            if (mysqli_query($con,$query)){
                $reset_done = 1 ;
            }
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
    <title>Reset Password</title>
    <link href="images/main.png" type="image/x-icon" rel="icon">

    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/navigation_bar.css">
    <script src="js/jquery/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap/js/bootstrap.js"></script>
    <script src="css/bootstrap/css/bootstrap.css"></script>
    <style>
        body{
            padding:0;
            margin: 0;
            background-image: url("images/sergey-zolkin-192937-unsplash.jpg");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        .card{
            height: 370px;
            margin-top: 5%;
            margin-bottom: auto;
            width: 400px;
            background-color: rgba(0,0,0,0.7) !important;
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

    </style>
</head>
<body>

<div class="container-fluid" >
    <?php include "template/menu.php";
    ?>
    <?php

    if (isset($sec_wrong)){
        if ($sec_wrong==1){
            ?>
            <div class="container" style="margin-top: 5px">

                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" >&times;</a>
                    <strong>Security question or password is wrong</strong>
                </div>
            </div>
            <?php
            unset($sec_wrong);
        }
    }
    ?>
    <div class="d-flex justify-content-center h-100" >
        <div class="card">
            <div class="card-header">
                <h3 style="color: white;">
                    Reset seller password
                </h3>
            </div>
            <div class="card-body">
                <?php
                if (isset($reset_done)){
                    if ($reset_done==1){
                        unset($resset_seller_user);
                        unset($_SESSION['reser_seller_email']);
                        ?>
                        <a href="seller" >
                            Password successfully reset.click to login
                        </a>
                        <?php
                    }
                }else{
                    ?>
                    <?php
                    if (isset($resset_user)){
                        if (!empty($resset_user['user_email'])){
                            ?>

                            <form method="post" action="resetseller">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><img src="images/icons/avatar.png" style="height: 20px;width: 20px;"> </i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="PASSWORD" required>

                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><img src="images/icons/avatar.png" style="height: 20px;width: 20px;"> </i></span>
                                    </div>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="CONFIRM PASSWORD" required>

                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Next step" class="btn float-right login_btn btn-block">
                                </div>
                            </form>


                            <?php
                        }
                    }else{
                        ?>

                        <form method="post" action="resetseller">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><img src="images/icons/avatar.png" style="height: 20px;width: 20px;"> </i></span>
                                </div>
                                <input type="text" name="email" class="form-control" placeholder="Email" required>

                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><img src="images/icons/padlock.png" style="height: 20px;width: 20px;">  </span>
                                </div>
                                <select class="form-control" name="sec_question" required>
                                    <?php
                                    require "config.php";
                                    $con = mysqli_connect($localhost,$un,$pw,$db);
                                    if (!$con)die("error");
                                    $query = "SELECT * FROM `sec_questions`";
                                    if ($res1  = mysqli_query($con,$query)){
                                        while($data = mysqli_fetch_assoc($res1)){
                                            ?>

                                            <option value="<?php echo $data['id'];?>"><?php echo strtoupper($data['question']);?></option>

                                            <?php

                                        }
                                    }
                                    ?>



                                </select>
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <img src="images/icons/padlock.png" style="height: 20px;width: 20px;">  </span>
                                </div>
                                <input class="form-control" name="sec_answer" placeholder="Answer" type="text" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Next step" class="btn float-right login_btn btn-block">
                            </div>
                        </form>


                        <?php
                    }
                    ?>

                    <?php
                }
                ?>

            </div>
        </div>
    </div>

</body>
    </html>