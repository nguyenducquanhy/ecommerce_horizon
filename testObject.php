<?php
    class user{
        


    }



    //include'library/cors.php';
    include'library/connect.php';

    $value=$_POST["value"];
    
    $array=array();

    foreach($item as $value){
        array_push($array,$item);
    }

    echo json_encode($array,JSON_UNESCAPED_UNICODE)


?>