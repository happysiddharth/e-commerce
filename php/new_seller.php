<?php
session_start();

if (isset($_POST['_new_seller_fname']) && isset($_POST['_new_seller_email']) && isset($_POST['_new_seller_phone']) && isset($_POST['_new_seller_company_name']) && isset($_POST['_new_seller_sec_question']) && isset($_POST['_new_seller_sec_answer']) && isset($_POST['_new_seller_password'])) {
    if (!empty($_POST['_new_seller_fname']) && !empty($_POST['_new_seller_email']) && !empty($_POST['_new_seller_phone']) && !empty($_POST['_new_seller_company_name']) && !empty($_POST['_new_seller_sec_question']) && !empty($_POST['_new_seller_sec_answer']) && !empty($_POST['_new_seller_password'])) {

        $con = mysqli_connect("localhost", "root", "", "life_style_store");
        if (!$con) die("Something went wrong");

        $first_name = mysqli_real_escape_string($con, htmlspecialchars($_POST['_new_seller_fname']));
        $_new_seller_email = mysqli_real_escape_string($con, htmlspecialchars($_POST['_new_seller_email']));
        $_new_seller_phone = mysqli_real_escape_string($con, htmlspecialchars($_POST['_new_seller_phone']));
        $_new_seller_company_name = mysqli_real_escape_string($con, htmlspecialchars($_POST['_new_seller_company_name']));
        $_new_seller_sec_question = mysqli_real_escape_string($con, htmlspecialchars($_POST['_new_seller_sec_question']));
        $_new_seller_answer = md5(mysqli_real_escape_string($con, htmlspecialchars($_POST['_new_seller_sec_answer'])));
        $_new_seller_password = md5(mysqli_real_escape_string($con, htmlspecialchars($_POST['_new_seller_password'])));

        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y/m/d h:i:s a', time());




        $query_to_check_exist_email = "SELECT * FROM `seller` WHERE email='$_new_seller_email'";
        $flag_email_exists = 0;

        if ($result = mysqli_query($con, $query_to_check_exist_email)) {

            $rows = mysqli_num_rows($result);

        } else {
            die("error ");
        }


        if ($rows == 0) {

            //check is password lenght is greater than 6
            if (strlen($_POST['_new_seller_password']) >= 6) {


                // sql to save data to seller table

                $query = "INSERT INTO `seller`(`id`, `full name`, `comany_name`, `phone`, `sec_question`, `sec_answer`, `password`, `date_of_creation`, `email`) VALUES (NULL ,'$first_name','$_new_seller_company_name','$_new_seller_phone','$_new_seller_sec_question','$_new_seller_answer','$_new_seller_password','$date','$_new_seller_email')";
                if (mysqli_query($con, $query)) {
                    header("location:seller?signup=success");
                } else {
                    die(mysqli_error($con));
                }
            } else{
            $short_password_flag = 1;
        }

        } else {
            $flag_email_exists = 1;
        }


    } else {
        $empty_array = array("_new_user_fname" => 1, "_new_user_email" => 1, "_new_user_phone" => 1, "_new_user_gender" => 1, "_new_user_sec_question" => 1, "_new_user_answer" => 1, "_new_user_password" => 1);
        if (empty($_POST['_new_seller_fname'])) {
            $empty_array["_new_seller_fname"] = 0;
        }
        if (empty($_POST['_new_seller_email'])) {
            $empty_array["_new_seller_email"] = 0;

        }
        if (empty($_POST['_new_seller_phone'])) {
            $empty_array["_new_seller_phone"] = 0;

        }
        if (empty($_POST['_new_seller_gender'])) {
            $empty_array["_new_seller_gender"] = 0;

        }
        if (empty($_POST['_new_seller_sec_question'])) {
            $empty_array["_new_seller_sec_question"] = 0;

        }
        if (empty($_POST['_new_seller_sec_answer'])) {
            $empty_array["_new_seller_sec_answer"] = 0;

        }
        if (empty($_POST['_new_seller_password'])) {
            $empty_array["_new_seller_password"] = 0;

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
    <title>Create new seller account</title>
    <link href="images/main.png" type="image/x-icon" rel="icon">

    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/navigation_bar.css">
    <link rel="stylesheet" href="css/new_seller.css">
    <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
    <style>
        body {
            padding: 0;
            margin: 0;
            background-image: url("images/retail.jpg");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }


    </style>
</head>
<body>
<div class="container-fluid">
    <?php
    include "template/menu.php";
    if (isset($flag_email_exists) && $flag_email_exists == 1) {
        ?>

        <div class="container" style="padding:10px;">

            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php echo $_new_seller_email ?></strong>seller already exists.<a href="seller">Login</a>
            </div>
        </div>

        <?php
    }
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

    <div class="d-flex justify-content-center h-100" >
        <div class="card">

            <article class="card-body mx-auto" style="max-width: 400px;">
                <div class="card-header">
                    <h4 class="card-title mt-3 text-center" style="color: white">Register new seller</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="new_s">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/avatar.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                            </div>
                            <input name="_new_seller_fname" class="form-control" placeholder="Full name" type="text"
                                   <?php
                                   if (isset($empty_array["_new_seller_fname"]) && $empty_array["_new_user_answer"] == 0) {
                                       echo "style='border:3px solid red'";
                                   }
                                   if (isset($_new_seller_fname)) {
                                       echo "value='$_new_seller_fname'";
                                   }
                                   ?>required>
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/arroba.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                            </div>
                            <input name="_new_seller_email" class="form-control" placeholder="Company email address"
                                   type="email" value=" <?php
                            if (isset($empty_array["_new_seller_fname"]) && $empty_array["_new_seller_fname"] == 0) {
                                echo "style='border:3px solid red'";
                            }
                            if (isset($_new_seller_email)) {
                                echo "$_new_seller_email";
                            }
                            if (isset($_GET['email'])) {
                                $email = $_GET['email'];
                                echo "$email";
                            }
                            ?>" required>
                        </div>

                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/avatar.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                            </div>
                            <input name="_new_seller_company_name" class="form-control" placeholder="Company name"
                                   type="text"
                                   <?php
                                   if (isset($empty_array["_new_seller_company_name"]) && $empty_array["_new_seller_company_name"] == 0) {
                                       echo "style='border:3px solid red'";
                                   }
                                   if (isset($_new_seller_company_name)) {
                                       echo "value='$_new_seller_company_name'";
                                   }
                                   ?>required>
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
                            } ?>
                                   maxlength="10" required>
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/padlock.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                            </div>
                            <select class="form-control" name="_new_seller_sec_question" required>
                                <option value="1">What is your childhood name?</option>
                                <option value="2">What is your favourite subject ?</option>
                                <option value="3">What is your favourite teaccher name ?</option>
                            </select>
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/padlock.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                            </div>
                            <input name="_new_seller_sec_answer" class="form-control" placeholder="Answer" type="text"
                                   <?php
                                   if (isset($empty_array["_new_seller_sec_answer"]) && $empty_array["_new_seller_sec_answer"] == 0) {
                                       echo "style='border:3px solid red'";
                                   } ?>required>
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><img src="images/icons/padlock.png"
                                                                    style="height: 20px;width: 20px;"></span>
                            </div>
                            <input name="_new_seller_password" class="form-control" placeholder="Create password"
                                   type="password" maxlength="6"
                                <?php
                                if (isset($empty_array["_new_seller_password"]) && $empty_array["_new_seller_password"] == 0) {
                                    echo "style='border:3px solid red'";
                                } ?> required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Create Account</button>
                        </div>
                        <p class="text-center" style="color: white;">Have an account? <a href="seller">Log In</a></p>
                    </form>
                </div>
            </article>
        </div>
    </div>

</div>

</body>
</html>
