
<?php

    class Category{
        public $ID;
        public $name;  
        public $slug;
        
        public function __construct( $ID,$name,$slug)
        {
            $this->ID = $ID;
            $this->name = $name;
            $this->slug=$slug;
    
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
                $object=new Category($row['ID'],$row['name'], $row['slug']);      
                echo json_encode($object,JSON_UNESCAPED_UNICODE );
            }
            else{
                echo 504;
            }
            return;
        }


        if(isset($keyWord)){
            
            $query="select *from Category where name like '%$keyWord%' and isActive=1";
            $result=mysqli_query($connect,$query);
            convertMysqlResultToArray($result);
            return;
        }
    
        $query="select * from Category where isActive = 1"; 
        $result=mysqli_query($connect,$query);
        convertMysqlResultToArray($result);

    }

    function convertMysqlResultToArray($result){
        $array=array();
    
        if($result){       
            while($row=mysqli_fetch_array($result)){
                array_push($array,new Category($row['ID'],$row['name'], $row['slug']));            
            }

        echo json_encode($array,JSON_UNESCAPED_UNICODE );
        }
        else{
            echo 504;
        }
    }
    
    
    


?>

