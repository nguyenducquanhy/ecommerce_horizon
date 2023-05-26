<?php
    include'library/cors.php';
    include'library/connect.php';

    $value=$_POST["value"];
    
    echo json_encode($value,JSON_UNESCAPED_UNICODE)


?>