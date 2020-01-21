<?php
session_start();

if (isset($_SESSION['login_email'])){
    if (strcmp($_SESSION['power'],'user')==0){
        require "template/get_address_info.php";
        $email = $_SESSION['login_email'];
        $id = $_POST['address_id'];
        $data = return_address($email,$id);
        ?>
        <!doctype html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Update address</title>
            <link href="images/main.png" type="image/x-icon" rel="icon">

            <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
            <link rel="stylesheet" href="css/navigation_bar.css">
            <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
            <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
        </head>
        <body>
        <?php
        include "template/menu.php";
        include "template/my_profile_left_side_pannel.php";

        ?>
        <div class="container" style="padding: 10px">
            <div class="card" style="margin-left: 15%">
                <div class="card-header" style="width: 100%">
                    <h3 style="text-align: center">
                        Update Address
                    </h3>
                </div>
                    <div class="card-body" >
                <form method="post" action="php/update_add_main_code.php">
                    <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                        </div>
                        <input name="_city" class="form-control" placeholder="City"
                               type="text" value="<?php echo $data['city'];?>"
                               required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                        </div>
                        <input name="_pinCode" class="form-control" placeholder="Pin Code"
                               type="text" value="<?php echo $data['pin'];?>"
                               required>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                                <span class="input-group-text"> <img src="images/icons/edit.png"
                                                                     style="height: 20px;width: 20px;"> </span>
                        </div>
                        <input name="Address" class="form-control" placeholder="Address"
                               type="text" value="<?php echo $data['address'];?>"
                               required>
                    </div>
                    <div class="form-group input-group" >
                        <input type="submit" value="Update address" class="btn float-right login_btn btn-block">
                    </div>
                </form>
            </div>
            </div>
        </div>
        <?php
        require "php/template/footer.php";
        ?>
        </body>
        </html>

        <?php
    }
}else{
    echo "Unauthorised access";
}

?>

