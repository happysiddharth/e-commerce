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
    <title><?php if (isset($_GET['search'])){echo "Search: ".$_GET['search'];}?></title>
    <link href="images/main.png" type="image/x-icon" rel="icon">

    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/navigation_bar.css">
    <script type="text/javascript" src="js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/js/bootstrap.js"></script>
    <style>
        ._on_hover{
            position: relative;height: 200px;width: 18rem;overflow: hidden;
        }
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
        .t{
            display: inline-block;

        }
        .card{
            width: 18rem;position:relative;
            box-shadow: none;
            height:370px;
            transition: all linear 0.1s ;
        }
        .card:hover{
            box-shadow: 3px 8px 17px 0px rgba(0,0,0,0.75);
            overflow: hidden;
            cursor: pointer;
        }
        .view_more{
            position: absolute;left: 100px;top:90px
        }
        .imgage img{
            transform: scale(1);
            width:inherit;height: inherit;
            transition:all linear 0.3s;
            cursor: pointer;
        }

        .imgage:hover img{
            transform: scale(1.3);
        }
        .imgage {
            transform: scale(1);
            animation-name: zoom;
            opacity: 1;
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
        .details

        {
            opacity: 1;
            transform: scale(1);
            animation-name: zoom;
            animation-delay: 0.3s;
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
                opacity: 0;
                -webkit-transform: scale(.5);
                -moz-transform: scale(.5);
                -ms-transform: scale(.5);
                -o-transform: scale(.5);
                transform: scale(.5);
            }to{
                 opacity: 1;
                 transform: scale(1);
             }

        }
        input[type='submit']{
            cursor: pointer;
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
                width: 200px;
            }
            .view_more{
                position: absolute;
                left: 50px;
                top:50px;
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
    </style>
    <script type="text/javascript" src="js/select_javascript.js">
    </script>
</head>
<body>
<?php
require 'template/menu.php';
?>
<div class="container-fluid justify-content-center" style="margin-left:3%;">
    <div class="row">
        <?php

        if (isset($_GET['search'])){
            if (!empty($_GET['search'])){
                require 'config.php';
                $con = mysqli_connect($localhost,$un,$pw,$db);
                if (!$con)die("error");
                $search = mysqli_real_escape_string($con,$_GET['search']);
                $offset = isset($_GET['page'])?htmlspecialchars($_GET['page']):1;
                $offset-=1;
                $offset*=12;


                $query = "select * from products WHERE product_name LIKE '%$search%' OR product_description LIKE '%$search%' limit $offset ,12";
                if ($res = mysqli_query($con,$query)){
                    ?>
<div class="container-fluid" style="padding-left: 20px">
    <h5>Result for:<?php echo$search; ?></h5>

</div>

                    <?php
                    while ($data= mysqli_fetch_assoc($res)){

                        ?>
                        <div class="t" style="padding:10px;">
                            <div class="card" >
                                <div class="_on_hover" style="">
                                    <div class="hover_image" style="overflow: hidden;">
                                        <form method="get" action="detail_view">
                                            <input type="hidden" name="_product_id" value="<?php echo $data['id'];?>">
                                            <input type="submit" value="View details" class="btn-group-sm btn-primary view_more" style="">
                                        </form>
                                    </div>
                                    <img class="card-img p_img "style="height: inherit;width: inherit;" src="<?php echo substr($data['image_path'],1,strlen($data['image_path']));?>" alt="Card image cap">

                                </div>

                                <div class="card-body" style="height: 100px">
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


                    //logic to display more result on next page
                    if(  $num_rows  = mysqli_num_rows(mysqli_query($con,"select * from products WHERE product_name LIKE '%$search%' OR product_description LIKE '%$search%'"))>12){
                        ?>
                        <div class="container-fluid" style="margin-top: 50px">
                            <div class="row justify-content-center">
                                <ul style="list-style: none">
                                    <li style="background: white;color: white;float:left;margin-right: 2px;height: 30px;width:30px;border: 1px solid gray;text-align: center"><a href="search?search=<?php echo $_GET['search'];?>&page=1">1</a> </li>
                                    <?php

                                    $i=2;
                                    while($num_rows%6>0){
                                        ?>
                                        <li style="background: white;color: white;float:left;margin-right: 2px;height: 30px;width:30px;border: 1px solid gray;text-align: center"><a href="search?search=<?php echo $_GET['search'];?>&page=<?php echo $i;?>"><?php echo $i ;?></a> </li>
                                        <?php
                                        $num_rows/=6;
                                        $i++;
                                    }
                                    ?>
                                </ul>
                            </div>

                        </div>
        <?php
                    }

                }else{
                    echo "error";
                }
            }
        }
        ?>
    </div>

</div>

</body>
</html>
