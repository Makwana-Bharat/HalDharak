<?php
    session_start();
    include_once("Connection.php");
    $Pass=password_hash($_POST['Pass'], PASSWORD_DEFAULT);
    $Email=$_SESSION['EMAIL'];
    $Query="UPDATE `shethmaster` SET `PASSWORD`='$Pass' WHERE EMAIL='$Email'";
    if(mysqli_query($con,$Query)==1)
        echo "Password Changed...";
    else
        echo "Something Wen`t Wrong...!! ";
?>