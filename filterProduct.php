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

    include'library/cors.php';
    include'library/connect.php';

    $idCategoryInput =$_POST['idCategoryInput'];
    $IDTradeMarkInput =$_POST['IDTradeMarkInput'];    
    $idStatusProduct =$_POST['idStatusProduct'];

    $query="select *from Product where ";

    $count=0;
    
    if($idCategoryInput!=-1){
        $count=1;
        $query=$query."idCategory='$idCategoryInput'";
    }

    if($IDTradeMarkInput!=-1){
        if($count==1){
            $query=$query." and ";
        }else{
            $count=1;
        }
        $query=$query."IDTradeMark='$IDTradeMarkInput'";
    }

    if($idStatusProduct!=-1){
        if($count==1){
            $query=$query." and ";
        }else{
            $count=1;
        }
        $query=$query."idStatusProduct='$idStatusProduct'";
    }

 
    // echo $query;

    $result=mysqli_query($connect,$query);
    
    if($result){
        $array=array();

        while($row=mysqli_fetch_array($result)){           
            $newProduct=new product(
                $row['Id'],$row['idCategory'], $row['IDTradeMark'],
                $row['IdSpecifications'],$row['Name'],$row['Slug'],
                $row['CurrentPrice'],$row['OldPrice'],$row['dateDiscount']);
            array_push($array,$newProduct);            
        }
        if(sizeof($array)==0){            
            echo 204;
        }
        else{
            echo json_encode($array,JSON_UNESCAPED_UNICODE );
        }
        
     
    }
    else{  
        
        echo 504;
    }

?>