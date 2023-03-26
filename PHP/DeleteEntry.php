<?php
    include("Connection.php");
    $IID=$_POST['IID'];
    echo mysqli_query($con,"DELETE FROM `invoice` WHERE IID=".$IID);
?>