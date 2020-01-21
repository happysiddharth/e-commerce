<?php
session_start();
if(isset($_GET['user'])||isset($_GET['seller'])){

    $string = explode("?",$_SERVER['REQUEST_URI']);
    if (strcasecmp($string[1],'user=true')==0){
        $_SESSION['whos_password_reset'] = 'user';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.js"></script>
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

<div class="container-fluid">
    <?php include "template/menu.php";
    ?>
    <div class="d-flex justify-content-center h-100" >
        <div class="card">
            <div class="card-header">
                <h3 style="color: white;">
                    Reset password
                </h3>
            </div>
            <div class="card-body">
                <form>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><img src="images/icons/avatar.png" style="height: 20px;width: 20px;"> </i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Email">

                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><img src="images/icons/padlock.png" style="height: 20px;width: 20px;">  </span>
                        </div>
                        <select class="form-control">
                            <option selected=""> Select security question</option>
                            <option>What is your childhood name?</option>
                            <option>What is your favourite subject ?</option>
                            <option>What is your favourite teaccher name ?</option>
                        </select>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <img src="images/icons/padlock.png" style="height: 20px;width: 20px;">  </span>
                        </div>
                        <input class="form-control" placeholder="Answer" type="text">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Next step" class="btn float-right login_btn btn-block">
                    </div>
                </form>
            </div>
        </div>
</div>

</body>
</html>
<?php
}

?>