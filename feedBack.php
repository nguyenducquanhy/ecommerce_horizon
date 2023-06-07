<?php
 class Feedback{
    public $idFeedback;
    public $rate;
    public $contentFeedBack;
    public $email;
    public $reactionFeedback;

    public $RepplyFeedBack;
    
    public function __construct($idFeedback,$rate,$contentFeedBack,$email,$reactionFeedback,$RepplyFeedBack){
        $this->idFeedback=$idFeedback;
        $this->rate=$rate;
        $this->contentFeedBack=$contentFeedBack;
        $this->email=$email;
        $this->reactionFeedback=$reactionFeedback;
        $this->RepplyFeedBack=$RepplyFeedBack;
    }

 }

 class RepplyFeedback{
    
    public $idRepplyFeedBack;
    public $RepplycontentFeedBack;
    public $ReactionRepplyFeedback;

    public function __construct(  $idRepplyFeedBack,$RepplycontentFeedBack,$ReactionRepplyFeedback){

        $this->idRepplyFeedBack=$idRepplyFeedBack;
        $this->RepplycontentFeedBack=$RepplycontentFeedBack;
        $this->ReactionRepplyFeedback=$ReactionRepplyFeedback;

    }
 }

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");


if($_SERVER['REQUEST_METHOD']==='GET'){
    getFeedback();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    insertFeedback();
}

function getFeedback(){
    include'library/cors.php';
    include'library/connect.php';

    $idProduct=$_GET["idProduct"];
 
    $query1="select FeedBack.ID idFeedback,FeedBack.rate,FeedBack.content contentFeedBack ,
                email,FeedBack.reactionLike reactionFeedback,
                RFB.ID idRepplyFeedBack,RFB.content RepplycontentFeedBack,
                RFB.reactionLike ReactionRepplyFeedback from FeedBack
                join ReplyFeedBack RFB on FeedBack.ID = RFB.IdFeedBack where idProduct=$idProduct;";

    $query2="select FeedBack.ID idFeedback,FeedBack.rate,FeedBack.content contentFeedBack 
                ,email,FeedBack.reactionLike reactionFeedback from FeedBack where idProduct=$idProduct";

    $result1=mysqli_query($connect,$query1);
    while(mysqli_next_result($connect)){;}

    $result2=mysqli_query($connect,$query2);
    while(mysqli_next_result($connect)){;}

    $array=array();

    if($result1){
        while($row=mysqli_fetch_array($result1)){        


            array_push($array,new Feedback($row["idFeedback"],$row["rate"]
                                                            ,$row["contentFeedBack"],$row["email"],
                                                            $row["reactionFeedback"],
                                                            new RepplyFeedback($row["idRepplyFeedBack"]
                                                            ,$row["RepplycontentFeedBack"],
                                                            $row["ReactionRepplyFeedback"])));
        }

    }
    if($result2){
        while($row=mysqli_fetch_array($result2)){        
            array_push($array,new Feedback($row["idFeedback"],$row["rate"],
                                        $row["contentFeedBack"],$row["email"],
                                        $row["reactionFeedback"],null));
        }

    }

    $sizeArr=sizeof($array);

    if($sizeArr<=0){
        echo json_encode("empty",JSON_UNESCAPED_UNICODE );
    }else{
        echo json_encode($array,JSON_UNESCAPED_UNICODE );
    }  
}


function insertFeedback(){
    include'library/cors.php';
    include'library/connect.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json,true);

    $idProduct =$data['idProduct'];
    $rate  =$data['rate'];
    $content =$data['content'];    
    $content =$data['content'];
    $gender =$data['gender'];
    $sdt =$data['sdt'];
    $email =$data['email'];

    $query="insert into  FeedBack( idProduct, rate, content, name, gender, sdt, email)
            value($idProduct, $rate, $content, $content, $gender, $sdt, $email)";

    $result=mysqli_query($connect,$query);

    $arrayBooking=array();

    if($result){             
        echo 200;
    }
    else{
        echo 504;
    } 
}

?>