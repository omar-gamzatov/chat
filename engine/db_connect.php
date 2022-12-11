<?php

$host = 'localhost';
$sqli_login = 'root';
$sqli_pass = '';
$db_name = 'mini';	

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


	$connect = mysqli_connect($host, $sqli_login, $sqli_pass, $db_name);
	

	if(!$connect) {
		die('Error connect to database');
	}