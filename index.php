<?php
session_start();
if (isset($_GET['logout'])){

unset($_SESSION['login_email']);


}
if (isset($_GET['logout_seller'])){
    unset($_SESSION['seller_login_email']);
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
    <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
    <style>
        .hover_image{
            height: 200px;width: 18rem;z-index: 10;position:absolute;top:200px;transition: all linear 0.3s;cursor: pointer;
            background-color: rgba(0,0,0,0.5);
        }
        .p_img{
            z-index: 5;
            position:relative;
            transform: scale(1);
            transition: transform linear 0.3s;
        }
        ._on_hover:hover .p_img{

            transform: scale(1.2);
        }
        ._on_hover:hover .hover_image{
            top:0px;
        }
        input[type='submit']{
            cursor: pointer;
        }
        #_1{
                     background-image: url("images/83055d09ca82ffd93c395efd3597371c.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;

        }
        #_2{
            background-image: url("images/wp1866305.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;

        }
        #_3{
            background-image: url("images/simply-green-wall-backdrop-cool-teenagers-bedroom-design-with-orange-and-white-wooden-furniture-with-yellow-faux-cow-rug-on-wooden-flooring-with-bedside-table-lamp-in-front-of-unpolished-wall (1).jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .card{
            height:370px;
            width: 18rem;
            position:relative;
            box-shadow: none;
            -webkit-transition: all linear 0.2s;
            -moz-transition: all linear 0.2s;
            -ms-transition: all linear 0.2s;
            -o-transition: all linear 0.2s;
            transition: all linear 0.2s;
            overflow: hidden;
        }
        .card-body{
            height: 150px;
        }
        .card:hover{
            box-shadow: 1px 4px 5px 1px rgba(0,0,0,0.75);


        }
        #wallpaper{
            background-image: url("images/wallpaper.jpg");

            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .t{
            display: inline-block;

        }
        .view_more{
            position: absolute;
            left: 100px;
            top:90px;
        }
        .r{
            width: 100%;
            margin-left: 40px
        }
@media screen and (max-width:600px) {
  #_title_main{
      display: none;
  }
    .card{
        width: 300px ;
        height:350px;
    }
    .card-body{
        height: 200px;
    }
    .view_more{
        position: absolute;
        left: 50px;
        top:90px;
    }
    ._on_hover{
        height:150px;
        width: 200px;
    }
    .p_img{
        height:100%;
        width: 300px;
    }

}
        @media screen and (max-width:500px){
            .r{
                margin-left: 2px;
            }
        }
    </style>
    <script type="text/javascript" src="js/select_javascript.js">
    </script>
    <script type="text/javascript">
        windows.addEventListener('DOMContentLoaded',function () {
            var x = document.querySelectorAll('.card');
           // var h = d
            for(let i=0;i<x.length;i++){
                x[i].style.width=document.body.offsetWidth+'px';
            }
        })
    </script>
</head>
<body>
<div class="container-fluid">
    <!--Navbar-->
    <?php

    include "php/template/menu.php";
    ?>

    <div class="container-fluid justify-content-center" style="height: 100vh" id="wallpaper">
        <div class=" row ">
            <div class="container ">
                <div class="jumbotron " style="margin-top: 15%">
                    <h1 style="text-align: center">Apply below coupon and get 200 rupee discount</h1>

                    <div style="border: 1px dashed black;width: 100px;text-align: center;margin-left: 45%;margin-top: 30px;">
                        SAVE200
                    </div>




                </div>

            </div>
        </div>
    </div>

        <?php
        require "php/config.php";
        $con = mysqli_connect($localhost,$un,$pw,$db);
        if(!$con)die("Something went wrong");

        $email = isset($_SESSION['seller_login_email'])?$_SESSION['seller_login_email']:null;

        $query = "SELECT * FROM `categories`";

        if ($res = mysqli_query($con,$query)){
            if (mysqli_num_rows($res)>0){
                while ($dataa = mysqli_fetch_assoc($res)){
                    $cat = $dataa['id'];
?>

    <div class="container-fluid" id="_<?php echo $cat;?>" style="">
        <h3 style="width: 100%;text-align: center;color: white;"><?php echo $dataa['categories'];?><a href="view?categories=<?php echo $dataa['categories'];?>">view more</a></h3>
        <div class="row r" style="">
                    <?php

                    $query ="SELECT `id`, `image_path`, `product_name`, `product_description`,`price`, `instock`, `product_category`, `added_on`, `_sellor_id` FROM `products` WHERE  product_category='$cat' limit 8";
                    if ($result=mysqli_query($con,$query)){
                        if (mysqli_num_rows($result)>0){
                            while ($data= mysqli_fetch_assoc($result)){
                                ?>
                                <div class="t" style="padding:10px;">
                                    <div class="card" style=" ">
                                        <div class="_on_hover" style="position: relative;height: 200px;width: 18rem;overflow: hidden">
                                            <div class="hover_image" style="">
                                                <form method="get" action="detail_view">
                                                    <input type="hidden" name="_product_id" value="<?php echo $data['id'];?>">
                                                    <input type="submit" value="View details" class="btn-group-sm btn-primary view_more" style="">
                                                </form>
                                            </div>
                                            <img class="card-img p_img" style="" src="<?php echo substr($data['image_path'],1,strlen($data['image_path']));?>" alt="Card image cap">
                                        </div>
                                        <div class="card-body" style="">
                                            <h5 class="card-title"><?php echo substr($data['product_name'],0,30)."...";    ?></h5>
                                            <p class="card-text"> ₹
                                                <?php
                                                echo $data['price'];
                                                ?></p>
                                            <?php
                                            if ($data['instock']>0){
                                                if (isset($_SESSION['login_email'])){
                                                    ?>
                                                    <form method="post" action="cart" <?php
                                                    if (strcasecmp($dataa['categories'],"clothings")==0){
                                                        ?>
                                                        class="add_cart";
                                                        <?php
                                                    }
                                                    ?>>
                                                        <input type="hidden" name="_product_id" value="<?php echo $data['id'];?>">
                                                        <input type="submit" value="Add to cart"

                                                               class="btn-block btn-primary ">
                                                    </form>


                                                    <?php



                                                }else {
                                                    ?>                    <form method="get" action="login">
                                                        <input type="hidden" name="_item_id" value="<?php echo $data['id'];?>">
                                                        <input type="submit" value="BUY" class="btn-block btn-primary">
                                                    </form>

                                                    <?php
                                                }
                                            }else{

                                                if (isset($_SESSION['login_email'])){


                                                    ?>
                                                    <input type="button" value="OUT OF STOCK" class="btn-block btn-danger " disabled    >


                                                    <?php



                                                }else {
                                                    ?>
                                                    <input type="button" value="OUT OF STOCK" class="btn-block btn-danger " disabled  >


                                                    <?php
                                                }



                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }

                        }

                }
                ?>
        </div>
    </div>
            <?php
            }
        }


        }
    ?>

</div>
<?php
require "php/template/footer.php";
?>
</body>
</html>