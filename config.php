<?php
	/*
		Warning: Do not edit this file unless you understand what it is
	*/

	/*
	--------------------------------------------------------
		This section is for SQL configuration
	*/
	$_SQLINFO['server'] = 'localhost';
	$_SQLINFO['port'] = 3306;
	$_SQLINFO['username'] = 'root';
	$_SQLINFO['password'] = '';
	$_SQLINFO['database'] = 'k_auth_demo';

	/*
		End of SQL configuration
	--------------------------------------------------------
	*/


	/*
	--------------------------------------------------------
		This section is for app configuration
	*/
	$_APP['admin_secret'] = '123123';
	$_APP['debug'] = true;
	/*
		End of app configuration
	--------------------------------------------------------
	*/

	/*
	--------------------------------------------------------
		Init an SQL connection and secure it
	*/

	// connect to database
	$conn = mysqli_connect($_SQLINFO['server'], $_SQLINFO['username'], $_SQLINFO['password'], $_SQLINFO['database'], $_SQLINFO['port']) or die('Cannot connect to database');	

	// To avoid SQLi it should define
	mysqli_query($conn, "SET NAMES 'utf8mb4'");
	mysqli_query($conn, "SET CHARACTER SET utf8mb4");
	mysqli_query($conn, "SET SESSION collation_connection = 'utf32_general_ci'");
	
	/* 
		End of SQL init
	--------------------------------------------------------
	*/


	/*
	--------------------------------------------------------
		Running some code
	*/
	if($debug) {
		error_reporting(16);
	}
	else {
		error_reporting(0);
	}

	/*
		End of running code
	--------------------------------------------------------
	*/

	/*
		Developed by Kien in the United States of America from the Vietnam remote site

					_______________________________________________
					|* * * * * * * * * *|=========================|
					| * * * * * * * * * |                         |
					|* * * * * * * * * *|=========================|
					| * * * * * * * * * |                         |
					|* * * * * * * * * *|=========================|
					| * * * * * * * * * |                         |
					|* * * * * * * * * *|=========================|
					|                                             |
					|=============================================|
					|                                             |
					|=============================================|
					|                                             |
					|=============================================|
					|
					|
					|
					|
					|
					|
					|								WELCOME TO SEATTLE, WASHINGTON
					|
					|
					|
					|
		-------------------------------------------------------------------------------


	*/
?> 