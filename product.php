<?php

class product{
    public $idProduct ;
    public $Category ;
    public $TradeMark;    
    public $NameProduct;
    public $Slug;
    public $CurrentPrice; 
    public $image;
    public $Specifications;

    public function __construct ($idProduct,$Category,$TradeMark,
                                $Specifications,$Name,$Slug,
                                $CurrentPrice,$image){
                                    
        $this ->idProduct = $idProduct;
        $this ->Category = $Category;
        $this ->TradeMark = $TradeMark;
        $this ->Specifications = $Specifications;
        $this ->NameProduct = $Name;
        $this ->Slug = $Slug;
        $this ->CurrentPrice = $CurrentPrice;
        $this->image=$image;
    }



}
class Specifications{

    public $CpuName;
    public $RamName;
    public $DiskName;
    public $VgaName;
    public $ScreenName;
    public $ColorName;
    public $OsName;
    
    public function __construct ($CpuName, $RamName, $DiskName, $VgaName, 
                                $ScreenName, $ColorName, $OsName){

        $this ->CpuName = $CpuName;
        $this ->RamName = $RamName;
        $this ->DiskName = $DiskName;
        $this ->VgaName = $VgaName;
        $this ->ScreenName = $ScreenName;
        $this ->ColorName = $ColorName;
        $this ->OsName = $OsName;     
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

    $query="call getAllProduct()"; 

    $result=mysqli_query($connect,$query);
    $array=array();
    
    if($result){       
        
        while($row=mysqli_fetch_array($result)){       
            
            $Specifications=new Specifications($row['CpuName'],$row['RamName'],$row['DiskName'],$row['VgaName'],
            $row['ScreenName'],$row['ColorName'],$row['OsName']);

            $newProduct=new product(
                $row['Id'],$row['Category'], $row['TradeMark'],
                $Specifications,$row['Name'],$row['Slug'],
                $row['CurrentPrice'],$row["image"]);
            array_push($array,$newProduct); 
        }
        
     echo json_encode($array,JSON_UNESCAPED_UNICODE );

    }
    else{        
        echo 504;
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
    $UrlImageProductInput=$data['UrlImageProductInput'];

    $query="call insertProduct('$idCategoryInput', '$IDTradeMarkInput', '$IdSpecificationsInput',
    '$NameInput', '$SlugInput', '$CurrentPriceInput','$UrlImageProductInput')";

    $result=mysqli_query($connect,$query);

    if($result){
        $row=mysqli_fetch_array($result);   
              
        echo $row['result'];
    }
    else{  
        
        echo 504;
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
    $urlImageProductInput=$data['urlImageProductInput'];
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

    if($dateDiscountInput!=-1){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." Product.image='$urlImageProductInput'";
    }


    $query=$query." where Id= $idProduct";
    
    // echo $query;

    $result=mysqli_query($connect,$query);

    if($result){
        
        echo 200;
    }
    else{  
        
        echo 504;
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
        echo 200;
    }
    else{  
        
        echo 504;
    }

}



?>