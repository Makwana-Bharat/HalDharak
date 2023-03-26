<?php
session_start();
    include("Connection.php");
    $query="SELECT * FROM `invoice` WHERE MFID=".$_POST['SFID'];
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        $rightSum="0";
        $leftSum="0";
        while($row=mysqli_fetch_assoc($result)){    
            if($row['TYPE']=='જમા ')
                $leftSum+=$row['RUPEE'];
            else
                $rightSum+=$row['RUPEE'];
        }
        echo $leftSum."/".$rightSum;
    }
?>