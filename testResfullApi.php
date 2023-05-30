<?php
    include'library/cors.php';
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



    function getMethod(){
        $value=$_GET['getValue'];
        echo "get".$value;
    }

    function postMethod(){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        $value=$data['postValue'];
        echo "post".$value;
    }

    function putMethod(){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        $value=$data['putValue'];
        echo "put".$value;
    }

    function deleteMethod(){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        $value=$data['deleteValue'];
        echo "delete".$value;
    }

?>