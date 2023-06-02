<?php

class product{
    public $idProduct ;

    public $idCategory ;
    public $IDTradeMark;
    public $IdSpecifications;
    public $Name;
    public $Slug;
    public $CurrentPrice;
    public $OldPrice ;
    public $dateDiscount;

    public function __construct ($idProduct,$idCategory,$IDTradeMark,
                                $IdSpecifications,$Name,$Slug,
                                $CurrentPrice,$OldPrice,$dateDiscount){
                                    
        $this ->idProduct = $idProduct;
        $this ->idCategory = $idCategory;
        $this ->IDTradeMark = $IDTradeMark;
        $this ->IdSpecifications = $IdSpecifications;
        $this ->Name = $Name;
        $this ->Slug = $Slug;
        $this ->CurrentPrice = $CurrentPrice;
        $this ->OldPrice = $OldPrice;
        $this ->dateDiscount = $dateDiscount;
    }



}


if($_SERVER['REQUEST_METHOD']==='GET'){
    getProduct();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    insertProduct();
}

if($_SERVER['REQUEST_METHOD']==='PUT'){
    updateProduct();
}

if($_SERVER['REQUEST_METHOD']==='DELETE'){
    hideProduct();
}


function getProduct(){
    include'library/cors.php';
    include'library/connect.php';

    $query="select * from Product "; 

    $result=mysqli_query($connect,$query);
    $array=array();
    
    if($result){       
        
        while($row=mysqli_fetch_array($result)){           
            $newProduct=new product(
                $row['Id'],$row['idCategory'], $row['IDTradeMark'],
                $row['IdSpecifications'],$row['Name'],$row['Slug'],
                $row['CurrentPrice'],$row['OldPrice'],$row['dateDiscount']);
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

function insertProduct(){
    include'library/cors.php';
    include'library/connect.php';
 
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    $idCategoryInput =$data['idCategoryInput'];
    $IDTradeMarkInput =$data['IDTradeMarkInput'];
    $IdSpecificationsInput =$data['IdSpecificationsInput'];
    $NameInput =$data['NameInput'];
    $SlugInput =$data['SlugInput'];
    $CurrentPriceInput =$data['CurrentPriceInput'];

    $query="call insertProduct('$idCategoryInput', '$IDTradeMarkInput', '$IdSpecificationsInput',
    '$NameInput', '$SlugInput', '$CurrentPriceInput')";

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

function updateProduct(){
    include'library/cors.php';
    include'library/connect.php';
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    $idProduct =$data['idProduct'];

    $idCategoryInput =$data['idCategoryInput'];
    $IDTradeMarkInput =$data['IDTradeMarkInput'];
    $IdSpecificationsInput =$data['IdSpecificationsInput'];
    $NameInput =$data['NameInput'];
    $SlugInput =$data['SlugInput'];
    $CurrentPriceInput =$data['CurrentPriceInput'];
    $OldPriceInput =$data['OldPriceInput'];
    $dateDiscountInput =$data['dateDiscountInput'];

    $query="update Product SET ";

    $count=0;
    
    if($idCategoryInput!=-1){       
        $count=1;
        $query=$query."idCategory='$idCategoryInput'";
    }

    if($IDTradeMarkInput!=-1){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query."IDTradeMark='$IDTradeMarkInput'";
    }

    if($IdSpecificationsInput!=-1){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." IdSpecifications='$IdSpecificationsInput'";
    }

    if($NameInput!=-1){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." Name='$NameInput'";
    }

    if($SlugInput!=-1){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." Slug='$SlugInput'";
    }

    if($CurrentPriceInput!=-1){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." CurrentPrice='$CurrentPriceInput'";
    }

    if($OldPriceInput!=-1){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." OldPrice='$OldPriceInput'";
    }

    if($dateDiscountInput!=-1){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." dateDiscount='$dateDiscountInput'";
    }

    $query=$query." where Id= $idProduct";
    
    // echo $query;

    $result=mysqli_query($connect,$query);

    if($result){
        $arr=Array(
            "status" => 200
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

function hideProduct(){
    include'library/cors.php';
    include'library/connect.php';
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    echo json_encode("put ".$data ,JSON_UNESCAPED_UNICODE);

    $idProduct =$data['idProduct'];

    $query=" update Product SET idStatusProduct=2 where Id= '$idProduct'";
    
    // echo $query;

    $result=mysqli_query($connect,$query);

    if($result){
        $arr=Array(
            "status" => 200
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