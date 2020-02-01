<?php

$link = mysqli_connect("localhost", "root", "", "BannerUS");

if(isset($_POST['registerBtn']))
{
	$regUser=$_POST['reguser'];       
	$regPass=$_POST['regpass'];
	$regRole=$_POST['regrole'];
		
	if(empty($_POST['reguser']) || empty($_POST['regpass']) || empty($_POST['regrole']) )
	{
		echo "<script>alert('There is an empty field try again!');</script>";
		header("Refresh:0; url=admin-delete.html");			
	}
	else
	{
		//$user=mysqli_fetch_array($mysql_result);
		$mysql_result= mysqli_query($link,"SELECT * from PEOPLE WHERE Username = '$regUser'");
		$row_cnt = mysqli_num_rows($mysql_result);
	
		if($row_cnt!=1)
		{
			echo "<script>alert('New user succesfully created.');</script>";
			if($regRole == 'Undergraduate Student')
			{
				mysqli_query($link,"INSERT INTO `PEOPLE` (Username,Password,Role) VALUES('$regUser','$regPass','Student')");
				mysqli_query($link,"INSERT INTO `STUDENT` (S_username,Level) VALUES('$regUser','UG')");
			}
			elseif($regRole == 'Graduate Student')
			{
				mysqli_query($link,"INSERT INTO `PEOPLE` (Username,Password,Role) VALUES('$regUser','$regPass','Student')");
				mysqli_query($link,"INSERT INTO `STUDENT` (S_username,Level) VALUES('$regUser','G')");
			}
			else//Instructor
			{
				mysqli_query($link,"INSERT INTO `PEOPLE` (Username,Password,Role) VALUES('$regUser','$regPass','Instructor')");
				mysqli_query($link,"INSERT INTO `INSTRUCTOR` (T_username) VALUES('$regUser')");
			}

			header("Refresh:0; url=admin-delete.html");
		}
		else
		{
			echo "<script>alert('User that you tried to add already exist. Please try again.');</script>";
			header("Refresh:0; url=admin-delete.html");
		}
	}
}

if(isset($_POST['deleteBtn']))
{
	$idUser = $_POST['deluser'];  
	
	if(empty($_POST['deluser']) )
	{
		echo "<script>alert('Field is empty, try again!');</script>";
		header("Refresh:0; url=admin-delete.html");			
	}
	else
	{
		$res2= mysqli_query($link,"SELECT * FROM PEOPLE WHERE Username='$idUser'")
			or die("Failed to query database");
		$row = mysqli_fetch_array($res2);
		if($row['Username'] == $idUser) 
		{
			if($row['Role']== "Admin")
			{
				echo "<script>alert('You have tried to delete an admin account!');</script>";
				header("Refresh:0; url=admin-delete.html");
			}
			elseif($row['Role'] == "Student")
			{
				echo "<script>alert('Student is succesfully deleted.');</script>";
			}
			elseif($row['Role'] == "Instructor")
			{
				echo "<script>alert('Instructor is succesfully deleted.');</script>";
			}
			else
			{
				$msg='User with role ' . $row['Role'] . ' is succesfully deleted.';
				echo "<script>alert('$msg');</script>";
			}
			mysqli_query($link,"DELETE FROM PEOPLE WHERE Username='$idUser'") or die("Failed to query database");
			header("Refresh:0; url=admin-delete.html");
		}
		else
		{
			echo "<script>alert('Username you tried to delete does not exist!.');</script>";
			header("Refresh:0; url=admin-delete.html");
		}
	}
}