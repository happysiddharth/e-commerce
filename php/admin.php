<?php

if (isset($_POST['email'])&&isset($_POST['password'])){
    if (!empty($_POST['email'])&&!empty($_POST['password'])){
        require 'config.php';
        $con = mysqli_connect($localhost,$un,$pw,$db);
        if (!$con)die('error');
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $query = "select * from admin where email = '$email' ";
        if ($res  = mysqli_query($con,$query)){
            if (mysqli_num_rows($res)>0){
                $password = mysqli_real_escape_string($con,$_POST['password']);
                if(strcmp($password,mysqli_fetch_assoc($res)['password'])==0){
                   session_start();
                   $_SESSION['admin_email']=$email;
                }
            }
        }else{
            echo "error";
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
    <title>Admin login</title>
    <link href="images/main.png" type="image/x-icon" rel="icon">

    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/navigation_bar.css">
    <link rel="stylesheet" href="css/admin.css">
    <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
    <style>
        body{
            padding:0;
            margin: 0;
            background-image: url("images/brooke-cagle-195777-unsplash.jpg");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }


    </style>
</head>
<body>
<div class="container-fluid">



    <div class="d-flex justify-content-center h-100" style="margin-top: 2%">
        <div class="card" >
            <div class="card-header">
                <h3>
                    ADMIN LOGIN


                </h3>

            </div>
            <div class="card-body">
                <form method="post" action="admin">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><img src="images/icons/avatar.png" style="height: 25px;width: 30px;"></span>
                        </div>
                        <input type="email" class="form-control" placeholder="Email" name="email">

                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><img src="images/icons/padlock.png" style="height: 25px;width: 30px;"></span>
                        </div>
                        <input type="password" class="form-control" placeholder="password" name="password">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Login" class="btn float-right login_btn btn-block">
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

</body>
</html>