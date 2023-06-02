<?php
//include'library/cors.php';
include'library/connect.php';


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

}

function insertProduct(){

 
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        


        // echo json_encode("put ".$data['idRole'].$data['username'].$data['fullname'] ,JSON_UNESCAPED_UNICODE);

    $idCategoryInput =$data['idCategoryInput'];
    $IDTradeMarkInput =$data['IDTradeMarkInput'];
    $IdSpecificationsInput =$data['IdSpecificationsInput'];
    $NameInput =$data['NameInput'];
    $SlugInput =$data['SlugInput'];
    $CurrentPriceInput =$data['CurrentPriceInput'];

    echo $idCategoryInput;    
    echo $IDTradeMarkInput;
    echo $IdSpecificationsInput;    
    echo $NameInput;
    echo $SlugInput;    
    echo $CurrentPriceInput;

    
}

function updateProduct(){
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    echo json_encode("put ".$data ,JSON_UNESCAPED_UNICODE);

}

function hideProduct(){
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    echo json_encode("put ".$data ,JSON_UNESCAPED_UNICODE);
}



?>