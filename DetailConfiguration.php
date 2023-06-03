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
        $row=mysqli_fetch_array($result);   
        if($row['result']==404){            
            echo $row['result'];
        }
        else{
            $newProduct;         
            $newProduct=new DetailConfiguration($row['ID'],$row['idProduct'], $row['content']);               
                    
            echo json_encode($newProduct,JSON_UNESCAPED_UNICODE );
        }
        
    }
    else{        
        echo 504;
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
        echo $row['result'];
    }
    else{          
        echo 504;
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
        echo $row['result'];
    }
    else{          
        echo 504;
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
        echo $row['result'];
    }
    else{          
        echo 504;
    }

}


?>