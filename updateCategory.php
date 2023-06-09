<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
    include'library/cors.php';
    include'library/connect.php'; 
    
    $name=$_POST["name"];
    $slug=$_POST["slug"];
    $id=$_POST["id"];
    
    $sql="select * from Category where ID ='$id'";
    $old = mysqli_query($connect,$sql);
    $data = mysqli_num_rows($old);
    if($data> 0){
        $query="update Category set name ='$name' , slug='$slug' where ID ='$id'";
        
        $result=mysqli_query($connect,$query);
        
        if($result){
            echo 200;
        }else{
            echo 504;
        }
    
    }else{
        echo 503;
    }

    
?>