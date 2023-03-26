<?php 
    session_start();
    if(isset($_SESSION['TOTPT']) && isset($_POST["UserOTP"]))
    {
        echo ($_SESSION['TOTPT']==$_POST["UserOTP"]) ? "Valid" : "Invalid";
    }
    else{
        echo "error";
    }
?>