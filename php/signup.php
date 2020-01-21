<?php
error_reporting(0);
session_start();

  if(isset($_POST['_new_user_fname'])&&isset($_POST['_new_user_email'])&&isset($_POST['_new_user_phone'])&&isset($_POST['_new_user_gender'])&&isset($_POST['_new_user_sec_question'])&&isset($_POST['_new_user_answer'])&&isset($_POST['_new_user_password'])){
if(!empty($_POST['_new_user_fname'])&&!empty($_POST['_new_user_email'])&&!empty($_POST['_new_user_phone'])&&!empty($_POST['_new_user_gender'])&&!empty($_POST['_new_user_sec_question'])&&!empty($_POST['_new_user_answer'])&&!empty($_POST['_new_user_password'])) {

    require "config.php";
    $con = mysqli_connect($localhost,$un,$pw,$db);
    if(!$con)die("Something went wrong");

    $first_name = mysqli_real_escape_string($con,htmlspecialchars($_POST['_new_user_fname']));
    $_new_user_email = mysqli_real_escape_string($con,htmlspecialchars($_POST['_new_user_email']));
    $_new_user_phone = mysqli_real_escape_string($con,htmlspecialchars($_POST['_new_user_phone']));
    $_new_user_gender = mysqli_real_escape_string($con,htmlspecialchars($_POST['_new_user_gender']));
    $_new_user_sec_question = mysqli_real_escape_string($con,htmlspecialchars($_POST['_new_user_sec_question']));
    $_new_user_answer = md5(mysqli_real_escape_string($con,htmlspecialchars($_POST['_new_user_answer'])));
    $_new_user_password = md5(mysqli_real_escape_string($con,htmlspecialchars($_POST['_new_user_password'])));

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y/m/d h:i:s a', time());
    require 'validate_email.php';
    if (valid_email($_POST['_new_user_email']))
    {


    if (strlen($_new_user_password)>=6){
        require "users_exists.php";

        if ($rows==0){
            $query = "INSERT INTO `users`(`id`, `full name`, `email`, `phone`, `sec_question`, `sec_answer`, `password`, `date_of_creation`, `gender`) VALUES (NULL ,'$first_name','$_new_user_email','$_new_user_phone','$_new_user_sec_question','$_new_user_answer','$_new_user_password','$date','$_new_user_gender')";
            if(mysqli_query($con,$query)){
                $_SESSION['login_email'] = $_new_user_email;

                $_SESSION['power'] = "user";
                header("location:./");

            }else{
                die( mysqli_error($con));
            }

        }else{
            $flag_email_exists=1;
        }

    }else{
        $short_password_flag = 1;
    }
    }else{
        $email_wrong_format = 1;
    }





}else{
    $empty_array = array("_new_user_fname"=>1,"_new_user_email"=>1,"_new_user_phone"=>1,"_new_user_gender"=>1,"_new_user_sec_question"=>1,"_new_user_answer"=>1,"_new_user_password"=>1);
    if (empty($_POST['_new_user_fname'])){
        $empty_array["_new_user_fname"]=0;
    }
    if (empty($_POST['_new_user_email'])){
        $empty_array["_new_user_email"]=0;

    }
    if (empty($_POST['_new_user_phone'])){
        $empty_array["_new_user_phone"]=0;

    }
    if (empty($_POST['_new_user_gender'])){
        $empty_array["_new_user_gender"]=0;

    }
    if (empty($_POST['_new_user_sec_question'])){
        $empty_array["_new_user_sec_question"]=0;

    }
    if (empty($_POST['_new_user_answer'])){
        $empty_array["_new_user_answer"]=0;

    }
    if (empty($_POST['_new_user_password'])){
        $empty_array["_new_user_password"]=0;

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
    <title>Create new user</title>
    <link href="images/main.png" type="image/x-icon" rel="icon">

    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/navigation_bar.css">
    <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
    <style>
        body{
            padding:0;
            margin: 0;
            background-image: url("images/signup.jpg");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;

        }

        p{
            color: white;
        }



        .card{
            margin-top: 2%;
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
        .divider-text span {
            padding: 7px;
            font-size: 12px;
            position: relative;
            z-index: 2;
        }

        @media screen and (max-width:600px) {
            #_title_main {
                display: none;
            }
        }
        </style>
</head>
<body>
<div class="container-fluid">
    <?php
    include "template/menu.php";
    ?>
    <?php
    //display error message  if entered email is already exists
    if(isset($flag_email_exists)&&$flag_email_exists==1){
        ?>

        <div class="container" style="padding:10px;">

            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php  echo $_new_user_email ?></strong> already exists.<a href="login"> Login</a>
            </div>
        </div>

        <?php
    }

    //display wrong format email error message
    if(isset($email_wrong_format)&&$email_wrong_format==1){
        ?>

        <div class="container" style="padding:10px;">

            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Wrong email format</strong>Try again.
            </div>
        </div>

        <?php
    }

    //displays error message if all fields are not entered
    if (isset($empty_array)){
        $flag = 1;
        foreach ($empty_array as $a){

            if ($a==0){
                $flag=0;
            }
        }
        if ($flag==0){
            ?>
            <div class="container" style="padding:10px;">

                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Enter all values!</strong> You have't enter all values.
                </div>
            </div>

    <?php
        }
    }

    //display error message if password is too short

    if(isset($short_password_flag)&&$short_password_flag==1){
        ?>

        <div class="container" style="padding:10px;">

            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Password is too short</strong> try again
            </div>
        </div>

        <?php
    }
    ?>
    <div class="d-flex justify-content-center">
    <div class="card">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <div class="card-header">
            <h4 class="card-title mt-3 text-center" style="color: white">Create Account</h4>
            </div>

            <div class="card-body">
            <form method="post" action="signup">
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
                            required
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

                        ?> required>
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <img src="images/icons/phone-call.png" style="height: 20px;width: 20px;"></span>
                    </div>
                    <select class="custom-select" style="max-width: 70px;">
                        <option selected="" value="91">+91</option>

                    </select>
                    <input name="_new_user_phone" class="form-control" placeholder="Phone number" type="text"
                        <?php
                        if (isset($empty_array["_new_user_phone"])&&$empty_array["_new_user_phone"]==0){
                            echo "style='border:3px solid red'";
                        }
                        if (isset($_new_user_phone)){
                            echo "value='$_new_user_phone'";
                        }

                        ?>
                            maxlength="10"
                            required


                    >

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



                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">  <img src="images/icons/padlock.png" style="height: 20px;width: 20px;"> </span>
                    </div>
                    <select class="form-control" name="_new_user_sec_question" required>
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
                        <span class="input-group-text">  <img src="images/icons/padlock.png" style="height: 20px;width: 20px;"></i> </span>
                    </div>
                    <input class="form-control" placeholder="Answer" type="text" name="_new_user_answer"
                        <?php
                        if (isset($empty_array["_new_user_answer"])&&$empty_array["_new_user_answer"]==0){
                            echo "style='border:3px solid red'";
                        } ?>
                    required>
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <img src="images/icons/padlock.png" style="height: 20px;width: 20px;"> </span>
                    </div>
                    <input class="form-control" placeholder="Create password" type="password" name="_new_user_password" minlength="6"
                        <?php
                        if (isset($empty_array["_new_user_password"])&&$empty_array["_new_user_password"]==0){
                            echo "style='border:3px solid red'";
                        } ?>required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
                </div>
                <p class="text-center">Have an account? <a href="login">Log In</a> </p>
            </form>
            </div>
        </article>
    </div>
    </div>
    <?php
    require "php/template/footer.php";
    ?>
</div>

</body>
</html>