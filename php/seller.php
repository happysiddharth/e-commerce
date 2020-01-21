<?php
session_start();
if (!isset($_SESSION['seller_login_email'])){
    if (isset($_POST['_email'])&&isset($_POST['_password'])){
    if (!empty($_POST['_email'])&&isset($_POST['_password'])){
        require "config.php";
        $con = mysqli_connect($localhost,$un,$pw,$db);
        if(!$con)die("Something went wrong");
        $email = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['_email'])));
        $password = md5(mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['_password']))));
        $query  = "SELECT email,password FROM `seller` WHERE email='$email'";
        $result = mysqli_query($con,$query);
        $rows = mysqli_num_rows($result);

        if ($rows>0){

            $save_password = mysqli_fetch_assoc($result)['password'];

            if (strcmp($save_password,$password)==0){

                $_SESSION['seller_login_email']=$email;
               header("location:sellerdashboard");


            }else{
                $wrong_password = 1;
            }

        }else{
            $exists_flag = 0;
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
    <title>Seller login</title>
    <link href="images/main.png" type="image/x-icon" rel="icon">

    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/navigation_bar.css">
    <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
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


        .social_icon span{
            font-size: 60px;
            margin-left: 10px;
            color: #FFC312;
        }

        .social_icon span:hover{
            color: white;
            cursor: pointer;
        }

        .card-header h3{
            color: white;
        }

        .social_icon{
            position: absolute;
            right: 20px;
            top: -45px;
        }

        .input-group-prepend span{
            width: 50px;
            background-color: #EC2410;
            color: black;
            border:0 !important;
        }

        input:focus{
            outline: 0 0 0 0  !important;
            box-shadow: 0 0 0 0 !important;

        }

        .remember{
            color: white;
        }

        .remember input
        {
            width: 20px;
            height: 20px;
            margin-left: 15px;
            margin-right: 5px;
        }

        .login_btn{
            color: black;
            background-color: #EC2410;
            width: 100px;
        }

        .login_btn:hover{
            color: black;
            background-color: white;
        }

        .links{
            color: white;
        }

        .links a{
            margin-left: 4px;
        }
        .spacer
        {
            width: 100%;
            height: 95px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <?php
    include "template/menu.php";

    //display error message  if entered email is not already exists
    if(isset($exists_flag)&&$exists_flag==0){
        ?>

        <div class="container" style="padding:10px;">

            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php  echo $email ?></strong> is not registerd . <a href="new_s?email=<?php echo $email;?>">Click here to regisiter</a>
            </div>
        </div>

        <?php
    }

    if(isset($wrong_password)&&$wrong_password==1){
        ?>

        <div class="container" style="padding:10px;margin-top: 8%">

            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php  echo "Error" ?></strong> entered password is wrong
            </div>
        </div>

        <?php
    }


    if(isset($_GET['signup'])&&$_GET['signup']=='success'){
        ?>

        <div class="container" style="padding:10px;">

            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Account created successfully</strong>Login
            </div>
        </div>

        <?php
    }

    include "template/login_admin_user.php";

    ?>

</div>

</body>
</html>
<?php


}else if (isset($_SESSION['seller_login_email'])){
    header("location:sellerdashboard");
}

?>