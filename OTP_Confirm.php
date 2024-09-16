<!DOCTYPE html>
<html>
<title>Confirm OTP</title>

<head>
<link rel="icon" title="Next Book Store" href="Images/logo.png" />
<link rel="stylesheet" type="text/css" href="css/Sign_Up.css" />
</head>

<body bgcolor="#37383b" style="background-size: cover;background-attachment: fixed">

<span style="padding-left: 39%;color:#69edb8">An OTP is sent to your Given Email Address</span>
<span style="padding-left: 44%;color:#69edb8">Valid for Next 5 Minutes</span>
<div class="card">
<span style="padding-left: 25%"><b>Enter OTP To Continue</b></span>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
<span style="padding-left: 10%"><b>OTP</b></span><input type="password" name="OTP" placeholder="Enter Your OTP Here" />
<input type="submit" value="Confirm" />
</form>
</div>

<?php

if(!isset($_SESSION['Sign_Up_Email']))
{
header("Location: http://localhost/Next_Book_Store/Sign_Up.php");
}

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
	require("php/Connection.php");
	

		function validate_input($Input)
		{
		$Input=trim($Input);
		$Input=stripslashes($Input);
		$Input=htmlspecialchars($Input);
		return $Input;
		}


	$User_Email=validate_input($_SESSION['Sign_Up_Email']);
	$User_OTP=validate_input($_POST['OTP']);

			/*Delete all Expired Record*/
	$Cmd="DELETE FROM tmp_user WHERE Expiary_Time<now()";
	$Res=mysqli_query($Connection,$Cmd);

		if(!$Res)
		{
		die("Error In Connection");
		}

	$User_Email=$_SESSION['Sign_Up_Email'];

		/*Check OTP and Email Validity*/
	$Command="SELECT * FROM tmp_user where Email='$User_Email'";

	$Result=mysqli_query($Connection,$Command);

		if(mysqli_num_rows($Result)>0)
		{
		//Match OTP

		$Match=mysqli_fetch_assoc($Result);

			if($Match['Pass_Key']==$User_OTP)
			{
			$User_Name=$Match['Name'];
			$User_Email=$Match['Email'];
			$User_Password=$Match['Password'];

					/*Transfer the contents to original database*/
			$Command="INSERT INTO user_details (Email,Name,Password) VALUES ('$User_Email','$User_Name','$User_Password')";
		
			$Result=mysqli_query($Connection,$Command);
				if(!$Result)
				{
				die("Error In Connection");
				}
			unset($_SESSION['Sign_Up_Email']);
			$_SESSION['Email']=$User_Email;

					/*Delete Temporary Record*/
			$Cmd="DELETE FROM tmp_user WHERE Expiary_Time<now() or Email='$User_Email'";
			$Res_tmp=mysqli_query($Connection,$Cmd);
		
				if(!$Res_tmp)
				{
				die("Error In Connection");
				}
			header("Location: http://localhost/Next_Book_Store/index_Sign_In.php");

			}
			else
			{
			echo "<div style='margin-top: 5%'>";
			echo "<span style='padding-left: 44%;color: red'><b>OTP Does Not Matched</b></span>";
			echo "</div>";
			}

		}
		else
		{
		echo "<div style='margin-top: 5%'>";
		echo "<span style='padding-left: 46%;color: red'><b>Session Expired</b></span>";
		echo "</div>";
		}

	
	mysqli_close($Connection);

	}


?>

</body>
</html>