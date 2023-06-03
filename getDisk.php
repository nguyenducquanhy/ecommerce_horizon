<?php
    class Disk{
        public $ID;
        public $idCategory;
        public $name;

        public function __construct($ID,$idCategory,$name){
            $this->ID=$ID;
            $this->idCategory=$idCategory;
            $this->name=$name;
        }
    }

    include'library/cors.php';
    include'library/connect.php';
    
    $query="select * from Disk where isActive=1";
    $result=mysqli_query($connect,$query);

    if($result){
        $array=array();
        while($row=mysqli_fetch_array($result)){
            array_push($array,new Disk($row["ID"],$row["idCategory"],$row["name"]));
        }        
        echo json_encode($array,JSON_UNESCAPED_UNICODE );
    }
    else{
        echo 504;
    }
?>