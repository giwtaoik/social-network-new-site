<?php
	require'connectionDB.php';
	
	$query="CREATE TABLE users(
	AA int(200) NOT NULL AUTO_INCREMENT,
	Name varchar(50) NOT NULL,
	LastName varchar(50) NOT NULL,
	Email varchar(50) NOT NULL,
	password varchar(50) NOT NULL,
	PRIMARY KEY (AA)
	)";
	mysql_query($query);
	
	$query="CREATE TABLE folders(
	AA int(250) NOT NULL AUTO_INCREMENT,
	Name varchar(250) NOT NULL,
	Num int(250) NOT NULL,
	User int(250) NOT NULL,
	User2 int(250) NOT NULL,
	PRIMARY KEY (AA)
	)";
	mysql_query($query);
	
	$query="CREATE TABLE files(
	AA int(255) NOT NULL AUTO_INCREMENT,
	Name varchar(30) NOT NULL,
	Type varchar(30) NOT NULL,
	Size int(255) NOT NULL,
	Content mediumblob NOT NULL,
	User int(250) NOT NULL,
	Folder int(255) NOT NULL,
	PRIMARY KEY (AA)
	)";
	mysql_query($query);
	
	$query="CREATE TABLE req(
	AA int(255) NOT NULL AUTO_INCREMENT,
	User1 int(255) NOT NULL,
	User2 int(255) NOT NULL,
	Folder int(255) NOT NULL,
	PRIMARY KEY (AA)
	)";
	mysql_query($query);
	
	$query="CREATE TABLE share(
	AA int(255) NOT NULL AUTO_INCREMENT,
	user int(255) NOT NULL,
	folder int(255) NOT NULL,
	PRIMARY KEY (AA)
	)";
	mysql_query($query);

	mysql_close($con);

?>