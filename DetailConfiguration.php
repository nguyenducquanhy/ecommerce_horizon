<?php
class DetailConfiguration{
    public $ID ;
    public $idProduct ;    
    public $content;
  
    public function __construct($ID,$idProduct,$content) {
        $this->ID=$ID;
        $this->idProduct=$idProduct;
        $this->content=$content;

    }

}


if($_SERVER['REQUEST_METHOD']==='GET'){
    getDetailConfigurationById();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    insertDetailConfigurationById();
}

if($_SERVER['REQUEST_METHOD']==='PUT'){
    updateDetailConfigurationById();
}

if($_SERVER['REQUEST_METHOD']==='DELETE'){
    removeDetailConfigurationById();
}

function getDetailConfigurationById(){
    include'library/cors.php';
    include'library/connect.php';

    $idProduct=$_GET["idProduct"];

    $query="call getDetailConfigurationById('$idProduct')";

    $result=mysqli_query($connect,$query);

    if($result){   
        while($row=mysqli_fetch_array($result)){           
            $newProduct=new DetailConfiguration($row['ID'],$row['idProduct'], $row['content']);
            array_push($array,$newProduct);            
        }        
     echo json_encode($array,JSON_UNESCAPED_UNICODE );
    }
    else{
        $arr=Array(
            "status" => 504
        );
        echo json_encode($arr );
    }
}

function insertDetailConfigurationById(){
    include'library/cors.php';
    include'library/connect.php';
    
    $idProduct =$_POST['idProduct'];
    $content =$_POST['content'];

    $query="call insertDetailConfigurationById('$idProduct','$content')";

    $result=mysqli_query($connect,$query);

    if($result){
        $row=mysqli_fetch_array($result);   
        $arr=Array(
            "status" => $row['result']
        );      
        echo json_encode($arr );
    }
    else{  
        $arr=Array(
            "status" => 504
        );
        echo json_encode($arr );
    }
}

function updateDetailConfigurationById(){
    include'library/cors.php';
    include'library/connect.php';
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    $idProduct =$data['idProduct'];
    $content =$data['content'];

    $query="call updateDetailConfigurationById('$idProduct','$content')";

    $result=mysqli_query($connect,$query);

    if($result){
        $row=mysqli_fetch_array($result);   
        $arr=Array(
            "status" => $row['result']
        );      
        echo json_encode($arr );
    }
    else{  
        $arr=Array(
            "status" => 504
        );
        echo json_encode($arr );
    }


}

function removeDetailConfigurationById(){
    include'library/cors.php';
    include'library/connect.php';
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    $idProduct =$data['idProduct'];

    $query="call removeDetailConfigurationById('$idProduct')";

    $result=mysqli_query($connect,$query);

    if($result){
        $row=mysqli_fetch_array($result);   
        $arr=Array(
            "status" => $row['result']
        );      
        echo json_encode($arr );
    }
    else{  
        $arr=Array(
            "status" => 504
        );
        echo json_encode($arr );
    }

}


?>