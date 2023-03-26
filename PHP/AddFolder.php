<?php
    session_start();
    include("Connection.php");
    $name=$_POST['name'];
    $ID=$_SESSION['ID'];
     mysqli_query($con,"INSERT INTO `main_folder`(`ID`, `Year`) VALUES ('$ID','$name')");
    $row=mysqli_fetch_assoc(mysqli_query($con,"SELECT MFID from main_folder WHERE ID=$ID ORDER BY MFID DESC"));
    echo $row['MFID'];

?>