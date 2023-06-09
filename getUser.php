
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
    public $urlAvata;
    
    public function __construct( $idRole,$username,$fullname,$email,$idGender,$DateOfBirth,$PhoneNumber,$urlAvata)
    {
        $this->idRole = $idRole;
        $this->username = $username;
        $this->fullname=$fullname;
        $this->email=$email;
        $this->idGender= $idGender;
        $this->DateOfBirth=$DateOfBirth;
        $this->PhoneNumber=$PhoneNumber;
        $this->email=$email;
        $this->urlAvata=$urlAvata;
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
    
    $curentPage =$_GET["page"];   
    $limitLoad =$_GET["limit"];   

    $keyWord = $_GET["keyWord"];    
    $idRole = $_GET["idRole"];
    $idGender = $_GET["idGender"];

    $checkFilter=$keyWord ||$idRole||$idGender;


    if($checkFilter){
        $queryUserProfile=getQueryUserProfile($curentPage,$limitLoad,$keyWord,$idRole,$idGender);

        $queryCountUserProfile=getQueryCountUserProfile($curentPage,$limitLoad,$keyWord,$idRole,$idGender);

        // echo $queryUserProfile;
        // echo $queryCountUserProfile;
        // return;
    
        $resultUserProfile=mysqli_query($connect,$queryUserProfile)or die(mysqli_error($connect));
        while(mysqli_next_result($connect)){;}

        $resultPaginationUserProfile=mysqli_query($connect,$queryCountUserProfile)or die(mysqli_error($connect));
        while(mysqli_next_result($connect)){;}

        $arrayUser = array();
        
        if($resultUserProfile && $resultPaginationUserProfile){      
            while($row=$resultUserProfile->fetch_assoc()){       
                array_push($arrayUser,new infor($row['idRole'],$row['username'], $row['fullname'],$row['email'],
                $row['idGender'],$row['DateOfBirth'],$row['PhoneNumber'],$row['urlAvata']));
            }
    
            $row=mysqli_fetch_assoc($resultPaginationUserProfile);  
            $newCountingUser=new pagination($row['_page'],$row['_limit'], $row['_totalRows']); 
               
            echo json_encode(
                Array("data"=>$arrayUser,
                "pagination"=>$newCountingUser),JSON_UNESCAPED_UNICODE );
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


    function getQueryUserProfile($curentPage,$limitLoad,$keyWord,$idRole,$idGender){

        $lastNote=($curentPage - 1) * $limitLoad;

        $query="select * from User where idRole not in (2, 6, 7)";

        if(isset($keyWord)){
            $query.=" and (User.username like '%$keyWord%' or User.fullname like '%$keyWord%') ";
        }

        if(isset($idRole)){
            $query.=" and idRole = $idRole ";
        }

        if(isset($idGender)){
            $query.=" and User.idGender=$idGender ";
        }

        $query.=" LIMIT $limitLoad OFFSET $lastNote;";
    
        return $query;
    }

    function getQueryCountUserProfile($curentPage,$limitLoad,$keyWord,$idRole,$idGender){

        $query="select $curentPage as _page,$limitLoad as _limit,count(User.id ) as _totalRows from User where idRole not in (2, 6, 7) ";

        if(isset($keyWord)){
            $query.=" and (User.username like '%$keyWord%' or User.fullname like '%$keyWord%') ";
        }

        if(isset($idRole)){
            $query.=" and idRole = $idRole ";
        }

        if(isset($idGender)){
            $query.=" and User.idGender=$idGender ";
        }
    
        return $query;
    }

?>

