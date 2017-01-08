<?php



require'connectionDB.php';

//pairnoume vasika stoixeia apo to url tis efarmogis ta opoia metaferame apo tin selida main

$user=$_GET['w1'];

$action = $_GET['w3'];

$err=0;



//ekteleitai otan o xristis patise create kai dimiourgei enan fakelo stin vasi

if($action =="create"){

	

	$name=$_GET['w2'];

	$query = "INSERT INTO folders (Name, User, User2 ) VALUES ('$name', '$user', '0')";

	mysql_query($query) or die('Error, query failed');

}

//ekteleitai otan o xristis patise share 

elseif($action =="share"){

	$email= $_GET['w2'];

	$flag= $_GET['w4'];

	

    //euresi tou fakelou pou epelekse o xristis

	$query = "SELECT AA, User2 FROM folders where User='$user' or User2='$user'";

	$result = mysql_query($query) or die('Error, query failed');

	$k=1;

	while ( $row = mysql_fetch_array( $result ) )

	{

		if ( $k == $flag )

        {

			$a= $row['AA'];	

            $user2=$row['User2'];

        }

		$k++;

	}



    //efoson o fakelos den einai idi koinoxristos dimiourgia stin vasi mia eggrafi aithmatos gia share afou prwta vroume ton neo xristi me ton opoio thelei na kanei share o user

    if($user2=='0')

    {

        $query = "SELECT AA FROM users WHERE Email='$email'";

        $result = mysql_query($query) or die('Error, query failed');	

        $num_rows = mysql_num_rows($result);

        

        if($num_rows>0)

        {

            $row = mysql_fetch_array( $result );

            $to=$row['AA'];

            

            $query2 = "INSERT INTO req (User1, User2, Folder ) VALUES ('$to', '$user', '$a')";

	        mysql_query($query2) or die('Error, query failed');

            $err=3;

        }

        else

            $err=2;

    }

    else

        $err=1;

    



}

//ekteleitai otan o xristis patisei rename

elseif($action =="rename"){



		$flag = $_GET['w4'];

		$rename =$_GET['w2'];

		

		$query = "SELECT AA FROM folders where User='$user' or User2='$user'";

		$result = mysql_query($query) or die('Error, query failed');

		$rn=mysql_num_rows($result);

		//echo "flag ".$flag;

		//echo "row num ".$rn;

		

        //ama auto pou epelekse na metanomasei o xristis einai fakelos tote metanomasia fakelou

		if ($rn > $flag-1)

		{

			$flag=$flag-1;

			$k=0;

			while ( $row = mysql_fetch_array( $result ) )

			{

				if ( $k == $flag )

					$a= $row['AA'];

					

				$k++;

			}

			//echo $a;

			$update="UPDATE folders SET Name = '$rename' where AA='$a'";

		}

        //alliws auto pou epelekse o xtistis einai arxeio tote metanomasia tou arxeiou stin vasi

		else{

			$flag=$flag-$rn;

			//echo $flag;

			$query2 = "SELECT AA,Name FROM files Where User='$user' and Folder='0'";

			$result2 = mysql_query($query2);

			$k=1;

			while ( $row2 = mysql_fetch_array( $result2 ) )

			{

				if ( $k == $flag )

				{

					$a= $row2['AA'];

					$nm= $row2['Name'];

				}

				$k++;

			}

			$pin=explode(".",$nm);

			if(isset($pin[1]))

				$rename=$rename.".".$pin[1];

				//echo $a;

			$update="UPDATE files SET Name = '$rename' where AA='$a'"; 

		}

		mysql_query($update);

}

//ekteleitai otan o xristis patisei delete arxeiou i fakelou

elseif($action =="delete"){

	$flag = $_GET['w2'];

	

	$query = "SELECT AA FROM folders where User='$user' or User2='$user'";

	$result = mysql_query($query) or die('Error, query failed');

	$rn=mysql_num_rows($result);

	//echo $rn;

	

	//euresi ama auto pou patise o xristis einai fakelos i arxeio	

	if ($rn > $flag-1)

	{

		$flag=$flag-1;

		$k=0;

		while ( $row = mysql_fetch_array( $result ) )

		{

			if ( $k == $flag )

				$a= $row['AA'];

				

			$k++;

		}

		//ama einai fakelos diagrafi fakelou apo tin vasi

		$del="DELETE FROM folders WHERE AA='$a'";

	}

	else

	{

		$flag=$flag-$rn;

		$query2 = "SELECT AA FROM files Where User='$user' and Folder='0'";

		$result2 = mysql_query($query2);

		$k=1;

		while ( $row2 = mysql_fetch_array( $result2 ) )

		{

			if ( $k == $flag )

				$a= $row2['AA'];

				

			$k++;

		}

		//ama einai arxeio diagrafi apo tin vasi ston pinaka files

		$del="DELETE FROM files WHERE AA='$a'";

	}

	mysql_query($del);

}





//epistrofi stin main selida tis efarmogis    

if($err==0)

    header('Location: back2.php?w1='.$user);

else

     header('Location: back2.php?w1='.$user.'&w2='.$err);



exit;

	

?>
