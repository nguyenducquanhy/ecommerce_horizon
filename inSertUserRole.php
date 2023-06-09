<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

    include'library/cors.php';
    include'library/connect.php';  


    $name=$_POST["name"];
    
    
    if($name != ''){
        $query="insert into UserRole (name) value ('$name')";
    
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