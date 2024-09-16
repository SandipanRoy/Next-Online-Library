<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/Search_Record.css" />
<link rel="stylesheet" type="text/css" href="css/navigation_panel.css" />
<link rel="icon" title="Next Book Store" href="images/logo.png" />

</head>
<title>Search Results</title>

<body bgcolor="#37383b" style="background-size: cover;height: 100%;background-attachment: fixed">
<ul class="navigation_bar">
<li style="float: left;"><img src="images/logo.png" width="42%" title="Next Book Store" /></li>

<form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
<li style="float: right"><input type="submit" name="submit" value="Search" /></li>
<li style="float: right"><input type="text" placeholder="Enter Book Name" name="Book_Name" required value="<?php 
if(isset($_GET['Book_Name']))
echo $_GET['Book_Name'];
else
echo $_SESSION['Book_Name']; 
?>"/>
</li>
</form>


<li style="float: right">
<select id="orderBy">
<option value="none" select>Select Filter</option>
<option value="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Date:New To Old</option>
<option value="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Date:Old To New</option>
<option value="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Popularity:Most To Least</option>
<option value="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Popularity:Least To Most</option>
</select>


<script type="text/javascript">
var dropdown=document.getElementById('orderBy');
	dropdown.onchange=function(){
var option=this.options[this.selectedIndex].value;
	if(this.selectedIndex==1)
	var url=option.concat("?Filter=1");

	else if(this.selectedIndex==2)
	var url=option.concat("?Filter=2");	

	else if(this.selectedIndex==3)
	var url=option.concat("?Filter=3");
	
	else
	var url=option.concat("?Filter=4");

window.open(url,"_self");

}

</script>


</li>
<li style="float: right;"><a>ORDER BY</a></li>
</ul>
<br><br><br><br>


<?php

if(!isset($_GET['Filter']))
{
$Filter=1;
}
else
{
$Filter=$_GET['Filter'];
}


	function validate_input($Input)
		{
		$Input=trim($Input);
		$Input=stripslashes($Input);
		$Input=htmlspecialchars($Input);
	
		return $Input;
		}

	if(!isset($_GET['Book_Name']))
	{
	$Input=$_SESSION['Book_Name'];
	}
	else
	{
	$Input=$_GET['Book_Name'];
	}
	

$Search_Query=validate_input($Input);

	if(!preg_match("/^[a-zA-Z-0-9 ]*$/",$Search_Query))
		{
		echo "<div style='margin-top:5%'>";
		echo "<span style='padding-left:43%;color:#f71414'><b>Invalid Inputs</b></span>";
		echo "</div>";
		die("");
		}

$_SESSION['Book_Name']=$Search_Query;

		/*Initialize Server details*/
require("Connection.php");

$Command1="SELECT * FROM upload_record where Book_Name LIKE '%$Search_Query%' OR Description LIKE '%$Search_Query%' OR Author LIKE '%$Search_Query%' OR Subject LIKE '%$Search_Query%' ORDER BY Upload_Date_Time DESC";
$Command2="SELECT * FROM upload_record where Book_Name LIKE '%$Search_Query%' OR Description LIKE '%$Search_Query%' OR Author LIKE '%$Search_Query%' OR Subject LIKE '%$Search_Query%' ORDER BY Upload_Date_Time ASC";
$Command3="SELECT * FROM upload_record where Book_Name LIKE '%$Search_Query%' OR Description LIKE '%$Search_Query%' OR Author LIKE '%$Search_Query%' OR Subject LIKE '%$Search_Query%' ORDER BY Priority_Points DESC";
$Command4="SELECT * FROM upload_record where Book_Name LIKE '%$Search_Query%' OR Description LIKE '%$Search_Query%' OR Author LIKE '%$Search_Query%' OR Subject LIKE '%$Search_Query%' ORDER BY Priority_Points ASC";

	if($Filter==1)
$Result=mysqli_query($Connection,$Command1);
	elseif($Filter==2)
$Result=mysqli_query($Connection,$Command2);
	elseif($Filter==3)
$Result=mysqli_query($Connection,$Command3);
	else
$Result=mysqli_query($Connection,$Command4);

	if(mysqli_num_rows($Result)>0)
	{
		
	
		while($Display=mysqli_fetch_assoc($Result))
		{
		echo "<div class=card>";
		echo "<span style='padding-left: 5%'><b>Book Name: </b></span>".$Display['Book_Name'];
		echo "<img src='Image_uploads/".$Display['Image_Name']."'height='100' width='150' align='right' style='margin-top: 3%;margin-right: 3%'/>"."<br>";
		echo "<span style='padding-left: 5%'><b>Author: </b></span>".$Display['Author']."<br>";
		echo "<span style='padding-left: 5%'><b>Subject: </b></span>".$Display['Subject']."<br>";
		echo "<span style='padding-left: 5%'><b>Price: </b></span>".$Display['Price']."<br>";
		echo "<span style='padding-left: 5%'><b>Description: </b></span>".$Display['Description']."<br>";
		echo "<span style='padding-left: 5%'><b>PDF Name: </b></span>".$Display['PDF_Name']."<br>";


		echo "<a href='Download_PDF.php?id=".$Display['ID']."&PDF_Name=".$Display['PDF_Name']."'>";
		echo "<span style='padding-left: 30%'><button style='background-color: #07cc21;border: none;cursor:pointer;border-radius: 4px;margin-top: 4%' type='button'><b>Download</b></button></span>";
		echo "</a>";


		echo "<a href='View_PDF.php?id=".$Display['ID']."&PDF_Name=".$Display['PDF_Name']."'>";
		echo "<span style='padding-left: 5%'><button style='background-color: #113e71;border:none; cursor:pointer;border-radius: 4px;margin-top: 4%' type='button'><b>View</b></button></span>";
		echo "</a>";
		echo "</div>";
		}
	}
	else
	{
	echo "<span style='padding-left:45%;color: red'>No Record Found</span>";
	}
	
		/*Closing the connection*/
mysqli_close($Connection);

?>

</body>
</html>