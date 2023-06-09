<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include'library/cors.php';
include'library/connect.php'; 

$name=$_POST["name"];
$id=$_POST["id"];

$sql=" select * from UserRole where id ='$id'";
$old = mysqli_query($connect,$sql);
$data = mysqli_num_rows($old);
if($data > 0){

$query="update UserRole set name ='$name' where id ='$id'";


$result=mysqli_query($connect,$query);

if($result){
        echo 200;
    }

    else{
        echo 504;
    }

    }else{
        echo 503;
}

?>