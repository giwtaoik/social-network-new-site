
<?php

require'connectionDB.php';


//php code to download the clicked file from the table
if(isset($_GET['AA']))
{
// if id is set then get the file with the id from database
$AA    = $_GET['AA'];
$query = "SELECT Name, Type, Size, Content " .
         "FROM files WHERE AA = '$AA'";
         
//apothikeusi twn stoixeiwn tou arxeiou se metavlites         
 $result = mysql_query($query);
$row = mysql_fetch_array($result);
$size = $row['Size'];
$type = $row['Type'];
$name =$row['Name'];
$fileContent = $row['Content'];

//emfanisei parathurou ston xristi me ta stoixeia tou arxeiou kai to periexomeno tou gia katevasma
header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$name");
echo $fileContent;

exit;
}

?>