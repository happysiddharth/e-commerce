<?php
session_start();
if (isset($_GET['_product_id'])){
    if (!empty($_GET['_product_id'])){
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
            <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
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

                .imgage img#product_img{
                    transform: scale(1);
                    width:inherit;height: inherit;
                    transition:all linear 0.3s;
                    cursor: pointer;
                }

                img#product_img:hover{
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
                svg {
                    width: 100%;
                    height: 240px;
                    background-color: #2e9;

                    -ms-touch-action: none;
                    touch-action: none;
                }
                .edit-rectangle {
                    fill: #92e;
                    stroke: #fff;

                    transition: fill 0.3s, stroke 0.3s;
                }
                .edit-rectangle.neg-w {
                    fill: #f40;
                }
                .edit-rectangle.neg-h {
                    stroke: #29e;
                }

            </style>
            <script type="text/javascript" src="js/select_javascript.js"></script>
        </head>
        <body>
        <div class="container-fluid">
            <!--Navbar-->
            <?php
            include "./template/menu.php";
            require "config.php";
            $con = mysqli_connect($localhost, $un, $pw, $db);
            if (!$con) die("Something went wrong");
            $product_id = mysqli_real_escape_string($con,htmlspecialchars($_GET['_product_id']));
            $query = "select * from products WHERE id='$product_id'";
            if ($res = mysqli_query($con,$query)){
                $data = mysqli_fetch_assoc($res);

                $seller_id =$data['_sellor_id'];

                $query = "select * from seller where id = $seller_id";

                if ($result_seller = mysqli_query($con,$query)){
                    $seller  = mysqli_fetch_assoc($result_seller);
                }

            }

            //to display success message

            if(isset($_GET['review'])&&$_GET['review']=='success'){
                ?>

                <div class="container" style="padding:10px;">

                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Review submitted</strong>
                    </div>
                </div>

                <?php
            }


            //to display error message if review is already submitted
            if(isset($_GET['previous_submit'])&&$_GET['previous_submit']=='true'){
                ?>

                <div class="container" style="padding:10px;">

                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Review already submitted</strong>
                    </div>
                </div>

                <?php
            }
            ?>

            <div class="container-fluid " >
                <div class="row">
                        <div class="col-lg-6 col-sm-1 image_main" >
                            <div class="imgage" style="position:relative;height: 500px;width: 500px;margin-top: 10px;overflow: hidden;">
                                <img src="<?php echo substr($data['image_path'],1,strlen($data['image_path']));?>" id="product_img">
                            </div>
                        </div>
                        <div class="col-lg-6 details">
                            <div class="row">
                                <div class="row">
                                    <h1 style="text-align: center;font-stretch: extra-expanded">
                                        <?php
                                        echo strtoupper($data['product_name']);
                                        ?>
                                    </h1>
                                </div>
                            </div>

                            <div class="row">

                                <strong>
                                    ₹
                                    <?php
                                    echo $data['price'];
                                    ?>
                                </strong>
                            </div>
                            <div class="row">
                                <span>Seller:</span>
                                <strong>

                                    <?php
                                    echo $seller['full name'];
                                    ?>
                                </strong>
                            </div>
                            <div class="row">
                                <span>Highlights:</span>
                                <strong>

                                    <?php
                                    echo $data['product_description'];
                                    ?>
                                </strong>
                            </div>

                            <?php
                            if ($data['product_category']==2){
                            ?>
                                <div class="col" id="footer" style="width: 100%;height: 100px;bottom:0px;box-sizing: border-box;margin-left: -50px">
                                    <form method="post" action="buy_printed" id="_buy" enctype="multipart/form-data"

                                          class="add_cart";
                                      >
                                        <div class="row">
                                            <input type="file" name="print_image" style="display: none;">
                                            <input type="hidden" name="_product_id" value="<?php echo $data['id'];?>">
                                            <input type="submit" value="BUY" class="btn-block btn-primary" id="_buy_btn" style="position:fixed;height: 50px;;bottom:0px;">
                                        </div>
                                    </form>
                                </div>

                                <?php
                            }else{
                                ?>

                                <div class="col" id="footer" style="width: 100%;height: 100px;bottom:0px;box-sizing: border-box;margin-left: -50px">
                                    <form method="post" action="cart"
                                    >
                                        <div class="row">
                                            <input type="file" name="print_image" style="display: none;">
                                            <input type="hidden" name="_product_id" value="<?php echo $data['id'];?>">
                                            <input type="submit" value="BUY" class="btn-block btn-primary" id="_buy_btn" style="position:fixed;height: 50px;;bottom:0px;">
                                        </div>
                                    </form>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                </div>
            </div>
            <!--review div-->
            <div class="container-fluid" style="margin-top: 10px">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 style="text-align: center">Reviews</h4>
                        <?php
                        $query = "SELECT * FROM `review` WHERE product = '$product_id'";
                        if ($res = mysqli_query($con,$query)){
                            if (mysqli_num_rows($res)!=null){
                                while($data = mysqli_fetch_assoc($res)){
                                    $user_id = $data['user'];
                                    $query = "select * from users WHERE id=$user_id";
                                    if ($data_user = mysqli_fetch_assoc(mysqli_query($con,$query))['full name']){
                                        ?>
                                        <div class="container-fluid" style="padding: 15px;box-sizing: border-box">
                                            <div class="row">
                                                <div class="col-lg-12" style="padding: 50px;box-sizing: border-box">
                                                    <strong><?php echo $data_user;?></strong><br>
                                                    <p><?php echo $data['review'];?></p>
                                                    <small><?php echo $data['date'];?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                        <?php
                                    }
                                }
                            }else{
                               ?>
                                <p style="margin-left: 15px;">No reviews</p>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
                if (isset($_SESSION['login_email'])){
                    require "template/get_user_id.php";
                    $query = "select * from orders WHERE user = $_user_id  AND status = 'delivered' AND product='$product_id'";
                    if (mysqli_num_rows(mysqli_query($con,$query))>0){
                        ?>

                        <form method="post" action="php/save_review.php" style="padding: 10px;">
                            <fieldset>
                                <legend>DROP US A LINE</legend>

                                <div class="form-group">
                                    <input type="email" name="email" class="form-control inp" id="exampleInputEmail1"placeholder="EMAIL" value="<?php
                        echo $_SESSION['login_email'];
                                    ?>"disabled required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="review" class="form-control inp"  placeholder="REVIEW" required>
                                </div>
                                <input type="hidden" value="<?php echo $_GET['_product_id']; ?>" name="_product_id">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </fieldset>
                        </form>

                        <?php
                    }
                    ?>
                    <?php
                }
                ?>
            </div>
        </div>
        </body>
        </html>

<?php
    }
}
?>
