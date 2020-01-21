<?php
session_start();
if (isset($_POST['full_name'])&&isset($_POST['email'])&&isset($_POST['message'])){
    if (!empty($_POST['full_name'])&&!empty($_POST['email'])&&!empty($_POST['message'])){
        require "config.php";
        $con = mysqli_connect($localhost,$un,$pw,$db);
        if(!$con)die("error");
        require "validate_email.php";
        if (valid_email($_POST['email'])){
            $email = mysqli_real_escape_string($con,$_POST['email']);
            $message = mysqli_real_escape_string($con,$_POST['message']);
            $full_name = mysqli_real_escape_string($con,$_POST['full_name']);
            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y/m/d h:i:s a', time());
            $query = "INSERT INTO `contact_us_message`(`full_name`, `email`, `message`, `date`, `id`) VALUES ('$full_name','$email','$message','$date',NULL)";
            if (mysqli_query($con,$query)){
                $message_received = 1;
            }
        }else{
            $email_wrong_format = 1;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="online shop where you can buy all type of electric goods">
    <title>Online Shopping</title>
    <link href="images/main.png" type="image/x-icon" rel="icon">

    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/navigation_bar.css">
    <link rel="stylesheet" href="css/admin.css">
    <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
    <style>
        .inp{
            border:none;
            border-bottom:1px solid black;
            -webkit-border-radius:0px;
            -moz-border-radius:0px;
            border-radius:0px;
            background: transparent;
        }

    </style>
</head>
<body>
<div class="container-fluid">
    <!--Navbar-->
    <?php
    include "template/menu.php";
    if(isset($message_received)&&$message_received==1){
        ?>

        <div class="container" style="padding:10px;">

            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Thanks for contacting us</strong> Message received.
            </div>
        </div>

        <?php
    }

    if(isset($email_wrong_format)&&$email_wrong_format==1){
        ?>

        <div class="container" style="padding:10px;">

            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Wrong email format</strong> Try again.
            </div>
        </div>

        <?php
    }


    ?>

    <div class="container-fluid" >
        <div class="row">
            <div class="col-lg-6">
                <form method="post" action="contactus" style="padding: 10px;">
                    <fieldset>
                        <legend>DROP US A LINE</legend>
                        <div class="form-group placeholder">

                            <input type="name" name="full_name" class="form-control inp" id="exampleInputEmail1" placeholder="FULL NAME" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control inp" id="exampleInputEmail1"placeholder="EMAIL" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="message" class="form-control inp"  placeholder="MESSAGE" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </fieldset>
                </form>
            </div>
            <div class="col-lg-4" >
                <img src="images/contact_us.jpg" style="user-select: none;-webkit-user-drag: none">
            </div>
        </div>
    </div>
</div>
</body>
</html>
