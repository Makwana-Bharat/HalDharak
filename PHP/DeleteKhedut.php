<?php
    include("Connection.php");
    $id=$_POST['ID'];
    echo mysqli_query($con,"DELETE FROM `khedut_master` WHERE ID=".$id);

?>