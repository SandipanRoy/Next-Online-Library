<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="Images/logo.png" title="Next Book Store" />
</head>
<title>Delete Record</title>

<body bgcolor="#37383b">
<?php

$Record_ID=$_GET['ID'];

		/*Initialize server details*/
require("Connection.php");

	/*Prepare command to remove record*/
$Command="DELETE FROM upload_record WHERE ID='$Record_ID'";



	/*Prepare command for get filenames to remove*/
$Get_File="SELECT PDF_Name,Image_Name,ID,Email FROM upload_record where ID='$Record_ID'";


	/*Run command to get filenames*/
$Result_tmp=mysqli_query($Connection,$Get_File);


	/*Check for Authenticity And Exclusive Add*/

	$Get_File_Name=mysqli_fetch_assoc($Result_tmp);


		if(strcmp($Get_File_Name['Email'],$_SESSION['Email'])!=0)
		{
		header("Location: http://localhost/Next_Book_Store/index_Sign_In.php");
		}	
	$cmd="SELECT * FROM exclusive_add";
	$i=0;
	
	$res=mysqli_query($Connection,$cmd);
	while($tmp=mysqli_fetch_assoc($res))
	{
	$Exclusive[$i]=$tmp['ID'];
	$i=$i+1;
	}

	if((int)$Record_ID==(int)$Exclusive[0]||(int)$Record_ID==(int)$Exclusive[1]||(int)$Record_ID==(int)$Exclusive[2])
	{
	echo "<span style='padding-left:35%;color: red'>Unsuccessfull!! Using as Exclusive Advertisement</span>";
	die("");
	}

		/*Delete Files from server*/
unlink("PDF_Uploads/".$Get_File_Name['PDF_Name']);	//Remove PDF File 
unlink("Image_Uploads/".$Get_File_Name['Image_Name']);	//Remove Image File



	/*Run the command to remove record from database*/
$Result=mysqli_query($Connection,$Command);

	if(!$Result)
	{
	die("Unable to delete Record");
	}

header("Location: http://localhost/Next_Book_Store/index_Sign_In.php");

		/*Close mysql connection*/
mysqli_close($Connection);
?>

</body>
</html>