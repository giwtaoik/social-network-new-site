<?php

require'connectionDB.php';
//apothikeusi se metavlites tous parametrous pou perasame mesa apo to url
$user=$_GET['w1'];
$action = $_GET['w3'];

//ekteleite otan o xristis epelekse tin leitourgia tis metanomasias
if($action =="rename"){

		$flag = $_GET['w4'];
		$rename =$_GET['w2'];
		$a = $_GET['w5'];
		//euresi tou arxeiou pou epelekse o xristis na metanomasei me vasi tin grammi pou dialekse apo ton pinaka
		$query = "SELECT AA,Name FROM files Where User='$user' and Folder ='$a'";
		$result= mysql_query($query);
		$k=1;
		while ( $row = mysql_fetch_array( $result ) )
		{
			if ( $k == $flag )
			{
				$a= $row['AA'];
				$nm= $row['Name'];
			}
			$k++;
		}
        //apothikeusi tis kataliksis tou arxeiou gia epanenwsi me to neo onoma
		$pin=explode(".",$nm);
		if(isset($pin[1]))
			$rename=$rename.".".$pin[1];
        //apothikeusi tou neou onomatos stin vasi
		$update="UPDATE files SET Name = '$rename' where AA='$a'";
		mysql_query($update);
}
//ekteleite otan o xristis epelekse tin leitourgia tis diagrafis
elseif($action =="delete"){
	$flag = $_GET['w2'];
	$a = $_GET['w4'];
	
    //euresi tou arxeiou pou epelekse me vasi tin grammi pou dialekse ston pinaka
	$query = "SELECT AA FROM files Where User='$user' and Folder ='$a'";
	$result = mysql_query($query);
	$k=1;
	while ( $row = mysql_fetch_array( $result ) )
	{
		if ( $k == $flag )
			$a= $row['AA'];
			
		$k++;
	}
	//diagrafi apo tin vasi tou arxeiou
	$del="DELETE FROM files WHERE AA='$a'";
	mysql_query($del);
}
	
session_start();
$_SESSION['log']=$user;

include ("main.php");
//echo '<script type="text/javascript"> window.location.href = "folder.php?AA=" + '.$a.' + "&w1=" + '.$user .';</script>';
	
?>