<?php

function on_which_page(){
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
            "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
        $_SERVER['REQUEST_URI'];
    $arr = explode("/",$link);

    $p =  $arr[sizeof($arr)-1];
    if (strcasecmp($p,'admin')==0||strcasecmp($p,'admin')==0){
        return "1";
    }else if (strcasecmp($p,'login')==0||strcasecmp($p,'login')==0){
        return "2";
    }else if (strcasecmp($p,'seller')==0||strcasecmp($p,'seller')==0){
        return "3";
    }else if (strcasecmp($p,'aboutus')==0||strcasecmp($p,'aboutus')==0){
        return "4";
    }else if (strcasecmp($p,'addresses')==0||strcasecmp($p,'addresses')==0){
        return "5";
    }
}
?>

