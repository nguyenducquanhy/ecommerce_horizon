<?php
    include'library/cors.php';
    include'library/connect.php';
    
    $username  =$_POST["username"];
    $idRole =$_POST["idRole"];
    $sql="select * from User WHERE username ='$username'";
$old = mysqli_query($connect,$sql);
$data = mysqli_num_rows($old);
if($data > 0){
    $query = "UPDATE User SET idRole = '$idRole'  WHERE username = '$username";
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