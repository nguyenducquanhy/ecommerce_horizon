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
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");


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
      
    $curentPage =$_GET["page"];   
    $limitLoad =$_GET["limit"];   
    
    $idStatusProductInput =$_GET["idStatusProductInput"];  

    $slug=$_GET["slug"];

    $keyWord=$_GET["keyWord"]; 
    $nameCategoryInput =$_GET["nameCategoryInput"]; 
    $nameCpuInput =$_GET["nameCpuInput"]; 
    $nameRamInput =$_GET["nameRamInput"]; 
    $nameDiskInput =$_GET["nameDiskInput"]; 
    $nameVgaInput =$_GET["nameVgaInput"]; 
    $nameScreenInput =$_GET["nameScreenInput"]; 
    $nameColorInput =$_GET["nameColorInput"]; 
    $nameOsInput=$_GET["nameOsInput"];
    $nameTradeMarkInput=$_GET["nameTradeMarkInput"];

    if(isset($slug)){

            $queryGetDetailProductById ="call getDetailProductBySlug('$slug')";

            $resultGetDetailProductById=mysqli_query($connect,$queryGetDetailProductById)or die(mysqli_error($connect));

            if($resultGetDetailProductById){      
                $row=$resultGetDetailProductById->fetch_array();
                        
                    $Specifications=new Specifications($row['CpuName'],$row['RamName'],$row['DiskName'],$row['VgaName'],
                    $row['ScreenName'],$row['ColorName'],$row['OsName']);

                    $DetailProduct=new product(
                        $row['Id'],$row['Category'], $row['TradeMark'],
                        $Specifications,$row['Name'],$row['Slug'],
                        $row['CurrentPrice'],$row["image"]);
                
                
                echo json_encode( $DetailProduct,JSON_UNESCAPED_UNICODE);
                return;
            }
            else{
                echo mysqli_error($connect). 504;
                return;
            } 

    }

    $queryProducts=""; 
    $queryCountProducts="";

    $isForcusSearching=isset($keyWord) ||isset($nameCategoryInput) ||isset($nameCpuInput) ||isset($nameRamInput)|| 
                    isset($nameDiskInput) ||isset($nameVgaInput) ||
                    isset($nameScreenInput) ||isset($nameColorInput) ||isset($nameOsInput)||isset($nameTradeMarkInput);

    if($isForcusSearching){      
      
        $queryProducts=concatQuerySearchProducts($keyWord,$curentPage,$limitLoad,$idStatusProductInput,
        $nameCategoryInput ,$nameCpuInput ,$nameRamInput ,$nameDiskInput ,
        $nameVgaInput ,$nameScreenInput ,$nameColorInput ,$nameOsInput,$nameTradeMarkInput );

        // echo $queryProducts;
        // return
        

        $queryCountProducts=concatQueryCountingSearchProducts($keyWord,$curentPage,$limitLoad,$idStatusProductInput,
        $nameCategoryInput ,$nameCpuInput ,$nameRamInput ,$nameDiskInput ,
        $nameVgaInput ,$nameScreenInput ,$nameColorInput ,$nameOsInput,$nameTradeMarkInput );        

    }
    else{        
        $queryProducts="Call getAllProduct('$curentPage','$limitLoad','$idStatusProductInput');";
        $queryCountProducts="Call getCountAllProduct('$curentPage','$limitLoad','$idStatusProductInput')";    
    }
    
    $resultProducts=mysqli_query($connect,$queryProducts)or die(mysqli_error($connect));
    while(mysqli_next_result($connect)){;}

    $resultPaginationProduct=mysqli_query($connect,$queryCountProducts)or die(mysqli_error($connect));
    while(mysqli_next_result($connect)){;}

    $arrayProduct=array();
    if($resultProducts && $resultPaginationProduct){      
        while($row=$resultProducts->fetch_assoc()){       
                
            $Specifications=new Specifications($row['CpuName'],$row['RamName'],$row['DiskName'],$row['VgaName'],
            $row['ScreenName'],$row['ColorName'],$row['OsName']);

            $newProduct=new product(
                $row['Id'],$row['Category'], $row['TradeMark'],
                $Specifications,$row['Name'],$row['Slug'],
                $row['CurrentPrice'],$row["image"]);
            array_push($arrayProduct,$newProduct);
        }

        $row=mysqli_fetch_assoc($resultPaginationProduct);  
        $newCountingProduct=new pagination($row['_page'],$row['_limit'], $row['_totalRows']); 
           
        echo json_encode(
            Array("data"=>$arrayProduct,
            "pagination"=>$newCountingProduct),JSON_UNESCAPED_UNICODE );
    }
    else{
        echo 504;
    }    
}

