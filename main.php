<?php
    //elegxos ama o xristis exei kanei login
    //ama exei kanei vriskoume ta stoixeia tou apo tin vasi
	if(isset($_SESSION['log']))
	{
		$aa=$_SESSION['log'];
		require'connectionDB.php';
		$result=mysql_query("SELECT * FROM users WHERE AA='$aa'");
		$row=mysql_fetch_array($result);
		unset($_SESSION['log']);
	}
    //ama den exei kanei ton stelnoume stin selida tis eisodou
	else
	{
		echo "You are not Logged In!";
		include ("LogIn.html");
		exit;
	}

	
?>

<html>
<head>
<title>SkyBox</title>
<link rel='stylesheet' type='text/css' href='main.css' /> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1253">
<meta content="charset=utf-8"/>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>

<!--scriptaki to opoio xrwmatizei tin grammi tou pinaka pou epilegei o xristis 
kai pernei ton arithmo tis grammis gia melontiki euresi tou stoixeiou pou epelekse-->
<script>
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
  
  document.getElementById('row').value=el.rowIndex;
  
  //elegxos ama auto pou epelekse o xristis einai fakelos ama den einai apenergopoiisi tou koumpiou share
  if(el.rowIndex > document.getElementById('folderNum').value)
	document.getElementById('share').disabled=true;
  else
	document.getElementById('share').disabled=false;
	
}

function ChangeTextColor(a_obj,a_color){  ;
   for (i=0;i<a_obj.cells.length;i++)
    a_obj.cells(i).style.color=a_color;
}

</script>

<script> 
      /* scriptaki to opoio kaleite otan patame to koumpi dimiourgia fakelou to opoio emfanizei ena promt parathuro gia na eisagi o xristis
        to onoma tou fakelou pou thelei na dimiourgisei kai kalei tin selida php pou periexei tin ektelesi autis tis leitourgias pernontas 
        mesw tou url dedomen */
    function Create() {
		var user = "<?php echo $aa ?>";
		var name = prompt("Enter the folder name", "");
		var action = "create";
		if (name != null)
			window.location.href = "functions.php?w1=" + user + "&w2=" + name + "&w3=" + action;					
	}
     /* scriptaki to opoio kaleite otan patame to koumpi reaname to opoio emfanizei ena promt parathuro gia na eisagi o xristis
        to neo onoma tou fakelou i arxeiou pou epelekse */
	function Rename() {
		if(document.getElementById('row').value>0)
		{
			var user = "<?php echo $aa ?>";
			var filenum=document.getElementById('row').value;
			var action = "rename";
			var name = prompt("Rename the folder/file", "");
			if (name != null) 
				window.location.href = "functions.php?w1=" + user + "&w2=" + name + "&w3=" + action + "&w4=" + filenum;				
		}
	}
       /* scriptaki to opoio kaleite otan patame to koumpi delete to opoio kalei tin leitourgia gia tin diagrafi tou arxeiou i fakelou pou epileksame */
	function Delete() {
		if(document.getElementById('row').value>0)
		{
			var user = "<?php echo $aa ?>";
			var filenum=document.getElementById('row').value;
			var action = "delete";
			window.location.href = "functions.php?w1=" + user + "&w2=" + filenum + "&w3=" + action;	
		}
	}
       /* scriptaki to opoio kaleite otan patame to koumpi upload to opoio kalei tin leitourgia gia anevasma arxeiou */
	function Upload() {
		var user = "<?php echo $aa ?>";
		var folder = "0";
		window.location.href = "upload.php?w1=" + user + "&w2=" + folder;					
	}
      /* scriptaki to opoio kaleite otan patame to koumpi share to opoio kalei tin leitourgia gia diamerismo fakelou */
	function Share(){
		if(document.getElementById('row').value>0){
			var user = "<?php echo $aa ?>";
			var filenum=document.getElementById('row').value;
			var email = prompt("Give the Users Email", "");
			var action = "share";
			if (email != null) 
				window.location.href = "functions.php?w1=" + user + "&w2=" + email+ "&w3=" + action + "&w4=" + filenum;		
		}
	}
    /* scriptaki to opoio kaleite otan patame to koumpi pending to opoio kalei emfanizei ti selida i opoia periexei tis aitiseis gia sharing */
	function Requests(){	
		var user = "<?php echo $aa ?>";
		window.location.href = "requests.php?w1=" + user;	
	}
	function Exit() {
		window.location.href = "LogIn.html";					
	}
</script>


