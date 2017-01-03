<?php

require'connectionDB.php';
//pernoume ton aa tou xristi ton fakelo pou dialekse kai to tin entoli pou epelekse na ektelesi mesa apo to url
$user=$_GET['w1'];
$action = $_GET['w3'];
$fold = $_GET['w2'];

//se periptwsi pou epileksei na ginei o diamerismos
if($action =="accept"){
    //eisagwgi ston pinaka diamerismwn ton xristi kai ton fakelo
		$query = "INSERT INTO share (user, folder ) VALUES ('$user', '$fold')";
		mysql_query($query) or die('Error, query failed');
		
        //diagrafi tin aitisi apo ton pinaka
		$del="DELETE FROM req WHERE User1='$user' AND Folder='$fold'";
		mysql_query($del);
		
        //allazi tin timi tou user2 vazontas pleon tin timi tou aa tou xristi
		$upd = "UPDATE folders Set User2='$user' WHERE AA='$fold'";
		mysql_query($upd);	
}
//se periptwsi pou den apodexti ton diamerismo tou fakelou
elseif($action =="decline"){
	
    //diagrafi to aitima apo tn vasi
	$del="DELETE FROM req WHERE User1='$user' AND Folder='$fold'";
	mysql_query($del) or die('Error, query failed');
		
}

//epistresi stin arxiki selida metaferontas ton aa tou xristi
session_start();
$_SESSION['log']=$user;

include ("main.php");

?>