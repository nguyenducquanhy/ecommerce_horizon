<?php

    if($_SERVER['REQUEST_METHOD']==='GET'){
        echo "get";
    }

    if($_SERVER['REQUEST_METHOD']==='POST'){
        echo "post";
    }

    if($_SERVER['REQUEST_METHOD']==='PUT'){
        echo "put";
    }

    if($_SERVER['REQUEST_METHOD']==='DELETE'){
        echo "delete";
    }

?>