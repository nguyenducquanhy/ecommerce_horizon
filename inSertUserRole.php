<?php

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