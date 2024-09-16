<!DOCTYPE html>
<html>
<title>Change Password</title>
<head>
<link rel="stylesheet" type="text/css" href="css/Change_Password.css" />
<link rel="icon" href="Images/logo.png" />
</head>

<body bgcolor="#37383b">


<div class="card">
<span style="padding-left: 1%;color: #5eebe4"><font face="Arial Rounded MT Bold" size="8">Change Password</font></span>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
<span style="padding-left: 4%"><b>Current Password</b></span><input type="password" name="Current_Password" placeholder="Enter Your Current Password" /><br>
<span style="padding-left: 10%"><b>New Password</b></span><input type="password" name="New_Password" placeholder="Enter Your New Password" /><br>
<span style="padding-left: 4%"><b>Confirm Password</b></span><input type="password" name="Confirm_Password" placeholder="Confirm Your Password" /><br>
<span style="padding-left: 28%"><input type="submit" value="Confirm" /></span>
</form>
</div>

<?php

	if(!isset($_SESSION['Email']))
	{
	header("Location: http://localhost/Next_Book_Store/index.php");
	}

	require("php/Connection.php");

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		function validate_input($Input)
		{
		$Input=trim($Input);
		$Input=stripslashes($Input);
		$Input=htmlspecialchars($Input);
		return $Input;
		}

	$Current_Password=validate_input($_POST['Current_Password']);
	$New_Password=validate_input($_POST['New_Password']);
	$Confirm_Password=validate_input($_POST['Confirm_Password']);


	
		if(strlen($Current_Password)==0||strlen($New_Password)==0||strlen($Confirm_Password)==0)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Every Field Must Be Filled</b></span>";
		echo "</div>";
		die("");
		}

		if(strlen($New_Password)>=15||strlen($Confirm_Password)>=15)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Password Too Long</b></span>";
		echo "</div>";
		die("");
		}

		if(!preg_match("/^[a-zA-Z-0-9 ]*$/",$New_Password))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:42%;color:#f71414'><b>Invalid Password Format</b></span>";
		echo "</div>";
		die("");
		}

		if(!preg_match("/^[a-zA-Z-0-9 ]*$/",$Confirm_Password))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:42%;color:#f71414'><b>Invalid Password Format</b></span>";
		echo "</div>";
		die("");
		}

		
		if(!preg_match("/^[a-zA-Z-0-9 ]*$/",$Current_Password))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:42%;color:#f71414'><b>Invalid Password Format</b></span>";
		echo "</div>";
		die("");
		}


		if(strcmp($New_Password,$Confirm_Password)!=0)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:40%;color:#f71414'><b>Password And Confirm Should Be Same</b></span>";
		echo "</div>";
		}

	$Email=$_SESSION['Email'];

	$cmd="SELECT Password FROM user_details WHERE Email='$Email'";

	$res=mysqli_query($Connection,$cmd);
	if(!$res)
	{
	echo "<div style='margin-top:5%'>";
	echo "<span style='padding-left:30%;color:#f71414'><b>Error In Connection</b></span>";
	echo "</div>";
	die("");
	}

	$check=mysqli_fetch_assoc($res);

	if(strcmp($check['Password'],$Current_Password)!=0)
	{
	echo "<div style='margin-top:5%'>";
	echo "<span style='padding-left:40%;color:#f71414'><b>Current Password Doesn't Matched</b></span>";
	echo "</div>";
	die("");
	
	}

	$Command="UPDATE user_details SET Password='$New_Password' WHERE Email='$Email'";

	$Result=mysqli_query($Connection,$Command);
	
	if(!$Result)
	{
	echo "<div style='margin-top:5%'>";
	echo "<span style='padding-left:30%;color:#f71414'><b>Error In Connection</b></span>";
	echo "</div>";
	die("");
	}
	
	echo "<div style='margin-top:5%'>";
	echo "<span style='padding-left:40%;color: green'><b>Password Successfully Changed</b></span>";
	echo "</div>";

	mysqli_close($Connection);
	

	}//end for request_method post

?>

</body>
</html>
