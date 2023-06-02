<?php
include'library/cors.php';
include'library/connect.php';


if($_SERVER['REQUEST_METHOD']==='GET'){
    getMethod();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    postMethod();
}

if($_SERVER['REQUEST_METHOD']==='PUT'){
    putMethod();
}

if($_SERVER['REQUEST_METHOD']==='DELETE'){
    deleteMethod();
}

?>