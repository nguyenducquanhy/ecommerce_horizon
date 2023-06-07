<?php

class depot{
    public $ID;
    public $idPRoduct;
    public $quantily;
    public $da_co;
    public $upcomingGoods;

    function __construct($ID,$idPRoduct,$quantily,$da_co,$upcomingGoods){
        $this->ID=$ID;
        $this->idPRoduct=$idPRoduct;
        $this->quantily=$quantily;
        $this->da_co=$da_co;
        $this->upcomingGoods=$upcomingGoods;
    }
}
  
class pagination{
    public $_page;
    public $_limit;
    public $_totalRows;

    public function __construct ($_page, $_limit, $_totalRows){
        $this->_page=$_page;
        $this->_limit=$_limit;
        $this->_totalRows=$_totalRows;
    }

}



if($_SERVER['REQUEST_METHOD']==='GET'){
    getDepot();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    insertDepot();
}

if($_SERVER['REQUEST_METHOD']==='PUT'){
    updateDepot();
}

function getDepot(){
    include'library/cors.php';
    include'library/connect.php';

    
    $curentPage =$_GET["page"];   
    $limitLoad =$_GET["limit"];   

    $queryDepot="Call getDepots('$curentPage','$limitLoad');";
    $queryCountingDepot="Call getCountingDepots('$curentPage','$limitLoad')";

    
    $resultDepot=mysqli_query($connect,$queryDepot)or die(mysqli_error($connect));
    while(mysqli_next_result($connect)){;}

    $resultPaginationDepot=mysqli_query($connect,$queryCountingDepot)or die(mysqli_error($connect));
    while(mysqli_next_result($connect)){;}

    $arrayDepot=array();
    if($resultDepot && $resultPaginationDepot){      
        while($row=$resultDepot->fetch_assoc()){       
            array_push($arrayDepot,new depot($row['ID'],$row['idPRoduct'], $row['quantily'],$row['da_co'],
            $row['upcomingGoods']));
        }

        $row=mysqli_fetch_assoc($resultPaginationDepot);  
        $newCountingDepot=new pagination($row['_page'],$row['_limit'], $row['_totalRows']); 
           
        echo json_encode(
            Array("data"=>$arrayDepot,
            "pagination"=>$newCountingDepot),JSON_UNESCAPED_UNICODE );
    }
    else{
        echo 504;
    }    

 }

function insertDepot(){
    include'library/cors.php';
    include'library/connect.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    $idProduct =$data['idProduct'];
    $quantily =$data['quantily'];
    
    $query="insert into Depot(idPRoduct, quantily, da_co, upcomingGoods) value($idProduct, $quantily,0,null);";

    $result=mysqli_query($connect,$query);

    if($result){
        echo 200;
    }
    else{          
        echo 504;
    }



}

function updateDepot(){
    include'library/cors.php';
    include'library/connect.php';

    


}




?>