<?php
    
    include_once("Connection.php");
    $IID=$_POST['IID'];
    $Rupee=$_POST['RUPEE'];
    $Detail=$_POST['DETAIL'];
    $Date=$_POST['DATE'];
    $Type=$_POST['TYPE'];
    if(strpos($Date,'-')!=2)
    {
        $Date=substr($Date,-2).substr($Date,-6,-3)."-".substr($Date,0,4);
    }
    echo mysqli_query($con,"UPDATE `invoice` SET `RUPEE`='".$Rupee."',`DATE`='".$Date."',`DETAILS`='".$Detail."',`TYPE`='".$Type."' WHERE IID=".$IID);
?>