function concatQuerySearchProducts($keyWord,$curentPage,$limitLoad,$idStatusProductInput,
                $nameCategoryInput ,$nameCpuInput ,$nameRamInput ,$nameDiskInput ,
                $nameVgaInput ,$nameScreenInput ,$nameColorInput ,$nameOsInput,$nameTradeMarkInput ){

    $query=concatConditional($keyWord,$nameCategoryInput ,$nameCpuInput ,$nameRamInput ,$nameDiskInput ,
    $nameVgaInput ,$nameScreenInput ,$nameColorInput ,$nameOsInput,$nameTradeMarkInput );
    $lastNote=($curentPage-1)*$limitLoad;

    $sql="select Product.id      as Id,
            Product.Name         as Name,
            Product.Slug         as Slug,
            Product.CurrentPrice as CurrentPrice,
            Product.image        as image,
            TradeMark.name       as TradeMark,
            Category.name        as Category,
            Cpu.name             as CpuName,
            Ram.name             as RamName,
            D.name               as DiskName,
            V.name               as VgaName,
            S.name               as ScreenName,
            C.name               as ColorName,
            O.name as OsName
            from Product
            join TradeMark on Product.IDTradeMark = TradeMark.ID
            join Category on Product.idCategory = Category.ID
            join Specification SP on Product.IdSpecifications = SP.ID
            join Cpu on SP.IdCPU = Cpu.ID
            join Ram on SP.IdRAM = Ram.ID
            join Disk D on SP.IdDISK = D.ID
            join Vga V on SP.IdVGA = V.ID
            join Screen S on SP.IdSCREEN = S.ID
            join Color C on SP.IdCOLOR = C.ID
            join OS O on SP.IdOS = O.ID
            where idStatusProduct = ".$idStatusProductInput. " and ". $query ." LIMIT $limitLoad OFFSET $lastNote;";
    return $sql;
}

function concatConditional($keyWord,$nameCategoryInput ,$nameCpuInput ,$nameRamInput ,$nameDiskInput ,
$nameVgaInput ,$nameScreenInput ,$nameColorInput ,$nameOsInput ,$nameTradeMarkInput){
    $query="";
    $count=0;
    if(isset($keyWord)){       
        $count=1;
        $query=$query." Product.Name like '%$keyWord%'";
    }

    if(isset($nameCategoryInput)){     
           if($count==1){
            $query=$query." and ";
        }else{
            $count=1;
        }
        $query=$query." Category.name like '$nameCategoryInput'";
    }

    if(isset($nameCpuInput)){     
        if($count==1){
         $query=$query." and ";
     }else{
         $count=1;
     }
     $query=$query."Cpu.name like '$nameCpuInput'";
    }
    
    if(isset($nameRamInput)){     
           if($count==1){
            $query=$query." and ";
        }else{
            $count=1;
        }
        $query=$query." Ram.name like '$nameRamInput'";
    }

    if(isset($nameDiskInput)){     
        if($count==1){
         $query=$query." and ";
     }else{
         $count=1;
     }
     $query=$query."D.name like '$nameDiskInput'";
    }

    if(isset($nameVgaInput)){     
        if($count==1){
         $query=$query." and ";
     }else{
         $count=1;
     }
     $query=$query." V.name like '$nameVgaInput'";
    }

    if(isset($nameScreenInput)){     
        if($count==1){
        $query=$query." and ";
    }else{
        $count=1;
    }
    $query=$query." S.name like '$nameScreenInput'";
    }
    
    if(isset($nameColorInput)){     
            if($count==1){
            $query=$query." and ";
        }else{
            $count=1;
        }
        $query=$query." C.name like '$nameColorInput'";
    }

    if(isset($nameOsInput)){     
        if($count==1){
        $query=$query." and ";
    }else{
        $count=1;
    }
    $query=$query." O.name like '$nameOsInput'";
    }

    if(isset($nameTradeMarkInput)){     
        if($count==1){
        $query=$query." and ";
    }else{
        $count=1;
    }
    $query=$query." TradeMark.name like '$nameTradeMarkInput'";
    }

    
    return $query;
}

