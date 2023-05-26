<?php
    class user{
        


    }



    //include'library/cors.php';
    include'library/connect.php';

    $value=$_POST["value"];
    $array=array();
    array_push($array,$value);


    echo json_encode($value,JSON_UNESCAPED_UNICODE)


?>