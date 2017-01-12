<?php
header("Expires: Sat, 01 Jan 3099 00:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: post-check=0, pre-check=0",false);
session_cache_limiter("must-revalidate");

session_start();
$access=false;

require'connectionDB.php';
	
$email=$_POST["email"];
$pass=$_POST["password"];
	
    //elegxos stin vasi ama uparxi o xristis me ta dedomena pou eisigage
	$result=mysql_query("SELECT * FROM users WHERE Email='$email' AND password='$pass'");
	$row=mysql_fetch_array($result);
	
	if($row)
		$access=true;
    
    //ama uparxi apothikeusi tou AA tou apo ton pinaka users kai metafora tou stin kentriki selida
	if($access==true)
	{
		$_SESSION['log']=$row['AA'];
		include ("main.php");
	}
    //ama den uparxi emfanisi minimatos sfalmatos
	else
	{
		echo file_get_contents("LogIn.html");
		echo "<p style='margin-top: -130px;'><CENTER><font color='red'> Λάθος Email ή Κωδικός! </font></CENTER></p>";
	}



?>