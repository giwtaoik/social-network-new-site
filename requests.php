<?php
    //elegxos ama o xristis ekane eisodo
	require'connectionDB.php';
	if(isset($_GET['w1']))
	{
		$aa=$_GET['w1'];
	}
	else
	{
		echo "You are not Logged In!";
		include ("LogIn.html");
		exit;
	}
?>


<html>
<head>
<title>SkyBox Requests</title>
<link rel='stylesheet' type='text/css' href='main.css' /> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1253">
<meta content="charset=utf-8"/>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>


<script>  
    //ama dextei na moirastei to fakelo o xristis tote ektelesi twn entolwn sto arxeio answer.php gia na ektelesti i entoli tou
	function Accept() {
			var user = "<?php echo $aa ?>";
			var action = "accept";
			var AA=document.getElementById('ac').name;
			window.location.href = "answer.php?w1=" + user + "&w2=" + AA + "&w3=" + action;				
	}
    //ama den dextei to etima o xristis tote kalounte oi entoles gia na diagrafi to etima apo to arxeio answer.php
	function Decline() {
			var user = "<?php echo $aa ?>";
			var action = "decline";
			var AA=document.getElementById('de').name;
			window.location.href = "answer.php?w1=" + user + "&w2=" + AA + "&w3=" + action;	
	}
	
</script>


</head>
<body>

<div class="wrap"><pre>
<CENTER><p style="font-size:28px; font-weight:bold; margin-top: 20px;">Requests to Share Folders</p></CENTER>
<!--koumpi to opoio otan patithei epistrefei ton xristi stin arxisi selida me ta dedomena tou -->
<form action="back.php" method="post"><input name="<?php echo $aa ?>" type="submit" class="back2" value="<- Back" id= "back"></form> 
<!-- pinaka opou emfanizontai oles oi etisiseis gia diamoirasmo fakelon pou exei o xristis stin vasi -->
<table class="tbl3" id="mytable" align="center">
		<tr bgcolor="#61b3de" height="50px">
			<th><p style="color: white; font-size:22">AA</p></th>
			<th><p style="color: white; font-size:22">Folder</p></th>
			<th><p style="color: white; font-size:22">From</p></th>
			<th><p style="color: white; font-size:22">Answer</p></th>
		</tr>
		<?php
		
		
		$query = "SELECT AA, User1, User2, Folder FROM req Where User1='$aa'";
		$result = mysql_query($query) or die('Error, query failed');
		
		$num=1;
		
		while(list($AA, $User1, $User2, $Folder) = mysql_fetch_array($result))
		{
			echo "<tr onClick=\"HighLightTR(this,'lightgrey','cc3333');\" height=\"40px\">";
			echo "<td><CENTER>$num</CENTER></td>";
				$query2 = "SELECT AA, Name FROM folders Where AA='$Folder'";
				$result2 = mysql_query($query2) or die('Error, query failed');
				$row2 = mysql_fetch_array( $result2 );
				$fname=$row2['Name'];
			echo "<td><CENTER>$fname</CENTER></td>";
				$query3 = "SELECT AA, Email FROM users Where AA='$User2'";
				$result3 = mysql_query($query3) or die('Error, query failed');
				$row3 = mysql_fetch_array( $result3 );
				$from=$row3['Email'];
			echo "<td><CENTER>$from</CENTER></td>";
            //emfanisi 2 koumpiwn gia apodoxi kai aporipsi aitimatos gia diamerismo tou kathe fakelou ksexwrista
			echo "<td><CENTER><input class='button' type='submit' value='Accept' name='$Folder' onClick='Accept()' id='ac'> <input class='button' type='submit' value='Decline' name='$Folder' onClick='Decline()' id='de'></CENTER></td>";
			echo "</tr>";
			$num++;
		}
			
		?>	
</table>	
</pre></div>


</body>
</html>
