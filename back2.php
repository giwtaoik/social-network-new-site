<?php


session_start();
$_SESSION['log']=$_GET['w1'];

if(isset($_GET['w2']))
    $_SESSION['err']=$_GET['w2'];



include("main.php");
exit;

?>