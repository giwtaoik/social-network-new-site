<?php
$con=mysql_connect("sql212.gr.tn","grtn_19218641","ellada123");

if(!$con){
	die('Could not Connect to mysql:'.mysql_error());
}

mysql_set_charset("utf8",$con);
mysql_selectdb("grtn_19218641_skybox",$con);

?>