<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

if($_SERVER['REQUEST_METHOD']==='GET'){
    register();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    register();
}

    include'library/cors.php';
    include'library/connect.php';

    $username = $_POST['username'];
    // $username = luongratbuon;

    $sql="select * from User WHERE username ='$username'";
    $old = mysqli_query($connect,$sql);
    $data = mysqli_num_rows($old);
    if($data>0){
        $query = "UPDATE User SET password = '123456'  WHERE username = '$username'";
        $sql_update = mysqli_query($connect,$query);
        if($sql_update)
        {
            echo 200;
        }
    }else{
            echo 504;
    }
?>
