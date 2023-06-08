<?php
class booking{
    public $ID;
    public $nameStatus;
    public $nameOfBuyer;
    public $dateBooking;
    public $TotalMoneyBill;

    public function __construct( $ID, $nameStatus,$nameOfBuyer,$dateBooking,$TotalMoneyBill){
        $this->ID=$ID;
        $this->nameStatus=$nameStatus;
        $this->nameOfBuyer=$nameOfBuyer;
        $this->dateBooking=$dateBooking;
        $this->TotalMoneyBill=$TotalMoneyBill;       
     }

}


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");


if($_SERVER['REQUEST_METHOD']==='GET'){
    getBooking();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    insertBooking();
}

if($_SERVER['REQUEST_METHOD']==='PUT'){
    updateBooking();
}

if($_SERVER['REQUEST_METHOD']==='DELETE'){
    hideBooking();
}

function  getBooking(){
    include'library/cors.php';
    include'library/connect.php';

   


    $query="select Booking.ID,sB.nameStatus,nameOfBuyer,Booking.dateBooking,TotalMoneyBill
    from Booking join statusBooking sB on sB.ID = Booking.idStatusBooking;";

    $result=mysqli_query($connect,$query);

    $arrayBooking=array();

    if($result){      
        while($row=$result->fetch_assoc()){       
            $newBooking=new booking($row['ID'], $row['nameStatus'],$row['nameOfBuyer'],$row['dateBooking'],$row['TotalMoneyBill']);
            array_push($arrayBooking,$newBooking);
        }

        echo json_encode($arrayBooking,JSON_UNESCAPED_UNICODE );
    }
    else{
        echo 504;
    }    
}

function  insertBooking(){
    include'library/cors.php';
    include'library/connect.php';
 
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    $idCouponInput =$data['idCouponInput'];
    $idUserInput  =$data['idUserInput'];
    $idStatusBookingInput =$data['idStatusBookingInput'];    
    $nameOfBuyerInput =$data['nameOfBuyerInput'];
    $addressOfBuyerInput =$data['addressOfBuyerInput'];
    $phoneNumberOfBuyerInput =$data['phoneNumberOfBuyerInput'];
    $emailOfBuyerInput =$data['emailOfBuyerInput'];
    $TotalMoneyBillInput =$data['TotalMoneyBillInput'];
    $NoteInput =$data['NoteInput'];
    $dateBooking=$data['dateBooking'];

    if(isset($idCouponInput))
    {
        $idCouponInput=null;
    }

    $query="call insertBooking($idCouponInput , $idUserInput  , $idStatusBookingInput , $nameOfBuyerInput ,
    $addressOfBuyerInput , $phoneNumberOfBuyerInput , $emailOfBuyerInput , $TotalMoneyBillInput , $NoteInput,$dateBooking)";

    $result=mysqli_query($connect,$query);

    if($result){
        $row=mysqli_fetch_assoc($result);
        $idBooking=$row['ID'];
        echo json_encode(Array(
            "idBooking"=>$idBooking
        ),JSON_UNESCAPED_UNICODE);
    }
    else{
        echo 504;
    }
}

function  updateBooking(){
    include'library/cors.php';
    include'library/connect.php';
    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    $idBooking =$data['idBooking'];

    $idStatusBooking =$data['idStatusBooking'];
    $DateComplete =$data['DateComplete'];
    $nameOfBuyer =$data['nameOfBuyer'];
    $addressOfBuyer =$data['addressOfBuyer'];
    $phoneNumberOfBuyer =$data['phoneNumberOfBuyer'];
    $emailOfBuyer =$data['emailOfBuyer'];

    $query="update Booking set";

    $count=0;
    
    if(isset($idStatusBooking)){       
        $count=1;
        $query=$query."idStatusBooking='$idStatusBooking'";
    }

    if(isset($DateComplete)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query."DateComplete='$DateComplete'";
    }

    if(isset($nameOfBuyer)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query."nameOfBuyer='$nameOfBuyer'";
    }

    if(isset($addressOfBuyer)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query."addressOfBuyer='$addressOfBuyer'";
    }

    if(isset($DateComplete)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query."phoneNumberOfBuyer='$phoneNumberOfBuyer'";
    }

    if(isset($DateComplete)){
        if($count==1){
            $query=$query.",";
        }else{
            $count=1;
        }
        $query=$query."emailOfBuyer='$emailOfBuyer'";
    }

    $query.="where ID= $idBooking ;";

    $result=mysqli_query($connect,$query);

    if($result){
        echo 200;
    }
    else{
        echo 504;
    }

}

function  hideBooking(){
    
}



?>