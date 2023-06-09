
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

    include'library/cors.php';
    include'library/connect.php';  

    $name=$_POST["name"];
    $slug=$_POST["slug"];
    
    
    if($name != '' || $slug!='' ){
        $query="insert into Category( name, slug) value ('$name','$slug')";
    
    $result=mysqli_query($connect,$query);    

    if($result){        
        
     echo json_encode("insert success",JSON_UNESCAPED_UNICODE );

    }
    else{
        echo json_encode("insert fail",JSON_UNESCAPED_UNICODE );
    }
}else{
    echo 504;
}

?>
