<?php
    class Ram{
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
        
    if($_SERVER['REQUEST_METHOD']==='GET'){
        get();
    }

    function get(){
        include'library/cors.php';
        include'library/connect.php';

        $keyWord=$_GET['keyWord'];

        $id=$_GET["id"]; 

        if(isset($id)){
            $query="select *from Category where ID=$id;";
            $result=mysqli_query($connect,$query);

            if($result){
                $row=$result->fetch_assoc();
                $object=new Ram($row["ID"],$row["idCategory"],$row["name"]);      
                echo json_encode($object,JSON_UNESCAPED_UNICODE );
            }
            else{
                echo 504;
            }
            return;
        }

        if(isset($keyWord)){
            
            $query="select *from Ram where name like '%$keyWord%'";
            $result=mysqli_query($connect,$query);
            convertMysqlResultToArray($result);
            return;
        }
    
        $query="select * from Ram where isActive=1";
        $result=mysqli_query($connect,$query);
        convertMysqlResultToArray($result);

    }
    function convertMysqlResultToArray($result){
        if($result){
            $array=array();
            while($row=mysqli_fetch_array($result)){
                array_push($array,new Ram($row["ID"],$row["idCategory"],$row["name"]));
            }        
            echo json_encode($array,JSON_UNESCAPED_UNICODE );
        }
        else{
            echo 504;
        }
    }
    
   

    
?>