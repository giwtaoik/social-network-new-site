<?php



require'connectionDB.php';

//pairnoume ton aa tou xristi ton fakelo pou dialekse kai tin entoli pou epelekse na ektelesi mesa apo to url

$user=$_GET['w1'];

$action = $_GET['w3'];

$fold = $_GET['w2'];



//se periptwsi pou epileksei na ginei o diamoirasmos

if($action =="accept"){



        //diagrafei tin aitisi apo ton pinaka

		$del="DELETE FROM req WHERE User1='$user' AND Folder='$fold'";

		mysql_query($del);

		

        //allazei tin timi tou user2 vazontas pleon tin timi tou aa tou xristi

		$upd = "UPDATE folders Set User2='$user' WHERE AA='$fold'";

		mysql_query($upd);	

}

//se periptwsi pou den apodexti ton diamoirismo tou fakelou

elseif($action =="decline"){

	

    //diagrafei to aitima apo tn vasi

	$del="DELETE FROM req WHERE User1='$user' AND Folder='$fold'";

	mysql_query($del) or die('Error, query failed');

		

}



//epistrefei stin arxiki selida metaferontas ton aa tou xristi

session_start();

$_SESSION['log']=$user;



include ("main.php");



?>
