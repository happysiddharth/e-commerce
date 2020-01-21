<?php
session_start();
if (isset($_SESSION['seller_login_email'])){
    if (isset($_POST['order_id'])){
        if (!empty($_POST['order_id'])){


                require "../php/config.php";
                $con = mysqli_connect($localhost,$un,$pw,$db);
                if (!$con)die("error");
                $order_id = mysqli_real_escape_string($con,$_POST['order_id']);
                require "../php/template/get_seller_id_by_email.php";
                require "../php/template/get_seller_id_by_email.php";
            $query = "SELECT * FROM orders INNER JOIN `products` ON orders.product = products.id where products._sellor_id =$_seller_id AND `orders`.status ='pending' AND `orders`.id='$order_id' ORDER BY orders.date DESC ";
            if ($res=mysqli_query($con,$query)){

                if (mysqli_num_rows($res)>0) {
                    echo "ss";
                    $data = mysqli_fetch_assoc($res);
                    print_r($data);
                }else{
                    echo "error";
                }
            }
            ?>



<?php
        }else{
            echo "error";
        }
    }
}