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

include'library/cors.php';
include'library/connect.php';

$query ="select *from Product";

$result=mysqli_query($connect,$query)or die(mysqli_error($connect));

if($result){      
    $row=$result->fetch_array();
                        
    $Specifications=new Specifications($row['CpuName'],$row['RamName'],$row['DiskName'],$row['VgaName'],
     $row['ScreenName'],$row['ColorName'],$row['OsName']);

    $DetailProduct=new product(
        $row['Id'],$row['Category'], $row['TradeMark'],
        $Specifications,$row['Name'],$row['Slug'],
        $row['CurrentPrice'],$row["image"]);                
                
    echo json_encode( $DetailProduct,JSON_UNESCAPED_UNICODE);
          
}
else{
    echo mysqli_error($connect). 504;
} 


?>

