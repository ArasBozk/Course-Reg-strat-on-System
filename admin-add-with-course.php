<?php

$link = mysqli_connect("localhost", "root", "", "bannerus");

if(isset($_POST['registerStuBtn']))
{
	$rcCRN=$_POST['rcCRN'];       
	$rsName=$_POST['rsName'];
			
	if(empty($_POST['rcCRN']) || empty($_POST['rsName'])) 
	{
		echo "<script>alert('There are empty field/s try again!');</script>";
		header("Refresh:0; url=admin-reg-win.html");			
	}
	else
	{
		$result = mysqli_query($link, "SELECT * FROM courses WHERE CRN = '$rcCRN'");
		$row_cnt = mysqli_num_rows($result);

		$result2 = mysqli_query($link, "SELECT * FROM student WHERE S_username = '$rsName'");
		$row_cnt2 = mysqli_num_rows($result2);

		if($row_cnt2 != 1)     //not a student
		{
			echo "<script>alert('The student name is not exists');</script>";
			header("Refresh:0; url=admin-reg-win.html");
		}
		
		else if($row_cnt != 1) //not a course
		{
			echo "<script>alert('The course CRN is not exists');</script>";
			header("Refresh:0; url=admin-reg-win.html");
		}

		else
		{
			$row = mysqli_fetch_array($result);
			
			$result3 = mysqli_query($link, "SELECT * FROM stu_course WHERE Course = '$rcCRN'");
			$row2 = mysqli_num_rows($result3);
					
				
			if ($row['Capacity'] > $row2) 
			{
				$check_PRE=mysqli_query($link,"INSERT INTO `stu_course`(Course, Student, Grade) VALUES ('$rcCRN','$rsName',NULL)");
	
				if($check_PRE) //check_prerequisite trigger inside database handles it
				{
					echo "<script>alert('Student succesfully registered to the course.');</script>";
					header("Refresh:0; url=admin-reg-win.html");
				}
	
				else if (mysqli_error($link) == "Cant insert course. Prerequisites doesnt match!") //Prequisite dont match
				{
					echo "<script>alert('Prerequisites doesnt match!');</script>";
					header("Refresh:0; url=admin-reg-win.html");
				}
	
				else //already inserted
				{
					echo "<script>alert('Course is already registered to the student ');</script>";  //RETAKE!!
					header("Refresh:0; url=admin-reg-win.html");
				}
			} 
			else //Capacity not enough
			{
				echo "<script>alert('Warning! Capacity is full, registration failed.');</script>";
				header("Refresh:0; url=admin-reg-win.html");
			}
		}

	}
}
else if(isset($_POST['withStuBtn']))
{
	$wcCRN=$_POST['wcCRN'];       
	$wsName=$_POST['wsName'];
		
	if(empty($_POST['wcCRN']) || empty($_POST['wsName'])) 
	{
		echo "<script>alert('There are empty field/s try again!');</script>";
		header("Refresh:0; url=admin-reg-win.html");			
	}
	else
	{
		
		$res2= mysqli_query($link,"SELECT * FROM stu_course WHERE Course = '$wcCRN' AND Student = '$wsName'");
		$row = mysqli_fetch_array($res2);
		if(($row['Course'] == $wcCRN) && ($row['Student'] == $wsName))
		{
			$res=mysqli_query($link,"DELETE FROM `stu_course`WHERE Course = '$wcCRN' AND Student = '$wsName'");
			echo "<script>alert('Student succesfully removed from the course.');</script>";
			header("Refresh:0; url=admin-reg-win.html");
		}
		else
		{
			echo "<script>alert('Student-course pair cannot found!');</script>";
			header("Refresh:0; url=admin-reg-win.html");
		}
	}
}
?>
