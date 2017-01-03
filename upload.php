
<?php
//eisagwgi se metavlites ton aa tou xristi kai ton fakelo pou theloume na anevasoume to arxeio
$usr=$_GET['w1'];
$fold=$_GET['w2'];
?>

<html>
<head>
<title>SkyBox Upload</title>
<link rel='stylesheet' type='text/css' href='upload.css' />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>
</head>
<body>

<pre>

<!-- emfanisi formas me dunatotita epilogis arxeiou apo ton upologisti-->
<form action="back.php" method="post"><input name="<?php echo $usr ?>" type="submit" class="back" value="<- Back" id= "back"></form> 
<Center> <p style="font-size:40px; font-weight:bold;">Ανεβάστε ένα αρχείο!</p></Center>  <form method="post" enctype="multipart/form-data">
		<table width="350" border="0" cellpadding="1" cellspacing="1" class="wrap">
		<tr>
		<td width="246">
        <!-- elegxos ama to megethos tou arxeiou pernaei to orio -->
		<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		<input name="userfile" type="file" id="userfile">
		</td>
		<td width="80"><input name="upload" type="submit" class="button" id="upload" value=" Upload "></td>
		</tr>
		</table>
</form></pre>

</body>
</html>

<!--scriptaki to opoio ekteleite otan o xristis pataei to koumpi back kai ton epistrefei stin proigoumeni selida -->
<script> 
	function submitForm(){
			document.getElementById('back').click();
	}
</script>

<?php

require'connectionDB.php';

//elegxos ama o xristis epelekse kapoio arxeio prin patisei to upload
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
    //eisagwgi se metavlites ta stoixeia tou arxeiou
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

//anoigma tou arxeiou gia apothikeusi tou periexomenou tou 
$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

//elegxos gia to onoma tou arxeiou ama periexoun magic quotes
if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}
//eisagwgi tou arxeiou stin vasi
$query = "INSERT INTO files (Name, Size, Type, Content, User, Folder ) ".
"VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$usr', '$fold')";

mysql_query($query) or die('Error, query failed');

echo "<br>File $fileName uploaded<br>";

//elegxos se poio fakelo anevasame to arxeio ama stin arxiki selida epistrofi se autin ama se sugkekrimenw fakelo epistrofi sta periexomena autou tou fakelou
if($fold==0)
	echo '<script type="text/javascript"> submitForm(); </script>';
else
	echo '<script type="text/javascript"> window.location.href = "folder.php?AA=" + '.$fold.' + "&w1=" + '.$usr .';	</script>';
	
	

}
?>