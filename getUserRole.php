
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

class UserRole{
    public $ID;
    public $NAME;
    
    public function __construct( $ID,$NAME)
    {
        $this->ID = $ID;
        $this->NAME =$NAME;
    }
}
    include'library/cors.php';
    include'library/connect.php';
    
    $query="select * from UserRole"; 

    $result=mysqli_query($connect,$query);
    $array=array();
    
    if($result){
        
        
        while($row=mysqli_fetch_array($result)){
            
            
            array_push($array,new UserRole($row['ID'],$row['NAME']));
            
        }

        
     echo json_encode($array,JSON_UNESCAPED_UNICODE );

    }
    else{
        echo "empty!";
    }


?>

