<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/Sell_Book.css" />
<link rel="icon" title="Next Book Store" href="images/logo.png" />
<title>Upload Book</title>

<body bgcolor="#37383b" style="background-size:cover;height: 100%">


<div class="card">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data">

<span style="padding-left:13%;color:#5eebe4;"><font  face="Arial Rounded MT Bold" size="15"><b>Upload Book</b></font></span><br>
<b>&nbsp;Book Name<input type="text" name="Book_Name" required /><br>
<span style="padding-left:32px">Author</span><input type="text" name="Author" required /><br>
<span style="padding-left:32px">Subject</span><input type="text" name="Subject" required /><br>
<span style="padding-left:48px">Price</span><input type="number" name="Price" required /><br>
<span style="padding-left:5px">Description</span><input type="text" name="Description" required /><br>
<span style="padding-left:40px">Image</span><input type="file" name="Image" accept="Image/*" required /><br>
<span style="padding-left:53px">PDF</span><input type="file" name="PDF" accept="application/pdf" required /><br>
<input type="submit" name="Final_Submission" value="submit" />
</b>
</form>
</div>


<?php

	if(!isset($_SESSION['Email']))
	{
	header("Location: http://localhost/Next_Book_Store/Sign_In.php");
	}

	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{

		/*Store data from Session*/
	$Email=$_SESSION['Email'];

		/*Validate Inputs From User*/
		function validate_input($Input)
		{
		$Input=trim($Input);
		$Input=stripslashes($Input);
		$Input=htmlspecialchars($Input);
		return $Input;
		}

		/*Storing inputs from HTML form*/
	$Book_Name=validate_input($_POST['Book_Name']);
	$Author=validate_input($_POST['Author']);
	$Subject=validate_input($_POST['Subject']);
	$Price=validate_input($_POST['Price']);
	$Description=validate_input($_POST['Description']);

					/*Check if Blank*/
		if(strlen($Book_Name)==0||strlen($Author)==0||strlen($Subject)==0||strlen($Description)==0)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Every Field Must Be Filled</b></span>";
		echo "</div>";
		die("");
		}

					/*Check Input Field Formats*/

		if(!preg_match("/^[a-zA-Z-0-9 ]*$/",$Book_Name))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Invalid Book Name Format</b></span>";
		echo "</div>";
		die("");
		}

		if(!preg_match("/^[a-zA-Z ]*$/",$Author))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Invalid Author Name Format</b></span>";
		echo "</div>";
		die("");
		}

		if(!preg_match("/^[a-zA-Z-0-9 ]*$/",$Subject))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Invalid Subject Name Format</b></span>";
		echo "</div>";
		die("");
		}

		if(!preg_match("/^[a-zA-Z-0-9 ]*$/",$Description))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Invalid Description Format</b></span>";
		echo "</div>";
		die("");
		}

		if(!preg_match("/^[0-9 ]*$/",$Price))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Invalid Price Format</b></span>";
		echo "</div>";
		die("");
		}

					/*Check Input Lengths*/
		if(strlen($Book_Name)>30)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Book Name Too Long</b></span>";
		echo "</div>";
		die("");
		}

		if(strlen($Author)>30)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Author Name Too Long</b></span>";
		echo "</div>";
		die("");
		}

		if(strlen($Subject)>30)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Subject Name Too Long</b></span>";
		echo "</div>";
		die("");
		}

		if(strlen($Description)>500)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Description Too Long</b></span>";
		echo "</div>";
		die("");
		}

			/*Check for PDF File Name*/
	$PDF_File_Name=basename($_FILES["PDF"]["name"]);
	$PDF_Extension=strtolower(pathinfo($PDF_File_Name,PATHINFO_EXTENSION));		//Get selected PDF File Extension

			/*Check File Name Size*/
		if(strlen($PDF_File_Name)>100)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:40%;color:#f71414'><b>PDF File Name Too Long</b></span>";
		echo "</div>";
		die("");
		}
			/*Check PDF File Extension*/
		if($PDF_Extension!="pdf")
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:40%;color:#f71414'><b>Only PDF Files Allowed As Book</b></span>";
		echo "</div>";
		die("");
		}
			/*Check PDF File Size If Too Small*/
		if($_FILES["PDF"]["size"]==0)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:40%;color:#f71414'><b>PDF File Too Small</b></span>";
		echo "</div>";
		die("");
		}

			/*Check PDF File Size If Too Large*/
		if($_FILES["PDF"]["size"]>52428800)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:40%;color:#f71414'><b>PDF File Too Large</b></span>";
		echo "</div>";
		die("");
		}

			/*Check If PDF File Already Exist*/
		if(file_exists("php/PDF_uploads/".$PDF_File_Name))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:37%;color:#f71414'><b>Same Name PDF Already Exist</b></span>";
		echo "</div>";
		die("");
		}

			/*Check for Image File Name*/
	$Image_File_Name=basename($_FILES["Image"]["name"]);
	$Image_Extension=strtolower(pathinfo($Image_File_Name,PATHINFO_EXTENSION));	//Get selected Image File Extension

		if(strlen($Image_File_Name)>100)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:40%;color:#f71414'><b>Image File Name Too Long</b></span>";
		echo "</div>";
		die("");
		}

		
			/*Check Image File Extension*/
		if($Image_Extension!="jpg"&&$Image_Extension!="jpeg"&&$Image_Extension!="png")
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:40%;color:#f71414'><b>Only jpg,jpeg,png Files Allowed As Image</b></span>";
		echo "</div>";
		die("");
		}
			/*Check PDF File Size If Too Small*/
		if($_FILES["Image"]["size"]==0)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:40%;color:#f71414'><b>Image File Too Small</b></span>";
		echo "</div>";
		die("");
		}

			/*Check PDF File Size If Too Large*/
		if($_FILES["Image"]["size"]>52428000)
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:40%;color:#f71414'><b>Image File Too Large</b></span>";
		echo "</div>";
		die("");
		}

			/*Check If Image File Already Exist*/
		if(file_exists("php/Image_uploads/".$Image_File_Name))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:37%;color:#f71414'><b>Same Name Image Already Exist</b></span>";
		echo "</div>";
		die("");
		}

	$tmp_name_PDF=$_FILES["PDF"]["tmp_name"];
	$tmp_name_Image=$_FILES["Image"]["tmp_name"];


			/*Upload the files*/
		if(!move_uploaded_file($tmp_name_Image,"php/Image_Uploads/".$Image_File_Name))
		{
			die("Error In Connection");
		}


		if(!move_uploaded_file($tmp_name_PDF,"php/PDF_uploads/".$PDF_File_Name))
		{
			die("Error In Connection");
		}	
		



		/*Initializing SQL server details*/
	require("php/Connection.php");

						/*Prepase SQL command*/
	$Command="INSERT INTO upload_record(Email,Book_Name,Author,Subject,Price,Description,PDF_Name,Image_Name)values('$Email','$Book_Name','$Author','$Subject','$Price','$Description','$PDF_File_Name','$Image_File_Name')";

		/*Run the SQL query*/
	$Result=mysqli_query($Connection,$Command);

		if(!$Result)
		{
		die("Error In Connection");
		}

		/*Closing SQL connection*/
	mysqli_close($Connection);

	header("Location: http://localhost/Next_Book_Store/index_Sign_In.php");

	}//close of POST method
?>
</body>
</html>