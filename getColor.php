<?php
    class color{
        public $ID;
        public $idCategory;
        public $name;

        public function __construct($ID,$idCategory,$name){
            $this->ID=$ID;
            $this->idCategory=$idCategory;
            $this->name=$name;
        }
    }
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
        
    if($_SERVER['REQUEST_METHOD']==='GET'){
        getColor();
    }

    function getColor(){
        include'library/cors.php';
        include'library/connect.php';

        $keyWord=$_GET['keyWord'];


        if(isset($keyWord)){
            
            $query="select *from Color where name like '%$keyWord%' and isActive=1";
            $result=mysqli_query($connect,$query);
            convertMysqlResultToArray($result);
            return;
        }
    
        $query="select * from Color where isActive=1";
        $result=mysqli_query($connect,$query);
        convertMysqlResultToArray($result);
    }

    function convertMysqlResultToArray($result){
        if($result){
            $array=array();
            while($row=mysqli_fetch_array($result)){
                array_push($array,new color($row["ID"],$row["idCategory"],$row["name"]));
            }        
            echo json_encode($array,JSON_UNESCAPED_UNICODE );
        }
        else{
            echo 504;
        }
    }
?>