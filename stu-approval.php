<?php

$link = mysqli_connect("localhost", "root", "", "BannerUS");

session_start();
$username = $_SESSION['username'];

$spCRN=$_POST['spCRN'];       
$spDescription=$_POST['spDescription'];

if(isset($_POST['spReqBtn']))
{
	if(empty($_POST['spCRN']) || empty($_POST['spDescription']))
	{
		echo "<script>alert('There are empty field/s try again!');</script>";
		header("Refresh:0; url=stu-approval.html");			
	}
	else
	{
		$mysql_result= mysqli_query($link,"SELECT * FROM courses WHERE CRN = '$spCRN'");
		$row_cnt = mysqli_num_rows($mysql_result);
		
		$res2= mysqli_query($link,"UPDATE `courses` SET `approval_needed` = '1' WHERE `courses`.`CRN` = '$spCRN'");
				
		if($row_cnt > 0)
		{
			$res=mysqli_query($link,"INSERT INTO `special_request` (Course,Description,Status,Name) VALUES('$spCRN','$spDescription',1,'$username')");
			
			if($res && $res2)
			{
				echo "<script>alert('New request successfully sent by you.');</script>";
				header("Refresh:0; url=stu-approval.html");	
			}
			else
			{
				echo "<script>alert('Query for special request failed.');</script>";
				header("Refresh:0; url=stu-approval.html");	
			}
		
		}
		else
		{
			echo "<script>alert('Specified CRN does not belong to any course. Please try again.');</script>";
			header("Refresh:0; url=stu-approval.html");	
		}
	}
}
?>