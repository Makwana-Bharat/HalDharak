<?php
    session_start();
    include("Connection.php");
    $SID=$_SESSION['SID'];
    $name=$_POST['Name'];
    $village=$_POST['Village'];
    $mobile=$_POST['Mobile'];
    echo mysqli_query($con,"INSERT INTO `khedut_master`(`SID`,`ID`, `NAME`, `PIC`, `VILLAGE`,`MOBILE`) VALUES ($SID,null,'$name','','$village','$mobile')");

?>