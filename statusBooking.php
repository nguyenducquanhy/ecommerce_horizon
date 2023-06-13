<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");

    include'library/cors.php';
    include'library/connect.php';

    class statusBooking{
        public $ID;
        public $nameStatus;

        function __construct($ID,$nameStatus) {
            $this->ID=$ID;
            $this->nameStatus=$nameStatus;
        }

    }

    $query="select * FROM statusBooking";
    $result=mysqli_query($connect,$query);
    $array=array();
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            array_push($array,new statusBooking($row['ID'],$row['nameStatus']));
        }
        echo json_encode($array,JSON_UNESCAPED_UNICODE);
    }
    else{
        echo 504;
    }


?>