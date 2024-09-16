<!DOCTYPE html>
<html>
<title>Next Book Store</title>
<link title="Next Book Store" rel="icon" href="images/logo.png" width="20%" />

<link rel="stylesheet" type="text/css" href="css/navigation_panel.css" />
<link rel="stylesheet" type="text/css" href="css/Exclusive_Add.css" />
<body bgcolor="#37383b" style="background-size:cover;height: 100%">




<ul class="navigation_bar">
<li style="float: left;"><img src="images/logo.png" width="42%" title="Next Book Store" /></li>

<form method="GET" action="<?php echo htmlspecialchars('php/Search_Record.php') ?>">
<li style="float: right"><input type="submit" name="submit" value="Search" /></li>
<li style="float: right"><input type="text" placeholder="Enter Book Name" name="Book_Name" required /></li>
</form>

<li style="float: right;"><a href="Upload_Book.php">Upload Book</a></li>
<li style="float: right;"><a href="Sign_In.php">Sign In</a></li>
<li style="float: right;"><a href="Admin_Login.php">Admin Login</a></li>
<li style="float: right;"><a href="Sign_Up.php">Sign Up</a></li>
<li style="float: right;"><a href="mailto:sandipanroy177@gmail.com?subject=Feedback&body=">Feedback</a></li>
</ul>

<div style="margin-top: 5%">
<span style="padding-left: 35%"><font face="Cooper Black" size="13" color="#77ea54">Today's Exclusives</font></span>
</div>


<?php

if(isset($_SESSION['Email'])) 
{
header("Location: http://localhost/Next_Book_Store/index_Sign_In.php");
}

	if(isset($_SESSION['Book_Name']))
	{
	unset($_SESSION['Book_Name']);
	}
	

require("php/Connection.php");



$cmd_fetch="SELECT * FROM exclusive_add";
$i=0;
	$res_fetch=mysqli_query($Connection,$cmd_fetch);

	while($Disp=mysqli_fetch_assoc($res_fetch))
	{
	
	$Exclusive[$i]=$Disp['ID'];
	$i=$i+1;
	}

$Command="SELECT * FROM upload_record WHERE (ID='$Exclusive[0]' or ID='$Exclusive[1]' or ID='$Exclusive[2]')";

	$Result=mysqli_query($Connection,$Command);

	$Class_Name=array("Add1","Add2","Add3");
	$i=0;
	while($Display=mysqli_fetch_assoc($Result))
	{
	echo "<div class=".$Class_Name[$i].">";
		echo "<br>";
		echo "<span style='padding-left: 5%'><b>Book Name: </b></span>".$Display['Book_Name'];
		echo "<img src='php/Image_uploads/".$Display['Image_Name']."'height='100' width='150' align='right' style='margin-top: 3%;margin-right: 3%'/>"."<br>";
		echo "<span style='padding-left: 5%'><b>Author: </b></span>".$Display['Author']."<br>";
		echo "<span style='padding-left: 5%'><b>Subject: </b></span>".$Display['Subject']."<br>";
		echo "<span style='padding-left: 5%'><b>Price: </b></span>".$Display['Price']."<br>";
		echo "<span style='padding-left: 5%'><b>Description: </b></span>".$Display['Description']."<br>";
		echo "<span style='padding-left: 5%'><b>PDF Name: </b></span>".$Display['PDF_Name']."<br>";


		echo "<a href='php/Download_PDF.php?id=".$Display['ID']."&PDF_Name=".$Display['PDF_Name']."'>";
		echo "<span style='padding-left: 30%'><button style='background-color: #07cc21;border: none;cursor:pointer;border-radius: 4px;margin-top: 4%' type='button'><b>Download</b></button></span>";
		echo "</a>";


		echo "<a href='php/View_PDF.php?id=".$Display['ID']."&PDF_Name=".$Display['PDF_Name']."'>";
		echo "<span style='padding-left: 5%'><button style='background-color: #113e71;border:none; cursor:pointer;border-radius: 4px;margin-top: 4%' type='button'><b>View</b></button></span>";
		echo "</a>";
		echo "</div>";
		$i=$i+1;
	}

mysqli_close($Connection);

?>
</body>
</html>