<?php
include'library/cors.php';
include'library/connect.php';

if($_SERVER['REQUEST_METHOD']==='POST'){

    $IdCPUInput =$_POST['IdCPUInput'];
    $IdRAMInput =$_POST['IdRAMInput'];
    $IdDISKInput =$_POST['IdDISKInput'];
    $IdVGAInput=$_POST['IdVGAInput'];
    $IdSCREENInput =$_POST['IdSCREENInput'];
    $IdCOLORInput =$_POST['IdCOLORInput'];
    $IdOSInput=$_POST['IdOSInput'];

    
    $query="call insertSpecification('$IdCPUInput','$IdRAMInput','$IdDISKInput','$IdVGAInput',
                    '$IdSCREENInput','$IdCOLORInput','$IdOSInput')";
                    
    $result=mysqli_query($connect,$query);
    
    if($result){        
        $row=mysqli_fetch_array($result);        
        
        echo Array(
            "idSpecification"=>$row['idSpecification']
        );
          
    }
    else{
        echo 504;
    }


}


?>