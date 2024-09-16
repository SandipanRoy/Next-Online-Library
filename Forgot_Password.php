<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/Sign_In.css" />
<link rel="icon" title="Next Book Store" href="images/logo.png" />
</head>

<title>Forgot Password</title>

<body bgcolor="#37383b" style="background-size:cover; height:100%">

<div class="card">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<span style="padding-left:16%">Email</span><input type="text" placeholder="Enter Your Registered Email" name="Regs_Email" required /><br>
<span style="padding-left:26%"><input type="submit" value="Submit" /></span>
</form>
</div>


<?php

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{

	/*Input From HTML Form*/
$Email=$_POST['Regs_Email'];

require("php/Connection.php");

		/*Creating Command String*/
$Command="SELECT Password FROM user_details where Email='$Email'";

		/*Execute SQL command*/
$Result=mysqli_query($Connection,$Command);

		/*Check if the Email found in the database or not*/
	if(mysqli_num_rows($Result)>0)
	{

	$Row=mysqli_fetch_assoc($Result);

		/*Send the password in the email*/
		$To=$Email;
		$Subject="Password Reset For Next Book Store";
		$Message="Your Account Password is ".$Row["Password"];
		$Header="From:sandipanroy177@gmail.com";

	$Status=mail($To,$Subject,$Message,$Header);
		if($Status==true)
		{
		echo "<div style='margin-top:20px'><span style='padding-left: 30%;color: green'>Your Password for this Account Is Successfully Sent To Your Registered Email Address</span></div>";
		}
		else
		{
		echo "<div style='margin-top:20px'><span style='padding-left:45%;color: red'>Faild To Send Password</span></div>";
		die("");
		}

	}
	else
	{
	echo "<div style='margin-top:20px'><span style='padding-left:42%;color: red'>This Email Is Not Registered</span></div>";
	die("");
	}

	/*Close the existing Connection*/
mysqli_close($Connection);
	}

?>
</body>
</html>

