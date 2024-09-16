<!DOCTYPE html>
<html>

<body>

<?php
 
$Record_ID=$_GET['id'];
$Record_Name=$_GET['PDF_Name'];
$Record_Name_Final="PDF_Uploads/".$Record_Name;

		/*Update the record in the database*/
require("Connection.php");

	if(isset($_SESSION['Email']))
	{
	header("Content-length: ".filesize($Record_Name_Final));
	header("Content-disposition: attachment;filename='$Record_Name_Final'");
	readfile($Record_Name_Final);
	}
	else
	{
	$Command="Update upload_record set downloads=downloads+1,Priority_Points=Priority_Points+1 where ID='$Record_ID'";

	
	$Result=mysqli_query($Connection,$Command);

		if(!$Result)
		{
		die("Error In Connection");
		}
		else
		{
		header("Content-length: ".filesize($Record_Name_Final));
		header("Content-disposition: attachment;filename='$Record_Name_Final'");
		readfile($Record_Name_Final);
		}

	}


mysqli_close($Connection);


?>
</body>
</html>
