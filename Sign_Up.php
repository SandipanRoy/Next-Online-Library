<!DOCTYPE html>
<html>

<title>Sign Up</title>

<link rel="icon" href="images/logo.png" title="Next Book Store" />
<link rel="stylesheet" type="text/css" href="css/Sign_Up.css" />

<body bgcolor="#37383b" style="background-size: cover;height: 100%" alink="green" vlink="blue">



<div class="card">
<span style="padding-left:26%;color:black"><font face="Arial Rounded MT Bold" size="15"><b>Sign Up</b></font></span>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<b>
<span style="padding-left:23%">Name</span><input type="text" placeholder="Enter your full name" name="Name" required /><br>
<span style="padding-left:23%">Email</span><input type="Email" placeholder="Enter your email address" name="Email" required /><br>
<span style="padding-left:17%">Password</span><input type="password" placeholder="Enter Password" name="Password" required /><br>
<span style="padding-left:2%">Confirm Password</span><input type="password" placeholder="Confirm Password" name="Confirm_Password" required /><br>
<div style="margin-top:1%">
<a href="Terms And Conditions/Terms And Conditions.pdf"  target="_blank">Terms & Conditions</a>
</div>
<input type="submit" value="submit" name="Submit" />
</form>
</b>
</div>


<?php

		/*Store Input From HTML Form*/
	if($_SERVER["REQUEST_METHOD"]=="POST")		//Execute script when called from HTML page
	{

		function validate_input($Input)
		{
		$Input=trim($Input);
		$Input=stripslashes($Input);
		$Input=htmlspecialchars($Input);
	
		return $Input;
		}

	$User_Name=validate_input($_POST['Name']);
	$User_Email=validate_input($_POST['Email']);
	$User_Password=validate_input($_POST['Password']);
	$User_Confirm_Password=validate_input($_POST['Confirm_Password']);


				/*Validate all input fields*/

		if(strlen($User_Name)==0 ||strlen($User_Email)==0||strlen($User_Password)==0||strlen($User_Confirm_Password)==0)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Every Field Must Be Filled</b></span>";
		echo "</div>";
		die("");
		}

		if(strlen($User_Password)>=15||strlen($User_Confirm_Password)>=15)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Password Too Long</b></span>";
		echo "</div>";
		die("");
		}

		if(strlen($User_Email)>=50)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Email Too Long</b></span>";
		echo "</div>";
		die("");
		}

		if(strlen($User_Name)>=50)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Name Too Long</b></span>";
		echo "</div>";
		die("");
		}


		if(!preg_match("/^[a-zA-Z ]*$/",$User_Name))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Invalid Name Format</b></span>";
		echo "</div>";
		die("");
		}

		if(!filter_var($User_Email,FILTER_VALIDATE_EMAIL))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Invalid Email Format</b></span>";
		echo "</div>";
		die("");
		}


		if(!preg_match("/^[a-zA-Z-0-9 ]*$/",$User_Password))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:42%;color:#f71414'><b>Invalid Password Format</b></span>";
		echo "</div>";
		die("");
		}

		if(!preg_match("/^[a-zA-Z-0-9 ]*$/",$User_Confirm_Password))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:42%;color:#f71414'><b>Invalid Password Format</b></span>";
		echo "</div>";
		die("");
		}


		/*Initialize SQL server details*/
	require("php/Connection.php");

			/*Check Password and Confirm Password Field*/
		if(strcmp($User_Password,$User_Confirm_Password)!=0)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:40%;color:#f71414'><b>Password And Confirm Should Be Same</b></span>";
		echo "</div>";
		}

		else
		{
				/*Check If Record Already Exist*/
		$Command_Temp="SELECT Name FROM User_Details WHERE Email='$User_Email'";

		$Result_Temp=mysqli_query($Connection,$Command_Temp);
		
			if(mysqli_num_rows($Result_Temp)>0)
			{
			echo "<div style='margin-top:5%'>";
			echo "<span style='padding-left:38%;color:#f71414'><b>Record with Same Email Address Already Exist</b></span>";
			echo "</div>";
			}

			else
			{
					/*Delete all expired Records*/
			$Cmd="Delete from tmp_user where Expiary_Time<now() or Email='$User_Email'";

			$Res_tmp=mysqli_query($Connection,$Cmd);
				if(!$Res_tmp)
				{
				die("Error in Connection");
				}

			/*Insert Data into SQL Table*/
			$Pass_Key=rand(1111,9999);

			$Command_String="INSERT INTO tmp_user(Name,Email,Password,Pass_Key,Expiary_Time) VALUES('$User_Name','$User_Email','$User_Password','$Pass_Key',(now()+INTERVAL 5 MINUTE))";

			$Insert_Status=mysqli_query($Connection,$Command_String);

				if(!$Insert_Status)//check for Insertion Status
				{
				die("Error in Connection");
				}

		

				/*Mail the OTP to user*/
			$To=$User_Email;
			$Subject="OTP for Next Book Store";
			$Message="Your OTP for Next Book Store Sign Up is:<b>".$Pass_Key."</b>";
			$Message.=".<br>This OTP is valid for next 5 minutes"; 
			$Header="FROM:sandipanroy177@gmail.com";
			$Header.="MIME-Version: 1.0\r\n";
			$Header.="Content-Type: text/html; charset=ISO-8859-1\r\n";

			$Result=mail($To,$Subject,$Message,$Header);
				if(!$Result)
				{
				echo "<div style='margin-top:5%'>";
				echo "<span style='padding-left:35%;color:#f71414'><b>Unable To Send Email Address</b></span>";
				echo "</div>";
				die("");
				}
			$_SESSION['Sign_Up_Email']=$User_Email;
			header("Location: http://localhost/Next_Book_Store/OTP_Confirm.php");

			}//end of email check
	}//end of password check
	
		/*Close the connection*/
	mysqli_close($Connection);

}//end of POST method

?>


</body>

</html>

