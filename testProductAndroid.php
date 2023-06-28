<?php
class product{
    public $idProduct ;
    public $NameProduct;
    public $Slug;
    public $CurrentPrice; 
    public $image;


    public function __construct ($idProduct,$Name,$Slug,
                                $CurrentPrice,$image){
                                    
        $this ->idProduct = $idProduct;

        $this ->NameProduct = $Name;
        $this ->Slug = $Slug;
        $this ->CurrentPrice = $CurrentPrice;
        $this->image=$image;
    }



}


include'library/cors.php';
include'library/connect.php';

$query ="select *from Product";

$result=mysqli_query($connect,$query)or die(mysqli_error($connect));

if($result){      
    $array=array();
    while($row=$result->fetch_array()){
  
   
       $DetailProduct=new product(
           $row['Id'],
           $row['Name'],$row['Slug'],
           $row['CurrentPrice'],$row["image"]);            
           array_push($array,$DetailProduct);
    }

    echo json_encode( $array,JSON_UNESCAPED_UNICODE);
          
}
else{
    echo mysqli_error($connect). 504;
} 


?>

