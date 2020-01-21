<?php
session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php if (isset($_GET['categories'])){echo $_GET['categories'];}?></title>
    <link href="images/main.png" type="image/x-icon" rel="icon">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/navigation_bar.css">
    <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="js/select_javascript.js"></script>
    <style>
        .hover_image{
            height: 200px;width: 18rem;z-index: 10;position:absolute;top:200px;transition: all linear 0.3s;cursor: pointer;
            background-color: rgba(0,0,0,0.5);
        }
        ._on_hover {
            position: relative;
            height: 200px;
            width: 18rem;
            overflow: hidden;
        }
        .view_more {
            position: absolute;
            left: 100px;
            top: 90px;
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
            width: 18rem;
            height:370px;
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
            height: 100px;
        }
        .card:hover{
            box-shadow: 1px 4px 5px 1px rgba(0,0,0,0.75);


        }
        @media screen and (max-width:600px) {
            #_title_main{
                display: none;
            }
            .card{
                width: 200px;
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
                width: 200px;
            }

        }
        @media screen and (max-width:500px){
            .r{
                margin-left: 2px;
            }
        }
        }
    </style>
<body>
<div class="container-fluid">
    <!--Navbar-->
    <?php
    include "../php/template/menu.php";
    ?>
    <?php
    require "../php/config.php";
    $con = mysqli_connect($localhost,$un,$pw,$db);
    if(!$con)die("Something went wrong");
$category = mysqli_real_escape_string($con,$_GET['categories']);
    $query = "SELECT * FROM `categories` WHERE categories = '$category'";
    if ($res = mysqli_query($con,$query)){
        $rows =mysqli_num_rows($res);
        if (mysqli_num_rows($res)>0){
            while ($dataa = mysqli_fetch_assoc($res)){
                $cat = $dataa['id'];
                ?>
    <div class="container-fluid" id="_<?php echo $cat;?>" style="padding: 10px;">
        <h3 style="width: 100%;text-align: center;color: white;"><?php echo $dataa['categories'];?><a href="view?categories=<?php echo $dataa['categories'];?>">view more</a></h3>
        <div class="row" style="width: 100%;margin-left: 15px">
            <?php
            $offset = isset($_GET['page'])?htmlspecialchars($_GET['page']):1;
            $offset-=1;
            $offset*=12;
            $query ="SELECT `id`, `image_path`, `product_name`, `product_description`,`price`, `instock`, `product_category`, `added_on`, `_sellor_id` FROM `products` WHERE  product_category='$cat' limit $offset,12";
            if ($result=mysqli_query($con,$query)){
                $rows =mysqli_num_rows($result);
                if (mysqli_num_rows($result)>0){
                    while ( $data= mysqli_fetch_assoc($result)){
                        ?>
                        <div class="t" style="padding:10px;">
                            <div class="card" style=" ">
                                <div class="_on_hover" style="">
                                    <div class="hover_image" style="">
                                        <form method="get" action="detail_view">
                                            <input type="hidden" name="_product_id" value="<?php echo $data['id'];?>">
                                            <input type="submit" value="View details" class="btn-group-sm btn-primary view_more" style="">
                                        </form>
                                    </div>
                                    <img class="card-img p_img" style="height: inherit;width: inherit;" src="<?php echo substr($data['image_path'],1,strlen($data['image_path']));?>" alt="Card image cap">
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
                                            <form method="post" action="cart"
                                                <?php
                                                if ($data['product_category']==2){
                                                    ?>
                                                    class="add_cart";
                                                    <?php
                                                }
                                                ?>>
                                                <input type="hidden" name="_product_id" value="<?php echo $data['id'];?>">
                                                <input type="submit" value="Add to cart" class="btn-block btn-primary">
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
                    if(  $num_rows  = mysqli_num_rows(mysqli_query($con,"select * from products WHERE  product_category='$cat'"))>12){
                        ?>
                        <div class="container-fluid" style="margin-top: 50px">
                            <div class="row justify-content-center">
                                <ul style="list-style: none">
                                    <li style="background:white;color: white;float:left;margin-right: 2px;height: 30px;width:30px;border: 1px solid gray;text-align: center"><a href="view?categories=<?php echo $_GET['categories'];?>&page=1">1</a> </li>
                                    <?php
                                    $i=2;
                                    while($num_rows%12>0){
                                        ?>
                                        <li style="background:white;color: white;float:left;margin-right: 2px;height: 30px;width:30px;border: 1px solid gray;text-align: center"><a href="view?categories=<?php echo $_GET['categories'];?>&page=<?php echo $i;?>"><?php echo $i ;?></a> </li>
                                        <?php
                                        $num_rows/=12;
                                        $i++;
                                    }
                                    ?>
                                </ul>
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
</body>
</head>
</html>