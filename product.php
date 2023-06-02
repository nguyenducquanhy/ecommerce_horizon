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
    $idCategoryInput =$_POST['idCategoryInput'];
    $IDTradeMarkInput =$_POST['IDTradeMarkInput'];
    // $IdSpecificationsInput =$_POST['IdSpecificationsInput'];
    // $NameInput =$_POST['NameInput'];
    // $SlugInput =$_POST['SlugInput'];
    // $CurrentPriceInput =$_POST['CurrentPriceInput'];

    echo $idCategoryInput;
    echo $IDTradeMarkInput;

    
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