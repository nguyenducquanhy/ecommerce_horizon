
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");    

    include'library/cors.php';
    include'library/connect.php';  

    $idCatalogy=$_POST["idCatalogy"];
    $name=$_POST["name"];

    $query="insert into Cpu( idCatalogy, name) value ('$idCatalogy','$name')";

    $result=mysqli_query($connect,$query);    
 
    if($result){        
        
     echo json_encode("insert success",JSON_UNESCAPED_UNICODE );

    }
    else{
        echo json_encode("insert fail",JSON_UNESCAPED_UNICODE );
    }


?>

