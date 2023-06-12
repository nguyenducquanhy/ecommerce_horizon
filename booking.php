<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

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


class bookingDetail{
    public $ID;    

    public $amount;
    public $totalPriceOfProduct;
    public $nameProduct;
    public $urlImage;

    public function __construct( $ID, $amount,$totalPriceOfProduct,$nameProduct, $urlImage){
        $this->ID=$ID;        
        $this->amount=$amount;
        $this->totalPriceOfProduct=$totalPriceOfProduct;       
        $this->nameProduct=$nameProduct;
        $this->urlImage=$urlImage;
     }

}






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

    $idBooking=$_GET['idBooking'];

    if(isset($idBooking)){
        $queryBookingDetail="select BookingDetail.id, idproduct, amount, totalpriceofproduct,P.Name,P.image
        from BookingDetail
                 join Product P on P.Id = BookingDetail.idProduct
        where BookingDetail.idBooking = $idBooking";
    
        $queryBooking="select Booking.ID,sB.nameStatus,nameOfBuyer,Booking.dateBooking,TotalMoneyBill
        from Booking join statusBooking sB on sB.ID = Booking.idStatusBooking where Booking.ID= $idBooking ";

        // echo $queryBookingDetail;
        // echo $queryBooking;
        // return;

        $resulBookingDetail=mysqli_query($connect,$queryBookingDetail)or die(mysqli_error($connect));
        while(mysqli_next_result($connect)){;}

        $resultBooking=mysqli_query($connect,$queryBooking)or die(mysqli_error($connect));
        while(mysqli_next_result($connect)){;}

        //&&$resultBooking

        if($resulBookingDetail&&$resultBooking){      

            $arrayBookingDetail=array();
            while($row=$resulBookingDetail->fetch_assoc()){        
                $newBookingDetail=new bookingDetail($row['id'],$row['amount'],$row['totalpriceofproduct'], $row['Name'], $row['image']);
                array_push($arrayBookingDetail,$newBookingDetail);
            }

            $row=$resultBooking->fetch_assoc();  
            $newBooking=new booking($row['ID'], $row['nameStatus'],$row['nameOfBuyer'],$row['dateBooking'],$row['TotalMoneyBill']);

            // echo json_encode(
            //     Array("BookingDetail"=>$arrayBookingDetail),JSON_UNESCAPED_UNICODE );

            echo json_encode(
            Array("BookingDetail"=>$arrayBookingDetail,
            "Booking"=>$newBooking),JSON_UNESCAPED_UNICODE );
        }
        else{
            echo 504;
        } 

        return;
    }


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

    $arrayBookingDetail=$data['arrayBookingDetail'];

    if(isset($idCouponInput))
    {
        $idCouponInput=null;
    }

    $query="call insertBooking('$idCouponInput' , '$idUserInput'  , '$idStatusBookingInput' , '$nameOfBuyerInput' ,
    '$addressOfBuyerInput' , '$phoneNumberOfBuyerInput' , '$emailOfBuyerInput' , '$TotalMoneyBillInput' , '$NoteInput','$dateBooking')";
    
    //echo $query;
    
    
    $result=mysqli_query($connect,$query);
    while(mysqli_next_result($connect)){;}

    if($result){
        $row=mysqli_fetch_assoc($result);
        $idBooking=$row['ID'];

        
        if(isset($arrayBookingDetail)){
            
            $queryInsertBookingDeatail="insert into BookingDetail(idBooking, idProduct, amount, totalPriceOfProduct) VALUE ";
            for($i=0; $i < sizeof($arrayBookingDetail); $i++){

            $item=$arrayBookingDetail[$i];
            $idProduct=$item['idProduct'];
             $amount=$item['amount'];
              $totalPriceOfProduct=$item['totalPriceOfProduct'];
            $queryInsertBookingDeatail.="( $idBooking,$idProduct,$amount,$totalPriceOfProduct )";
            $queryInsertBookingDeatail.=",";
            }
       
            $queryInsertBookingDeatail=substr_replace($queryInsertBookingDeatail ,"",-1);
            //echo $queryInsertBookingDeatail;
            
            $resultInsertBookingDeatail=mysqli_query($connect,$queryInsertBookingDeatail);
            while(mysqli_next_result($connect)){;}
            if($resultInsertBookingDeatail){
                echo 200;
            }
            else{
                echo 504;
            }
         
        }
        
        
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