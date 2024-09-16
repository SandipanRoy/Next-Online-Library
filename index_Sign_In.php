<!DOCTYPE html>
<html>
<title>Next Book Store</title>

<head>
<link title="Next Book Store" rel="icon" href="images/logo.png" width="20%" />
<link rel="stylesheet" type="text/css" href="css/User_Upload_Record.css" />
<link rel="stylesheet" type="text/css" href="css/navigation_panel.css" />
</head>

<body bgcolor="#37383b" style="background-size: cover;background-repeat :no-repeat;background-attachment: fixed">
<?php
	if(!isset($_SESSION['Email']))
	{
	header("Location: http://localhost/Next_Book_Store/index.php");
	}

if(isset($_SESSION['Book_Name']))
	{
	unset($_SESSION['Book_Name']);
	}
?>

<ul class="navigation_bar">
<li style="float: left;"><img src="images/logo.png" width="42%" title="Next Book Store" /></li>

<form method="GET" action="<?php echo htmlspecialchars('php/Search_Record.php') ?>">
<li style="float: right"><input type="submit" name="submit" value="Search" /></li>
<li style="float: right"><input type="text" placeholder="Enter Book Name" name="Book_Name" required /></li>
</form>

<li style="float: right;"><a href="<?php echo htmlspecialchars("Upload_Book.php") ?>">Upload Book</a></li>
<li style="float: right;"><a href="<?php echo htmlspecialchars("Change_Password.php") ?>">Change Password</a></li>
<li style="float: right;"><a href="<?php echo htmlspecialchars("php/Sign_Out.php") ?>">Sign Out</a></li>
<li style="float: right;"><a href="mailto:sandipanroy177@gmail.com?subject=Feedback&body=">Feedback</a></li>


</ul>

<div style="margin-top: 7%">
<span style="padding-left:46%; color:#3cc81c">Your Upload Records</span>
</div>

<?php
$Email=$_SESSION['Email'];

require("php/Connection.php");

$Command="SELECT * FROM upload_record where Email='$Email'";

$Command_tmp="SELECT (Name) FROM user_details where Email='$Email'";


$Result_tmp=mysqli_query($Connection,$Command_tmp);
$Display_tmp=mysqli_fetch_assoc($Result_tmp);
echo "<span style='padding-left: 87%;color: #89fbf3;position :fixed'>Hello, ".$Display_tmp['Name']."</span>";



$Result=mysqli_query($Connection,$Command);

	if(mysqli_num_rows($Result)>0)
	{	
		
		
		while($Display=mysqli_fetch_assoc($Result))
		{
		echo "<div class=card_cpy>";
		echo "<span style='padding-left:4%'><b>Name: </b></span>".$Display['Book_Name'];
		echo "<img src='php/Image_Uploads/".$Display['Image_Name']."'height='130' width='150' align='right' style='margin-top:3%;margin-right:3%'/><br>";
		echo "<span style='padding-left:4%'><b>Author: </b></span>".$Display['Author']."<br>";
		echo "<span style='padding-left:4%'><b>Subject: </b></span>".$Display['Subject']."<br>";
		echo "<span style='padding-left:4%'><b>Price: </b></span>".$Display['Price']."<br>";
		echo "<span style='padding-left:4%'><b>Description: </b></span>".$Display['Description']."<br>";
		echo "<span style='padding-left:4%'><b>Referrence No: </b></span>".$Display['ID']."<br>";
		echo "<span style='padding-left:4%'><b>Downloads: </b></span>".$Display['downloads']."<br>";
		echo "<span style='padding-left:4%'><b>Views: </b></span>".$Display['views']."<br>";


		echo "<a href='php/Delete_Confirmation.php?ID=".$Display['ID']."'>";
		echo "<span style='padding-left:25%'><button style='background-color: red;cursor: pointer;border: none;border-radius: 4px'>Delete</button></span>";
		echo "</a>";

		echo "<a href='php/PDF_Uploads/".$Display['PDF_Name']."' download>";
		echo "<span style='padding-left:5%'><button style='background-color: #07cc21;cursor: pointer;border: none;border-radius: 4px'>Download</button></span>";                              
		echo "</a>";


		echo "<a href='php/PDF_Uploads/".$Display['PDF_Name']."' target='blank'>";
		echo "<span style='padding-left:5%'><button style='background-color: #28a693;cursor: pointer;border: none;border-radius: 4px'>View</button></span>";
		echo "</a>";
		
		echo "</div>";

		}
	
	}
	else
	{
	echo "<br><br><span style='padding-left:47%;color:Red'>No Record Found</span>";
	}

mysqli_close($Connection);
	
?>

</body>
</html>