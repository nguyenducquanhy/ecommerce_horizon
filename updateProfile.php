<?php
    include'library/cors.php';
    include'library/connect.php';

    $username =$_POST["username"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $idGender = $_POST["idGender"];
    $DateOfBirth = $_POST["DateOfBirth"];
    $PhoneNumber = $_POST["PhoneNumber"];
    $urlAvata = $_POST["urlAvata"];


    $sql="select * from User WHERE username ='$username'";
    $old = mysqli_query($connect,$sql);
    $data = mysqli_num_rows($old);
    if($data>0){
        $query = "UPDATE User SET fullname ='$fullname', email = '$email' , idGender = '$idGender' , DateOfBirth ='$DateOfBirth' , PhoneNumber ='$PhoneNumber' , urlAvata='$urlAvata'  WHERE username = '$username'";
        $sql_update = mysqli_query($connect,$query);
        if($sql_update)
        {
            echo 200;
        }
    }else{
            echo 504;
        }
    
?>