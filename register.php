<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

if($_SERVER['REQUEST_METHOD']==='GET'){
    register();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    register();
}

function register(){
    include'library/cors.php';
    include'library/connect.php';
    $idRole = 1;
    $username=$_POST["username"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $idGender = $_POST["idGender"];
    $DateOfBirth = $_POST["DateOfBirth"];
    $PhoneNumber = $_POST["PhoneNumber"];
    $urlAvata = $_POST["urlAvata"];


    $sql="select * from User WHERE username = '$username'";
    $old = mysqli_query($connect,$sql);
    $row =  mysqli_num_rows($old);
    if($row > 0){
        echo 503;
    }else{
        $sqli ="insert into User(idRole, username, fullname, email, password, idGender, DateOfBirth, PhoneNumber,urlAvata) VALUES 
        ('$idRole','$username','$fullname','$email','$password','$idGender','$DateOfBirth','$PhoneNumber','$urlAvata')";
        $insert = mysqli_query($connect,$sqli);
        if($insert){
            echo 200;
            sendOTP($username,$email);
        }else{
            echo 504;
        }
    }
}

    
?>