<?php
	$server="localhost";
	$username="root";
	$password="jmsalcedo";
	$conn=new mysqli($server, $username, $password);
	$database="nation_building";
	$result=$conn->query("SHOW DATABASES");
	$db_exist=false;
	while($row=$result->fetch_assoc())
	{
		if($row['Database']===$database)
		{
			$db_exist=true;
			break;
		}
	}
	if(!$db_exist)
	{
		$conn->query("CREATE DATABASE ".$database);
		$conn=new mysqli($server, $username, $password, $database);
	}
	else
	{

		$conn=new mysqli($server, $username, $password, $database);
	}
	$result=$conn->query("SHOW TABLES FROM ". $database);
	$users=$barangays=$issues=$barangay_issue=false;
	while($row=$result->fetch_assoc())
	{
		if($row['Tables_in_nation_building']==="users") $users=true;
		if($row['Tables_in_nation_building']==="barangays") $barangays=true;
		if($row['Tables_in_nation_building']==="issues") $issues=true;
		if($row['Tables_in_nation_building']==="barangay_issue") $barangay_issue=true;
	}
	if(!$users)
	{
		$password=md5("admin");
		$query="CREATE table users(
		id INT(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		username VARCHAR(30) NOT NULL,
		password VARCHAR(30) NOT NULL,
		type VARCHAR(30) NOT NULL)";
		$conn->query($query);
		$sql="INSERT INTO users(username, password, type) VALUES('admin', '$password', 'admin')";
		$conn->query($sql);
		$conn->error;
	}
	if(!$barangays)
	{
		$query="CREATE table barangays(
		id INT(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		barangay_name VARCHAR(30) NOT NULL)";
		$conn->query($query);
	}
	if(!$issues)
	{
		$query="CREATE table issues(
		id INT(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		issue_name VARCHAR(30) NOT NULL)";
		$conn->query($query);
	}
	if(!$barangay_issue)
	{
		$query="CREATE table barangay_issue(
		id INT(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		issue INT(3) NOT NULL,
		barangay INT(3) NOT NULL,
		status VARCHAR(30) NOT NULL)";
		$conn->query($query);
	}
?>