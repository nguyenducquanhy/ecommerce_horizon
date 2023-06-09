<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

    include'library/cors.php';
    include'library/connect.php';  


    $idCategory=$_POST["idCategory"];
    $name=$_POST["name"];
    $isActive=1;
    
    
        $query="insert into Disk ( idCategory,name, isActive ) value ('$idCategory','$name','$isActive')";
    
    $result=mysqli_query($connect,$query);    

    if($result){        
        
        echo 200;
    }

    else{
        echo 504;
    }
?>