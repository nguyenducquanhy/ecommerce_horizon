
<?php


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
    
    include'library/cors.php';
    include'library/connect.php';
    
     $query="select * from User where idRole <> '2'"; 

    $result=mysqli_query($connect,$query);
    $array=array();
    
    if($result){
        
        
        while($row=mysqli_fetch_array($result)){
            
            
            array_push($array,new infor($row['idRole'],$row['username'], $row['fullname'],$row['email'],
            $row['idGender'],$row['DateOfBirth'],$row['PhoneNumber']));
            
        }

        
     echo json_encode($array,JSON_UNESCAPED_UNICODE );

    }
    else{
        echo "empty!";
    }


?>

