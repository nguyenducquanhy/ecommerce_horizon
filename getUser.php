
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
    
class pagination{
    public $_page;
    public $_limit;
    public $_totalRows;

    public function __construct ($_page, $_limit, $_totalRows){
        $this->_page=$_page;
        $this->_limit=$_limit;
        $this->_totalRows=$_totalRows;
    }

}

    include'library/cors.php';
    include'library/connect.php';

    $keyWord = $_GET["keyWord"];
    $curentPage =$_GET["page"];   
    $limitLoad =$_GET["limit"];   


    if(isset($keyWord)){
        $queryUserProfile="Call getSearchUsers('$curentPage','$limitLoad','%$keyWord%');";
        $queryCountUserProfile="Call getCountSearchUsers('$curentPage','$limitLoad','%$keyWord%')";

        $result = mysqli_query($connect, $query);
        $array = array();
        
        if($result){
            while ($row=mysqli_fetch_array($result)){
                array_push($array,new infor($row['username'], $row['fullname'], $row['email'],
                $row['DateOfBirth'], $row['PhoneNumber'], $row['idGender'], $row['idRole']));
            }
            echo json_encode($array,JSON_UNESCAPED_UNICODE );
            return;
        }
        else{
            echo 504;
            return;
        }
    }



    $queryUserProfile="Call getAllUser('$curentPage','$limitLoad');";
    $queryCountUserProfile="Call getCountForAllUser('$curentPage','$limitLoad')";

    
    $resultUserProfile=mysqli_query($connect,$queryUserProfile)or die(mysqli_error($connect));
    while(mysqli_next_result($connect)){;}

    $resultPaginationUserProfile=mysqli_query($connect,$queryCountUserProfile)or die(mysqli_error($connect));
    while(mysqli_next_result($connect)){;}

    $arrayUser=array();
    if($resultUserProfile && $resultPaginationUserProfile){      
        while($row=$resultUserProfile->fetch_assoc()){       
            array_push($arrayUser,new infor($row['idRole'],$row['username'], $row['fullname'],$row['email'],
            $row['idGender'],$row['DateOfBirth'],$row['PhoneNumber']));
        }

        $row=mysqli_fetch_assoc($resultPaginationUserProfile);  
        $newCountingUser=new pagination($row['_page'],$row['_limit'], $row['_totalRows']); 
           
        echo json_encode(
            Array("data"=>$arrayUser,
            "pagination"=>$newCountingUser),JSON_UNESCAPED_UNICODE );
    }
    else{
        echo 504;
    }    

?>

