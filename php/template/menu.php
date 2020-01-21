
<?php

function on_which_page(){
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
            "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
        $_SERVER['REQUEST_URI'];
    $link =$_SERVER['REQUEST_URI'];
    $arr = explode("/",$link);

//print_r($arr);

    $p =  $arr[2];
    $p = explode("?",$p);
    //print_r($p);
    $p = $p[0];



    if (strcasecmp($p,'admin')==0||strcasecmp($p,'admin')==0){
        return "1";
    }else if (strcasecmp($p,'login')==0||strcasecmp($p,'login')==0){
        return "2";
    }else if (strcasecmp($p,'seller')==0||strcasecmp($p,'seller')==0){
        return "3";
    }else if (strcasecmp($p,'aboutus')==0||strcasecmp($p,'aboutus')==0){
        return "4";
    }else if (strcasecmp($p,'addresses')==0||strcasecmp($p,'addresses')==0||strcasecmp($p,"profile?update=success")==0){
        return "5";
    }else if (strcasecmp($p,'cart')==0||strcasecmp($p,'cart')==0){
        return "6";
    }else if (strcasecmp($p,'profile')==0||strcasecmp($p,'profile')==0){
        return "7";
    }
    else if (strcasecmp($p,'sellerdashboard?upload=true')==0||strcasecmp($p,'sellerdashboard?upload=true')==0){
        return "8";
    }

    else if (strcasecmp($p,'sellerdashboard')==0||strcasecmp($p,'sellerdashboard')==0){
        return "9";
    }else if (strcasecmp($p,'detail_view')==0||strcasecmp($p,'detail_view')==0){
        return "5.5";
    }else if (strcasecmp($p,'new_s')==0||strcasecmp($p,'new_s')==0){
        return "3.3";
    }
    else if (strcasecmp($p,'payment')==0||strcasecmp($p,'payment')==0){
        return "4.5";
    } else if (strcasecmp($p,'order')==0||strcasecmp($p,'order')==0){
        return "4.4";
    } else if (strcasecmp($p,'update_a')==0||strcasecmp($p,'update_a')==0){
        return "4.3";
    }  else if (strcasecmp($p,'update_seller')==0||strcasecmp($p,'update_seller')==0){
        return "8.1";
    }else if (strcasecmp($p,'outofstockproducts')==0||strcasecmp($p,'outofstockproducts')==0){
        return "8";
    } else if (strcasecmp($p,'product_ordered')==0||strcasecmp($p,'product_ordered')==0){
        return "8";
    } else if (strcasecmp($p,'resetseller')==0||strcasecmp($p,'resetseller')==0){
        return "8";
    }else if (strcasecmp($p,'view')==0||strcasecmp($p,'view')==0){
        return "3.3";
    }else if (strcasecmp($p,'contactus')==0||strcasecmp($p,'contactus')==0){
        return "3.3";
    }else if (strcasecmp($p,'search')==0||strcasecmp($p,'search')==0){
        return "3.3";
    }else if (strcasecmp($p,'buy_printed')==0||strcasecmp($p,'buy_printed')==0){
        return "3.3";
    }
}
?>


<div class="container-fluid " style="position:fixed;z-index:60;top: 0px;">



<div class="container-fluid nav_top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" id="_title_main">
                <p id="_title">India's Fastest Online Shopping Destination</p>
            </div>
            <div class="col-lg-6">
                <ul style="list-style:none;">

                    <?php
                    if (!isset($_SESSION['seller_login_email'])){
                            ?>

                            <li style="float:right;margin-left:  15px;">
                                <a href="seller" <?php

                                if (on_which_page()==3){
                                    ?>
                                    style=";color: blue;text-decoration: underline"
                                    <?php
                                }else{
                                    ?>style=";color: white;"
                                    <?php
                                } ?>
                                >Seller</a>
                            </li>

                    <?php

                    }else{
                        ?>

                        <li style="float:right;margin-left:  15px;">
                            <a href="sellerdashboard" <?php

                            if (on_which_page()==3){
                                ?>
                                style=";color: blue;text-decoration: underline"
                                <?php
                            }else{
                                ?>style=";color: white;"
                                <?php
                            } ?>
                            >Seller dashboard</a>
                        </li>

                    <?php

                    }

                    ?>

                    <li style="float:right;margin-left: 15px;color: white;">
                        <a href="aboutus"<?php

                        if (on_which_page()==4){
                            ?>
                            style=";color: blue;text-decoration: underline"
                            <?php
                        }else{
                            ?>style=";color: white;"
                            <?php
                        } ?>>   About us</a>
                    </li>
                    <li style="float:right;margin-left:  15px;color: white;">
                        <a href="contactus">Contact us</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light  ">
    <a class="navbar-brand" href="./">Lifestyle Store

        <?php
        if (isset($_SESSION['seller_login_email'])){
            if (on_which_page()>=8){
                echo"(seller dashboard)";
            }
        }
        ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <form class="form-inline justify-content-center " style="width: 100%" method="get" action="search">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" style="width: 70%">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <?php
        if (on_which_page()<8){


        if (isset($_SESSION['login_email'])){
?>
            <ul class="navbar-nav mr-auto" style="width: 15%">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <img src="images/icons/avatar.png" alt="user" style="height: 25px;width: 25px;">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="profile">My profile</a>
                    <a class="dropdown-item" href="order">My orders</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./?logout=true">Logout</a>
                </div>
            </li>
                <li class="nav-item " style="padding: 4px;cursor: pointer;position:relative;">
                    <?php
                    if (on_which_page()>0){
                        require "../php/cart_table_fetch.php";

                    }else {
                        require "php/cart_table_fetch.php";

                    }
                    ?>
                    <div style="height: 20px;border-radius: 10px ;width: 20px;position:absolute;background-color: red;top: 0px;right: 0px;text-align: center">
                        <a href="cart">

                        <?php
                        echo $num_of_item;
                        ?>
                        </a>
                    </div>
                    <a href="cart">
                        <img src="images/icons/shopping-cart.png" alt="cart" style="height: 25px;width: 25px">

                    </a>
                </li>
            </ul>

        <?php
        }else
        {
            ?>
            <ul class="navbar-nav mr-auto" style="width: 15%">
                <li class="nav-item ">
                    <a class="nav-link" href="login">Login </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup">Sign Up</a>
                </li>


            </ul>
        <?php
        }
        }else if (isset($_SESSION['seller_login_email'])&&on_which_page()>=8){


?>

        <ul class="navbar-nav mr-auto" style="width: 15%">


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" style="margin-left: -20px">
                    <?php
                    echo $_SESSION['seller_login_email'];
                    ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="./?logout_seller=true">Logout</a>
                </div>
            </li>
        </ul>

        <?php
        }
        ?>

    </div>
</nav>
</div>
<div class="spacer" style="height: 95px;">
    &nbsp;
</div>


