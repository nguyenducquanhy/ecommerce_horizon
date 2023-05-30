<?php

    class User{
        public $id;
        public $name;
        public $age;
        
        public function __construct($id,$name,$age)
        {
            $this->id=$id;
            $this->name=$name;
            $this->age = $age;   
        }

    }

    include'library/cors.php';
    if($_SERVER['REQUEST_METHOD']==='GET'){
        getMethod();
    }

    if($_SERVER['REQUEST_METHOD']==='POST'){
        postMethod();
    }

    if($_SERVER['REQUEST_METHOD']==='PUT'){
        putMethod();
    }

    if($_SERVER['REQUEST_METHOD']==='DELETE'){
        deleteMethod();
    }

    function getMethod(){
        $value=$_GET['getValue'];
        echo json_encode("get".$value,JSON_UNESCAPED_UNICODE);
    }

    function postMethod(){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        $item=$data['postValue'];
        
        $id=$item['id'];        
        $name = $item['name'];
        $age = $item['age'];

        $value=new User($id,$name,$age);

        echo json_encode($value ,JSON_UNESCAPED_UNICODE);
    }

    function putMethod(){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        $value=$data['putValue'];
        echo json_encode("put".$value,JSON_UNESCAPED_UNICODE);
    }

    function deleteMethod(){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        $value=$data['deleteValue'];
        echo json_encode("delete".$value,JSON_UNESCAPED_UNICODE);
    }

?>