<?php

require'connectionDB.php';
	
$flag = false;

//ekxwrisi twn dedomenwn pou eisagage o xristis stin forma eggrafis se metavlites me tin methodo post
$name = $_POST["name"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$password = $_POST["password"];
$password2 = $_POST["password2"];

//elegxos ama o xristis eisigage ola ta pedia
if($name != "" && $lastname != "" && $email != "" && $password != "" && $password2 != "")
	$flag=true;
else
{
	echo file_get_contents("SignUp.html");
	echo "<p style='margin-top: -170px;'><CENTER><font color='red'> You must fill in all fields! </font></CENTER></p>";
}

//elegxos ama o kwdikos tairiazei me tin epanalupsi tou kwdikou
if($flag == true)
{
	if($password == $password2)
		$flag = true;
	else
	{
		$flag = false;
		echo file_get_contents("SignUp.html");
		echo "<p style='margin-top: -170px;'><CENTER><font color='red'> Passwords do not match! </font></CENTER></p>";
	}
}

//elegxos ama to email pou eisigage o xristis exei tin morfi tou email
if($flag == true)
{
    if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))  
        $flag=true;
    else
    {
        $flag=false;
        echo file_get_contents("SignUp.html");
    	echo "<p style='margin-top: -170px;'><CENTER><font color='red'> Incorect Email address! </font></CENTER></p>";
    }   
}
	
//elegxos ama to email pou eisagage o xristis uparxi idi stin vasi
if($flag == true)
{
    $result=mysql_query("SELECT * FROM users WHERE Email='$email'");
    $row=mysql_fetch_array($result);
	
	if($row)
		$access=true;
    
    if($access==true)
    {
        $flag = false;
        echo file_get_contents("SignUp.html");
		echo "<p style='margin-top: -170px;'><CENTER><font color='red'> The email you entered already exists! </font></CENTER></p>";
    }
 
}

//elegxos ama o kwdikos einai panw apo 6 xaraktires
if($flag == true)
{
    $length=strlen($password);
    if($length<6)
    {
        $flag = false;
        echo file_get_contents("SignUp.html");
    	echo "<p style='margin-top: -170px;'><CENTER><font color='red'> The password must be at least 6 characters long </font></CENTER></p>";
    }
}

//ama oi elegxoi perastikan me epituxia eggrafi tou xristi stin vasi kai metafora tou stin selida tou login na kanei eisodo
if($flag == true)
{
	mysql_query("INSERT INTO users (Name,LastName,Email,password)
			VALUES('$name','$lastname','$email','$password')");
			
	echo file_get_contents("LogIn.html");
	echo "<p style='margin-top: -405px;'><CENTER><font color='red'> Success! </font></CENTER></p>";
}
	
?>