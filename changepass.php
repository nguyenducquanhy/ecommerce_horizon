<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include'library/cors.php';
include'library/connect.php';

$username = $_POST['username'];
$oldPass = $_POST['oldPass'];
$newPass = $_POST['newPass'];

$sql="select * from User WHERE username ='$username' and password = '$oldPass'";
$old = mysqli_query($connect,$sql);
$data = mysqli_num_rows($old);
if($data > 0 ){
    $query = "UPDATE User SET password ='$newPass' WHERE username = '$username'";
    $sql_update = mysqli_query($connect,$query);
    if($sql_update)
    {
        echo 200;
    }
    else{
        echo 504;
    }
}else{
    echo 503;
}
?>