<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

    include'library/cors.php';
    include'library/connect.php';
    $username = $_GET["username"];
    class infor{
        public $ID;
        public $username;
        public $email;
        public $fullname;
        public $idGender;
        public $DateOfBirth;
        public $PhoneNumber;
        public $urlAvata;
        
        public function __construct($ID,$username,$email,$fullname,$idGender,$DateOfBirth,$PhoneNumber,$urlAvata)
        {
            $this->ID = $ID;
            $this->username = $username;
            $this->email=$email;
            $this->fullname=$fullname;
            $this->idGender = $idGender;
            $this->DateOfBirth=$DateOfBirth;
            $this->PhoneNumber=$PhoneNumber;
            $this->urlAvata = $urlAvata;   
        }
    }


    
    
    $query="select  ID ,username ,email, fullname, idGender, DateOfBirth ,PhoneNumber, urlAvata from User where username='$username'";
    $result=mysqli_query($connect,$query);
        if($result){
            $object;
            
            while($row=mysqli_fetch_array($result)){
                
                $object= new infor($row['ID'],$row['username'], $row['email'], $row['fullname'], $row['idGender'],
                $row['DateOfBirth'],$row['PhoneNumber'],$row['urlAvata']);
                
            }
    
            if ($object) {
            echo json_encode($object,JSON_UNESCAPED_UNICODE );
            }else {
                echo 504;
            }
    
        }else{
            echo 504;
        }


?>