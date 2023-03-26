<?php
    
    include_once("Connection.php");
    $ID=$_POST['ID'];
    $Name=$_POST['NAME'];
    $Village=$_POST['VILLAGE'];
    $Mobile=$_POST['MOBILE'];
    $Photo=$_POST['PHOTO'];
    echo mysqli_query($con,"UPDATE `khedut_master` SET `NAME`='$Name',`VILLAGE`='$Village',`MOBILE`='$Mobile' WHERE ID=$ID");
?>