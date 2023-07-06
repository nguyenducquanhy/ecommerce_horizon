<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");



    class infor {
        public $idRole;
        public $urlAvata;
        public $username;

        public function __construct ($idRole,$username,$urlAvata){
            $this ->urlAvata = $urlAvata;
            $this ->idRole = $idRole;
            $this -> username = $username;
        }
    } 

    if($_SERVER['REQUEST_METHOD']==='GET'){
        
        login();
        
    }


    if($_SERVER['REQUEST_METHOD']==='POST'){
 
        login();
        
    }

    function  login(){
        include'library/cors.php';
        include'library/connect.php';
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);

        $username = $data['username'];
        $password = $data['password'];

        $query="call login('$username','$password')";

        $result=mysqli_query($connect,$query);
        if($result){
                      
            $row=mysqli_fetch_array($result);
                
             //$object= new infor($row['idRole'],$row['username'],$row['urlAvata']);
            $object= new infor(2,$username,$password);

            // echo json_encode(
                //     Array("value"=>$username." ".$password,
                //     "object"=>$object),JSON_UNESCAPED_UNICODE );
                    
                echo json_encode(($object),JSON_UNESCAPED_UNICODE );
        }
        else{
            echo 504;
        }
    }

    
?>