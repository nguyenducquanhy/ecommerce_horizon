<?php
    include'library/cors.php';
    include'library/connect.php';  


    $idCategory=$_POST["idCategory"];
    $name=$_POST["name"];
    $isActive=1;
    $idVga=$_POST["id"];
    
    
    $sql=" select * from Category where id ='$idCategory'";
    $sql=" select * from Vga where id ='$idVga'";
    $old = mysqli_query($connect,$sql);
    $data = mysqli_num_rows($old);
    if($data > 0){

    $query="update Vga set idCategory='$idCategory' , name ='$name' , isActive = '$isActive' where id ='$idVga'";


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