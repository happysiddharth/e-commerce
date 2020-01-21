<?php
session_start();
if (isset($_POST['_email'])&&isset($_POST['_password'])){
    if (!empty($_POST['_email'])&&isset($_POST['_password'])){
        require "config.php";
        $con = mysqli_connect($localhost,$un,$pw,$db);
        if(!$con)die("Something went wrong");
        $email = mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['_email'])));
        $password = md5(mysqli_real_escape_string($con,htmlspecialchars(trim($_POST['_password']))));
        $query  = "SELECT email,password FROM `users` WHERE email='$email'";
        $result = mysqli_query($con,$query);
        $rows = mysqli_num_rows($result);

        if ($rows>0){

            $save_password = mysqli_fetch_assoc($result)['password'];

            if (strcmp($save_password,$password)==0){

               $_SESSION['login_email'] = $email;

               $_SESSION['power'] = "user";


               if (isset($_GET['_item_id'])){

                   $productid = $_GET['_item_id'];

                   header("location:detail_view?_product_id=$productid");

               }


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
    <title>Login</title>
    <link href="images/main.png" type="image/x-icon" rel="icon">

    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/navigation_bar.css">
    <link rel="stylesheet" href="css/login.css">
    <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
    <style>
        body{
            padding:0;
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
    //display error message  if entered email is not already exists
    if(isset($exists_flag)&&$exists_flag==0){
        ?>

        <div class="container" style="padding:10px;">

            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php  echo $email ?></strong> is not registerd . <a href="signup?email=<?php echo $email;?>">Click here to regisiter</a>
            </div>
        </div>

        <?php
    }

    if(isset($wrong_password)&&$wrong_password==1){
        ?>

        <div class="container" style="padding:10px;">

            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong><?php  echo "Error" ?></strong> entered password is wrong
            </div>
        </div>

        <?php
    }
    if (isset($_SESSION['login_email'])&&isset($_SESSION['power'])) {
        if (strcmp($_SESSION['power'],'user')==0){
            ?>
            <div class="d-flex justify-content-center h-100"    >
                <div class="card" style="position:absolute;">
                    <h4 style="color: white;">Customer account is already login</h4>
                    <a class="lead" href="./" style="color: white;">Continue shopping</a>
                </div>
            </div>
            <?php
        }
    }else{
        include "template/login_admin_user.php";

    }
    ?>

</div>

</body>
</html>
<?php
if (isset($con)){
    mysqli_close($con);
}

?>