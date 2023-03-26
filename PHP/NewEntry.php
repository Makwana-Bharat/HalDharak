<?php
    session_start();
    include("Connection.php");
    $MID=$_SESSION['MID'];
    $date=$_POST['Dates'];
    $Rupee=$_POST['RUPEE'];
    $Detail=$_POST['DETAIL'];
    $Type=$_POST['TYPE'];
    if(mysqli_query($con,"INSERT INTO `invoice`(`IID`, `MFID`, `RUPEE`, `DATE`, `DETAILS`, `TYPE`) VALUES (null,'$MID','$Rupee','$date','$Detail','$Type')")==1){
        $row=mysqli_fetch_assoc(mysqli_query($con,"SELECT IID FROM `invoice` ORDER BY IID DESC"));
        echo $_SESSION['ID']."/".$MID."#".$row['IID'];
    }
    else
        echo 0;

?>