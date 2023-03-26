<?php
// unset cookies
session_start();
unset($_SESSION['SID']);
setcookie("rem","off",time()+(365*24*60*60),"/");
echo 1;
?>