<?php

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
        $value=$_POST['postValue'];
        echo "post".$value;
    }

    function putMethod(){
        $value=$_POST['putValue'];
        echo "put".$value;
    }

    function deleteMethod(){
        $value=$_POST['deleteValue'];
        echo "delete".$value;
    }

?>