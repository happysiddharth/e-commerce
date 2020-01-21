<?php

session_start();

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
        .spacer
        {
            width: 100%;
            height: 95px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <!--Navbar-->
    <?php
    include "template/menu.php";
    ?>
    <div class="container-fluid" >
        <div class="row" style="padding: 10px">
            <div class="col">
                <h4>What is your mission ?</h4>
                <p>Your mission to encourage the youth to join any type of fitness activity and also to provide best products at reasonable price point.

               </p>
                <h4>How we started ?</h4>
                <p>
                    We all have ideas, but only few take step towards there ideas,its ok to fails sometimes but not doing due the fear of failure is not
                    the good idea and no idea is best at first, it become better and better as we work on it and thats how we stared,I <strong>Siddharth kaushik</strong>
                    founder of <strong>Gymfreaks.com</strong> want to do somethigs great in his life and going to gym change my life.It teaches me how to be in discipline and the power of disciipline.

                </p>
            </div>
            <div class="col">
                <h4>What we sell ?</h4>
                <p>
                    We sell all find to gym accessories that are required during workout .
                    <a href="./">click here to browse</a>
                </p>
            </div>
        </div>

    </div>
</div>
</body>
</html>