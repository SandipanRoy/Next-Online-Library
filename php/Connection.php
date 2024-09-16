<?php
	/*Initialize SQL server details*/
$Db_Host="127.0.0.1:3306";
$Db_User="root";
$Db_Password="";

		/*Establish connection with SQL database*/
$Connection=mysqli_connect($Db_Host,$Db_User,$Db_Password);


	if(!$Connection)//check for connection status
	{
	die("Error In Connection");
	}


		/*Selecting SQL database*/
	mysqli_select_db($Connection,'Next_Book_Store');

?>