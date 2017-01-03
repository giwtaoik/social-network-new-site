<?php
    //elegxos ama o xristis exei kanei eisodo
	if(isset($_GET['w1']))
	{
        //erwtima stin vasi gia na paroume ta dedomena tou xristi
		$aa=$_GET['w1'];
		require'connectionDB.php';
		$result=mysql_query("SELECT * FROM users WHERE AA='$aa'");
		$row=mysql_fetch_array($result);
		$fold= $_GET['AA'];
		
        //erwtima stin vasi gia na paroume ta dedomena tou fakelou
		$result2=mysql_query("SELECT Name FROM folders WHERE AA='$fold'");
		$row2=mysql_fetch_array($result2);
		$foldName=$row2['Name'];
	}
	else
	{
        //ama o xristis den ekane eisodo ton metaferoume stin selida tis eisodou
		echo "You are not Logged In!";
		include ("LogIn.html");
		exit;
	}
?>

<html>
<head>
<title>SkyBox <?php echo $foldName; ?></title>
<link rel='stylesheet' type='text/css' href='main.css' /> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1253">
<meta content="charset=utf-8"/>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>

<script>
//skriptaki to opoio xrwmatizei tin grammi tou pinaka pou epelekse o xristis
var preEl ;
var orgBColor;
var orgTColor;
function HighLightTR(el, backColor,textColor){
  if(typeof(preEl)!='undefined') {
     preEl.bgColor=orgBColor;
     try{ChangeTextColor(preEl,orgTColor);}catch(e){;}
  }
  orgBColor = el.bgColor;
  orgTColor = el.style.color;
  el.bgColor=backColor;

  try{ChangeTextColor(el,textColor);}catch(e){;}
  preEl = el;
  //apothikeuoume ton arithmo tis grammis pou epelekse o xristis se metavliti
  document.getElementById('row').value=el.rowIndex;
}

function ChangeTextColor(a_obj,a_color){  ;
   for (i=0;i<a_obj.cells.length;i++)
    a_obj.cells(i).style.color=a_color;
}
</script>

<script>  
    //scriptaki to opoio ekteleite otan patame to koumpi rename
	function Rename() {
		if(document.getElementById('row').value>0)
		{
			var user = "<?php echo $aa ?>";
			var filenum=document.getElementById('row').value;
			var action = "rename";
			var AA="<?php echo $fold ?>";
            //emfanizoume ena parathuro gia na eisagei to neo onoma o xristis
			var name = prompt("Rename the file", "");
            //anoigoume ton arxeio foderfunc to opoio periexei tin ektelesi tis leitourgias tis metanomasias afou prwta tou metaferoume dedomena mesw tou url
			if (name != "") 
				window.location.href = "folderFunc.php?w1=" + user + "&w2=" + name + "&w3=" + action + "&w4=" + filenum + "&w5=" + AA;				
		}
	}
    //scriptaki to opoio ekteleite otan patame to koumpi delete
	function Delete() {
		if(document.getElementById('row').value>0)
		{
			var user = "<?php echo $aa ?>";
			var filenum=document.getElementById('row').value;
			var action = "delete";
			var AA="<?php echo $fold ?>";
             //anoigoume ton arxeio foderfunc to opoio periexei tin ektelesi tis leitourgias tis diagrafis afou prwta tou metaferoume dedomena mesw tou url
			window.location.href = "folderFunc.php?w1=" + user + "&w2=" + filenum + "&w3=" + action + "&w4=" + AA;	
		}
	}
    //scriptaki to opoio ekteleite otan o xristis patisei upload arxeiou
	function Upload() {
		var user = "<?php echo $aa ?>";
		var folder = "<?php echo $fold ?>";
        //anoigoume to arxeio upload.php to opoio periexei ton kwdika tis leitourgias anevasmatos arxeiou stin vasi
		window.location.href = "upload.php?w1=" + user + "&w2=" + folder;					
	}
	function Exit() {
		window.location.href = "LogIn.html";					
	}
</script>

</head>
<body>
<!-- emfanisei pinaka me ta stoixeia tou xristi-->
<table class="tbl" border="0" align="right">
		<tr>
			<td><CENTER><p style="margin-bottom: 20px; margin-top: 0px;"><?php echo 'Welcome   '.$row['Name'].' '.$row['LastName']; ?></p></CENTER></td>
		</tr>
		<tr>
			<td><CENTER><input class="button" type="submit" value="Exit" name="submission" onClick="Exit()"></CENTER></td>
		</tr>
<table/>

<div class="wrap"><pre>
<CENTER>	<input class="button" type="submit" value="Upload" name="submission" onClick="Upload()">    <input class="button" type="submit" value="Rename" name="submission" onClick="Rename()" id="rename">    <input class="button" type="submit" value="Delete" name="submission" onClick="Delete()" id="delete"></CENTER>
<input type="submit" value="0" name="submission" id="row" style="color: transparent; background-color: transparent; border: 0px;">	
<CENTER><p style="font-size:28px; font-weight:bold; margin-top: -30px;"><?php echo $foldName; ?></p></CENTER>
<form action="back.php" method="post"><input name="<?php echo $aa ?>" type="submit" class="back" value="<- Back" id= "back"></form> 
<table class="tbl2" id="mytable" align="center">
		<tr bgcolor="#61b3de" height="50px">
			<th><p style="color: white; font-size:22">AA</p></th>
			<th><p style="color: white; font-size:22">Name</p></th>
			<th><p style="color: white; font-size:22">Type</p></th>
			<th><p style="color: white; font-size:22">Size</p></th>
		</tr>
		<?php
		$num=1;
		//erwtima gia epilogo olwn twn arxeio pou vriskontai mesa sto fakelo apo ton pinaka files tis vasis
		$query = "SELECT AA, Name,Type,Size FROM files Where Folder='$fold'";
		$result = mysql_query($query) or die('Error, query failed');
		while(list($AA, $Name, $Type, $Size) = mysql_fetch_array($result))
		{
			$Size=$Size/1024;
			$Size = floor(($Size*100))/100;
			//emfaniseis twn stoixeiwn twn arxeio ston pinaka
			echo "<tr onClick=\"HighLightTR(this,'lightgrey','cc3333');\" height=\"40px\">";
			echo "<td><CENTER>$num</CENTER></td>";
			echo "<td><CENTER><a href='download.php?AA=".$AA."'>".$Name."</a></CENTER></td>";
			echo "<td><CENTER>$Type</CENTER></td>";
			echo "<td><CENTER>$Size KB</CENTER></td>";
			echo "</tr>";
			$num++;
		}
			
		?>	
<table/>	
</pre></div>


</body>
</html>