</head>
<body>

<!-- ena pinakas o opoios emfanizei ton xristi -->
<table class="tbl" border="0" align="right">
		<tr>
			<td><CENTER><p style="margin-bottom: 20px; margin-top: 0px;"><?php echo 'Welcome   '.$row['Name'].' '.$row['LastName']; ?></p></CENTER></td>
		</tr>
		<tr>
			<td><CENTER><input class="button" type="submit" value="Exit" name="submission" onClick="Exit()"></CENTER></td>
		</tr>
<table/>

<!-- emfanisi twn koumpiwn gia kafe leitourgia pou mporei na ektelesi o xristis -->
<div class="wrap"><pre>
<CENTER><input class="button" type="submit" value="Create Folder" name="submission" onClick="Create()">   <input class="button" type="submit" value="Share Folder" name="submission" onClick="Share()" id="share">    <input class="button" type="submit" value="Upload" name="submission" onClick="Upload()">    <input class="button" type="submit" value="Rename" name="submission" onClick="Rename()" id="rename">    <input class="button" type="submit" value="Delete" name="submission" onClick="Delete()" id="delete">    <input class="button" type="submit" value="Pendings" name="submission" onClick="Requests()"></CENTER>
<input type="submit" value="0" name="submission" id="row" style="color: transparent; background-color: transparent; border: 0px;">

<!-- emfanisi pinaka me olous tous fakelous kai arxeia pou exei o xristis stin vasi-->
<table class="tbl2" id="mytable" align="center">
		<tr bgcolor="#61b3de" height="50px">
			<th><p style="color: white; font-size:22">AA</p></th>
			<th><p style="color: white; font-size:22">Name</p></th>
			<th><p style="color: white; font-size:22">Type</p></th>
			<th><p style="color: white; font-size:22">Size</p></th>
		</tr>
		<?php
		
		
		
		$query = "SELECT AA, Name, User2 FROM folders where User='$aa' or User2='$aa'";
		$result = mysql_query($query) or die('Error, query failed');
		
		$num=1;
		while(list($AA, $Name, $User2) = mysql_fetch_array($result))
		{
            //elegxos ama to arxeio einai koinoxristo i oxi
			if($User2 == '0')
				$Num="Folder";
			else
				$Num="Shared Folder";
			echo "<tr onClick=\"HighLightTR(this,'lightgrey','cc3333');\" height=\"40px\">";
			echo "<td><CENTER>$num</CENTER></td>";
            //ama patisi panw sto fakelo o xristis metaferete se alli selida i opoia emfanizei ta periexomena tou fakelou
			echo "<td><CENTER><a href='folder.php?AA=".$AA."&w1=".$aa."'>".$Name."</a></CENTER></td>";
			echo "<td><CENTER>$Num</CENTER></td>";
			
			//euresi tou sunolikou megethous tou fakelou athrisontas ola ta megethi arxeiwn pou periexontai se auton
			$query2 = "SELECT AA, Size, Folder FROM files where Folder='$AA'";
			$result2 = mysql_query($query2) or die('Error, query failed');
			$total=0;
			while(list($f, $sz, $fol) = mysql_fetch_array($result2))
			{
				$total=$total+$sz;
			}
			$total=$total/1024;
			$total = floor(($total*100))/100;
			echo "<td><CENTER>$total KB</CENTER></td>";
			echo "</tr>";
			$num++;
		}
		$folderNum=$num-1;
		
		$query = "SELECT AA, Name,Type,Size FROM files Where User='$aa' And Folder=0";
		$result = mysql_query($query) or die('Error, query failed');
		while(list($AA, $Name, $Type, $Size) = mysql_fetch_array($result))
		{
			$Size=$Size/1024;
			$Size = floor(($Size*100))/100;
			echo "<tr onClick=\"HighLightTR(this,'lightgrey','cc3333');\" height=\"40px\">";
			echo "<td><CENTER>$num</CENTER></td>";
            //ama patisi o xristis panw sto arxeio to katevazei
			echo "<td><CENTER><a href='download.php?AA=".$AA."'>".$Name."</a></CENTER></td>";
			echo "<td><CENTER>$Type</CENTER></td>";
			echo "<td><CENTER>$Size KB</CENTER></td>";
			echo "</tr>";
			$num++;
		}
			
		?>	
<table/>
<input class="button" type="submit" value="<?php echo $folderNum; ?>" name="submission" id="folderNum" style="margin-top: -500px auto">		
</pre></div>


</body>
</html>

