<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/Delete_Confirmation.css" />
<link rel="icon" title="Next Book Store" href="Images/logo.png" />
</head>
<title>Delete Confirmation</title>

<body bgcolor="#37383b" style="background-size: cover;background-attachment: fixed">

<div class="card">
<font face="Arial Rounded MT Bold" color="red">
<span style="padding-left: 18%">Do You Really Want To Delete This <br></span>
<span style="padding-left: 18%">Record From Server Permanently?</span>
</font>

<?php

	
	if(!isset($_SESSION['Email']))
	{
	header("Location: http://localhost/Next_Book_Store/index.php");
	}

	require("Connection.php");
	$ID=$_GET['ID'];
	
	$Command="SELECT * FROM upload_record where ID='$ID'";
	$Result=mysqli_query($Connection,$Command);
		
		if(!$Result)
		{
		die("Error In Connection");
		}

	if(mysqli_num_rows($Result)>0)
	{
	$Display=mysqli_fetch_assoc($Result);
	echo "<br><img src='Image_Uploads/".$Display['Image_Name']."'width=150 height=100 align=right style='margin-right: 3%;margin-top:2%'/><br>";
	echo "<span style='padding-left: 5%'><b>Name :</b></span>".$Display['Book_Name']."<br>";
	echo "<span style='padding-left: 5%'><b>Author :</b></span>".$Display['Author']."<br>";
	echo "<span style='padding-left: 5%'><b>Subject :</b></span>".$Display['Subject']."<br>";
	echo "<span style='padding-left: 5%'><b>Price :</b></span>".$Display['Price']."<br>";
	echo "<span style='padding-left: 5%'><b>Referrence No :</b></span>".$Display['ID']."<br>";
	echo "<a href='http://localhost/Next_Book_Store/php/Remove_Record.php?ID=".$Display['ID']."'>";
	echo "<span style='padding-left:27%'><button style='background-color: red;border-style: none;cursor: pointer;width: 80px;border-radius: 4px;margin-top: 2%'>Yes</button></span>";
	echo "</a>";
	echo "<a href='http://localhost/Next_Book_Store/index_Sign_In.php'>";
	echo "<span style='padding-left:10%'><button style='background-color: #07cc21;border-style: none;cursor: pointer;width: 80px;border-radius: 4px;margin-top:2%'>No</button></span>";
	echo "</a>";
	}
	else
	{
	header("Location: http://localhost/Next_Book_Store/index_Sign_In.php");
	}

?>
</div>

</body>
</html>