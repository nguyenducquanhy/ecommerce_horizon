<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

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
        echo json_encode("get".$value,JSON_UNESCAPED_UNICODE);
    }

    function postMethod(){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        echo json_encode("post :".$data ,JSON_UNESCAPED_UNICODE);
    }

    function putMethod(){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        


        echo json_encode("put ".$data['idRole'].$data['username'].$data['fullname'] ,JSON_UNESCAPED_UNICODE);


    }

    function deleteMethod(){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        echo json_encode("delete ".$data,JSON_UNESCAPED_UNICODE);
    }

?>