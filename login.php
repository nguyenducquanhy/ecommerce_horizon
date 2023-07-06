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
        $username = $_POST['username'];
        $password = $_POST['password'];
        login($username,$password);
        
    }


    if($_SERVER['REQUEST_METHOD']==='POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        login($username,$password);
        
    }

    function  login($username,$password){
        include'library/cors.php';
        include'library/connect.php';
        $query="call login('$username','$password')";

        $result=mysqli_query($connect,$query);
        if($result){
          
            
            $row=mysqli_fetch_array($result);
                
            $object= new infor($row['idRole'],$row['username'],$row['urlAvata']);
    
            if ($object) {
                echo json_encode(
                    Array("value"=>$username." ".$password,
                    "object"=>$object),JSON_UNESCAPED_UNICODE );

                    //echo json_encode(($object),JSON_UNESCAPED_UNICODE );
            }
        }
        else{
            echo 504;
        }
    }

    
?>