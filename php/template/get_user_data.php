<?php
function return_login_user_data($email){
    require "./config.php";
    $con = mysqli_connect($localhost,$un,$pw,$db);
    if(!$con)die("Something went wrong");
    $query  = "SELECT * FROM `users` WHERE email='$email'";
    $result = mysqli_query($con,$query);
    return mysqli_fetch_array($result);
}
?>