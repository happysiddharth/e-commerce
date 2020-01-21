

<div class="d-flex justify-content-center h-100 " >
    <div class="card" style="position:relative;">
        <div class="card-header">
            <h3>

                <?php

                if (on_which_page()==1){
                 echo "ADMIN LOGIN";
                }else if (on_which_page()==2){
                    echo "USER LOGIN";
                }else if (on_which_page()==3){
                    echo "SELLER LOGIN";
                }

                ?>


            </h3>

        </div>
        <div class="card-body">
            <form method="post" action="<?php if (on_which_page()==2){if (isset($_GET['_item_id'])&&!empty($_GET['_item_id'])){echo "login?_item_id=".$_GET['_item_id'];}else{
                echo "login";
            }}else{echo "seller";}?>">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="images/icons/avatar.png" style="height: 25px;width: 30px;"></span>
                    </div>
                    <input type="email" class="form-control" placeholder="Email" name="_email">

                </div>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="images/icons/padlock.png" style="height: 25px;width: 30px;"></span>
                    </div>
                    <input type="password" class="form-control" placeholder="password" name="_password">
                </div>

                <div class="form-group">
                    <input type="submit" value="Login" class="btn float-right login_btn btn-block">
                </div>
            </form>
        </div>
        <div class="card-footer">
            <?php
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
                    "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
                $_SERVER['REQUEST_URI'];
            $arr = explode("/",$link);

            $p =  $arr[sizeof($arr)-1];
            if (strcasecmp($p,'admin')==0||strcasecmp($p,'admin')==0){

            }else{
              ?>
                <div class="d-flex justify-content-center links">
                    <?php
                if (on_which_page()==3){
                    ?>

                    Don't have an account?<a href="new_s">Create new seller account</a>

                    <?php
                }else{
                    ?>
                    Don't have an account?<a href="signup">Sign Up</a>

                    <?php
                }
?>
                </div>

                <div class="d-flex justify-content-center">
                    <a<?php
                    if (on_which_page()==2){
                        ?>
                    href='resetuser'
                    <?php
                    }elseif(on_which_page()==3){
                        ?>
                            href='resetseller'
                            <?php
                    }
                    ?>">Forgot your password?</a>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div>