function concatQueryCountingSearchProducts($keyWord,$curentPage,$limitLoad,$idStatusProductInput,
                $nameCategoryInput ,$nameCpuInput ,$nameRamInput ,$nameDiskInput ,
                $nameVgaInput ,$nameScreenInput ,$nameColorInput ,$nameOsInput,$nameTradeMarkInput ){

    
    $query=concatConditional($keyWord,$nameCategoryInput ,$nameCpuInput ,$nameRamInput ,$nameDiskInput ,
    $nameVgaInput ,$nameScreenInput ,$nameColorInput ,$nameOsInput,$nameTradeMarkInput );
    

    $sql="select $curentPage as _page,
            $limitLoad as _limit,
            count(Product.id ) as _totalRows
            from Product
            join TradeMark on Product.IDTradeMark = TradeMark.ID
            join Category on Product.idCategory = Category.ID
            join Specification SP on Product.IdSpecifications = SP.ID
            join Cpu on SP.IdCPU = Cpu.ID
            join Ram on SP.IdRAM = Ram.ID
            join Disk D on SP.IdDISK = D.ID
            join Vga V on SP.IdVGA = V.ID
            join Screen S on SP.IdSCREEN = S.ID
            join Color C on SP.IdCOLOR = C.ID
            join OS O on SP.IdOS = O.ID
            where idStatusProduct = ".$idStatusProductInput. " and ". $query;
    return $sql;
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
    $urlImageProductInput=$data['urlImageProductInput'];

    $query="call insertProduct('$idCategoryInput', '$IDTradeMarkInput', '$IdSpecificationsInput',
    '$NameInput', '$SlugInput', '$CurrentPriceInput','$urlImageProductInput')";

    //echo $query;

    $result=mysqli_query($connect,$query);

    if($result){
        $row=mysqli_fetch_array($result);   
              
        if($row['result']==200){


            echo $row['idProduct'];
        }else{
            echo $row['result'];
        }
        
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
    
    if(isset($idCategoryInput)){       
        $count=1;
        $query=$query."idCategory='$idCategoryInput'";
    }

    if(isset($IDTradeMarkInput)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query."IDTradeMark='$IDTradeMarkInput'";
    }

    if(isset($IdSpecificationsInput)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." IdSpecifications='$IdSpecificationsInput'";
    }

    if(isset($NameInput)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." Name='$NameInput'";
    }

    if(isset($SlugInput)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." Slug='$SlugInput'";
    }

    if(isset($CurrentPriceInput)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." CurrentPrice='$CurrentPriceInput'";
    }

    if(isset($OldPriceInput)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." OldPrice='$OldPriceInput'";
    }

    if(isset($dateDiscountInput)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." dateDiscount='$dateDiscountInput'";
    }

    if(isset($urlImageProductInput)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query." Product.image='$urlImageProductInput'";
    }


    $query=$query." where Id= $idProduct";
    
     //echo $query;

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