<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
    include'library/cors.php';
    include'library/connect.php';
    $username  =$_POST["username"];

    $query = "DELETE from User WHERE username = '$username'";
    $sql_delete = mysqli_query($connect,$query);
    if($sql_detele)
    {
        echo 200;
    }
    else{
        echo 504;
    }
?>