<!DOCTYPE html>
<html>
<head>
<link rel="icon" title="Next Book Store" href="images/logo.png" />
<link rel="stylesheet" type="text/css" href="css/Admin_Login.css" />
</head>

<title>Admin Login</title>
<body bgcolor="#37383b" style="background-size: cover;height: 100%">

<?php
if(isset($_SESSION['Email']))
{
header("Location: http://localhost/Next_Book_Store/index_Sign_In.php");
}

if(isset($_SESSION['Admin_Email']))
{
header("Location: http://localhost/Next_Book_Store/Admin_Login_Successfull.php");
}

?>


<div class="card_admin_login">
<span style="padding-left:13%;color: #79f2da"><font face="Arial Rounded MT Bold" size="15">Admin Login</font></span>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
<span style="padding-left:12%"><b>Email</b></span><input type="text" name="Email" placeholder="Enter your Email Address" required /><br></span>
<span style="padding-left:6%"><b>Password</b></span><input type="password" name="Password" placeholder="Enter your Password" required /><br><br></span>
<input type="submit" value="Submit" name="Submit" />
</form>
</div>

<?php

	if($_SERVER["REQUEST_METHOD"]=="POST")	//Execute script when called from HTML Form
	{

		function validate_input($Input)
		{
		$Input=trim($Input);
		$Input=stripslashes($Input);
		$Input=htmlspecialchars($Input);
		return $Input;
		}

		/*Store Inputs From HTML form*/
	$User_Email=validate_input($_POST['Email']);
	$User_Password=validate_input($_POST['Password']);


		/*Initialize server Details*/
	require("php/Connection.php");
	
			/*Prepare query for matching username and password*/
	$Command="SELECT ID,Name,Email from admin_details where Email='$User_Email' and Password='$User_Password'";


			/*Run SQL Query on table*/
	$Result=mysqli_query($Connection,$Command);


			/*Check if record found in the database or not*/
		if(mysqli_num_rows($Result)>0)
		{
		$Row=mysqli_fetch_assoc($Result);

			/*Start Session for the user*/
		$_SESSION['User_ID']=$Row["ID"];
		$_SESSION['User_Name']=$Row["Name"];
		$_SESSION['Admin_Email']=$Row["Email"];
	
		header("Location: http://localhost/Next_Book_Store/Admin_Login_Successfull.php");
		}

		else
		{
		echo "<div style='margin-top:20px'><span style='padding-left:42%;color: red'>Invalid Username And Password</span></div>";
		}

	
		/*Close the connection*/
	mysqli_close($Connection);
	}

?>

</body>
</html>