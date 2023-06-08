<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    class infor{
        public $idRole;
        public $username;  
        public $fullname;
        public $email;
        public $idGender;
        public $DateOfBirth;
        public $PhoneNumber;
        
        public function __construct( $idRole,$username,$fullname,$email,$idGender,$DateOfBirth,$PhoneNumber)
        {
            $this->idRole = $idRole;
            $this->username = $username;
            $this->fullname=$fullname;
            $this->email=$email;
            $this->idGender= $idGender;
            $this->DateOfBirth=$DateOfBirth;
            $this->PhoneNumber=$PhoneNumber;
            $this->email=$email;
        }
        function getFullname(){
            return $this->fullname;
        }
    }

    if($_SERVER['REQUEST_METHOD']==='POST'){
        insert();
    }

    function insert(){
        include'library/cors.php';
        include'library/connect.php';
    
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);

        $isCheck=$data['isCheck'];
        $arrInput=$data['data'];


        if($isCheck==1){
            $array=array();
        
            for ($i=0; $i < sizeof($arrInput); $i++) {
        
                $row=$arrInput[$i];
               
                $value=new infor($row['idRole'],$row['username'], $row['fullname'],$row['email'],
                $row['idGender'],$row['DateOfBirth'],$row['PhoneNumber']);
        
                array_push($array,$value);    
        
            }
        
            echo json_encode($array,JSON_UNESCAPED_UNICODE);
        }
    
    
    
        
    }
    



?>