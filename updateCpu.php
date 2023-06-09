<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
    include'library/cors.php';
    include'library/connect.php';  


    $idCategory=$_POST["idCategory"];
    $name=$_POST["name"];
    $isActive=1;
    $idCpu=$_POST["id"];
    
    
    $sql=" select * from Category where id ='$idCategory'";
    $sql=" select * from Cpu where id ='$idCpu'";
    $old = mysqli_query($connect,$sql);
    $data = mysqli_num_rows($old);
    if($data > 0){

    $query="update Cpu set idCategory='$idCategory' , name ='$name' , isActive = '$isActive' where id ='$idCpu'";


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