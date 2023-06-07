<?php
include'library/cors.php';
include'library/connect.php';
    class user{
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

    $json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $array=array();
    
    for ($i=0; $i < sizeof($data); $i++) {

        $item=$data[$i];
        
        $id=$item['id'];        
        $name = $item['name'];
        $age = $item['age'];

        $value=new user($id,$name,$age);

        array_push($array,$value);    

    }

    echo json_encode($array,JSON_UNESCAPED_UNICODE);



?>