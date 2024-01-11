<?php   
session_start();

session_destroy();
echo $currentDate = date('Y-m-d g:i:s');
header("location:login.php");


?>