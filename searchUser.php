
<?php

    // include'library/cors.php';
    include'library/connect.php';
$username = $_POST["username"];
$fullname =  $_POST["fullname"];

class infor{
    public $username;  
    public $fullname;
    public $email;
    public $DateOfBirth;
    public $PhoneNumber;
    
    public function __construct($username,$fullname,$email,$DateOfBirth,$PhoneNumber)
    {
        $this->username = $username;
        $this->fullname=$fullname;
        $this->email=$email;
        $this->DateOfBirth=$DateOfBirth;
        $this->PhoneNumber=$PhoneNumber;
        $this->email=$email;
    }
    function getFullname(){
        return $this->fullname;
    }
}
    
     $query="select * from User where username like '$username%' or fullname ='$fullname%'"; 

    $result=mysqli_query($connect,$query);
    $array=array();
    
    if($result){
        
        
        while($row=mysqli_fetch_array($result)){
            
            
            array_push($array,new infor($row['username'], $row['fullname'],$row['email'],
            $row['DateOfBirth'],$row['PhoneNumber']));
            
        }

        
     echo json_encode($array,JSON_UNESCAPED_UNICODE );

    }
    else{
        echo "504";
    }


?>

