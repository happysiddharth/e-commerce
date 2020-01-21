<?php

    $query_to_check_exist_email = "SELECT * FROM `users` WHERE email='$_new_user_email'";
    $flag_email_exists = 0;
    if ($result=mysqli_query($con,$query_to_check_exist_email)){
        $rows= mysqli_num_rows($result);

    }else{
        die("error ");
    }


?>