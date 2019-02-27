<?php
	$dsn  = 'mysql:host=localhost; dbname=twitter';
	$user = 'root';
	$pass = '';

	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	);

	try{
		$pdo = new PDO($dsn, $user, $pass);
	}catch(PDOException $e){
		echo "Connection Failed! " . $e->getMessage();
	}
?>