<!DOCTYPE html>
<html>

<title>Exclusive Add</title>
<head>
<link rel="stylesheet" type="text/css" href="css/navigation_panel.css" />
<link rel="stylesheet" type="text/css" href="css/Admin_Login.css" />
<link rel="icon" title="Next Book Store" href="images/logo.png" />
</head>

<body bgcolor="#37383b">

<ul class="navigation_bar">
<li style="float: left;"><img src="images/logo.png" width="42%" title="Next Book Store" /></li>
<li style="float: right;"><a href="php/Admin_Sign_Out.php">Sign Out</a></li>
</ul>

<div class="card_admin_login">
<span style="padding-left:10%; color: #5eebe4"><font face="Arial Rounded MT Bold" size="5">Exclusive Advertisement</font></span>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
<span style="padding-left: 5%"><b>Exclusive 1</b></span><input type="number" placeholder="Enter Reference Number" name="Exclusive_1" /><br>
<span style="padding-left: 5%"><b>Exclusive 2</b></span><input type="number" placeholder="Enter Reference Number" name="Exclusive_2" /><br>
<span style="padding-left: 5%"><b>Exclusive 3</b></span><input type="number" placeholder="Enter Reference Number" name="Exclusive_3" /><br>
<span style="padding-left:25%"><input type="submit" value="Submit" /></span>
</form>
</div>

<?php

	if(!isset($_SESSION['Admin_Email']))
	{
	header("Location: http://localhost/Next_Book_Store/index.php");
	}

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{

		function validate_input($Input)
		{
		$Input=trim($Input);
		$Input=stripslashes($Input);
		$Input=htmlspecialchars($Input);
		return $Input;
		}
	
	$Exclusive_1=validate_input($_POST['Exclusive_1']);
	$Exclusive_2=validate_input($_POST['Exclusive_2']);
	$Exclusive_3=validate_input($_POST['Exclusive_3']);

		if(!preg_match("/^[0-9 ]*$/",$Exclusive_1)||!preg_match("/^[0-9 ]*$/",$Exclusive_2)||!preg_match("/^[0-9 ]*$/",$Exclusive_3))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Invalid Format</b></span>";
		echo "</div>";
		die("");
		}


		/*Check If All the records exist or not*/
	$flag=1;
	require("php/Connection.php");

		/*Check for Advertisement 1*/
	$cmd_1="SELECT Book_Name FROM upload_record where (ID='$Exclusive_1')";

	$Res1=mysqli_query($Connection,$cmd_1);
		if(!$Res1)
		{
		echo "<div style='margin-top:20px'><span style='padding-left:46%;color: red'>Error In Connection</span></div>";
		die("");
		}

		if(mysqli_num_rows($Res1)==0)
		{
		$flag=0;
		echo "<div style='margin-top:20px'><span style='padding-left:40%;color: red'>Record not Found For Exclusive Add 1<br></span></div>";
		}


		/*Check for Advertisement 2*/
	$cmd_2="SELECT Book_Name FROM upload_record where(ID='$Exclusive_2')";

	$Res2=mysqli_query($Connection,$cmd_2);
		if(!$Res2)
		{
		echo "<div style='margin-top:20px'><span style='padding-left:46%;color: red'>Error In Connection</span></div>";
		die("");
		}

		if(mysqli_num_rows($Res2)==0)
		{
		$flag=0;
		echo "<div style='margin-top:20px'><span style='padding-left:40%;color: red'>Record not Found For Exclusive Add 2<br></span></div>";
		}



		/*Check for Advertisement 3*/
	$cmd_3="SELECT Book_Name FROM upload_record where(ID='$Exclusive_3')";

	$Res3=mysqli_query($Connection,$cmd_3);
		if(!$Res3)
		{
		echo "<div style='margin-top:20px'><span style='padding-left:46%;color: red'>Error In Connection</span></div>";
		die("");
		}

		if(mysqli_num_rows($Res3)==0)
		{
		$flag=0;
		echo "<div style='margin-top:20px'><span style='padding-left:40%;color: red'>Record not Found For Exclusive Add 3<br></span></div>";
		}



	if($flag==1)
	{
			/*Delete all previous records*/
	$Command_delete="DELETE FROM exclusive_add";
	$Result=mysqli_query($Connection,$Command_delete);
		if(!$Result)
		{
		echo "<div style='margin-top:20px'><span style='padding-left:46%;color: red'>Error In Connection</span></div>";
		die("");
		}
			/*Insert New Records*/
	$Command_insert_1="INSERT INTO exclusive_add VALUES ('$Exclusive_1')";
	$Command_insert_2="INSERT INTO exclusive_add VALUES ('$Exclusive_2')";
	$Command_insert_3="INSERT INTO exclusive_add VALUES ('$Exclusive_3')";

	$res=mysqli_query($Connection,$Command_insert_1);

		if(!$res)
		{
		echo "<div style='margin-top:20px'><span style='padding-left:46%;color: red'>Error In Connection</span></div>";
		die("");
		}

	$res=mysqli_query($Connection,$Command_insert_2);

		if(!$res)
		{
		echo "<div style='margin-top:20px'><span style='padding-left:46%;color: red'>Error In Connection</span></div>";
		die("");
		}

	$res=mysqli_query($Connection,$Command_insert_3);

		if(!$res)
		{
		echo "<div style='margin-top:20px'><span style='padding-left:46%;color: red'>Error In Connection</span></div>";
		die("");
		}


	echo "<div style='margin-top:20px'><span style='padding-left:45%;color: green'>Successfully Updated</span></div>";
	}

	/*Close the Connection*/
	
	mysqli_close($Connection);

	}
?>

</body>
</html>
