<?php
    include'library/cors.php';
    include'library/connect.php';  


    $idCategory=$_POST["idCategory"];
    $name=$_POST["name"];
    $isActive=1;
    $idDisk=$_POST["id"];
    
    
    $sql=" select * from Category where id ='$idCategory'";
    $sql=" select * from Disk where id ='$idDisk'";
    $old = mysqli_query($connect,$sql);
    $data = mysqli_num_rows($old);
    if($data > 0){

    $query="update Disk set idCategory='$idCategory' , name ='$name' , isActive = '$isActive' where id ='$idDisk'";


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