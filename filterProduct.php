<?php
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
        $query=$query." idStatusProduct='$idStatusProduct'";
    }

 
     echo $query;

    // $result=mysqli_query($connect,$query);

    // if($result){
    //     $arr=Array(
    //         "status" => 200
    //     );
    //     echo json_encode($arr );
    // }
    // else{  
    //     $arr=Array(
    //         "status" => 504
    //     );
    //     echo json_encode($arr );
    // }

?>