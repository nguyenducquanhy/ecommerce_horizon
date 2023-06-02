<?php


        
    $hostname = "103.200.23.139";
    $username = "horizonn_nguyenducquan";
    $password = "quanhy2001";
    $database = "horizonn_ecomerce_cdltk13";

    $connect=mysqli_connect($hostname,$username,$password,$database);
    mysqli_set_charset($connect,"utf8");

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
?>