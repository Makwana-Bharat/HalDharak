<?php
    include("Connection.php");
    $MFID=$_POST['MFID'];
    echo mysqli_query($con,"DELETE FROM `main_folder` WHERE MFID=".$MFID);

?>