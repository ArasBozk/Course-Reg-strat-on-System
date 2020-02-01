<?php

$link = mysqli_connect("localhost", "root", "", "bannerus");

session_start();
$username = $_SESSION['username'];
$rcCRN = $_POST['rcCRN'];

if(isset($_POST['registerStuBtn']))
{
	if(empty($_POST['rcCRN'])) 
	{
		echo "<script>alert('There are empty field/s try again!');</script>";
		header("Refresh:0; url=stu-reg-with-course.html");			
	}
	else
	{
		$query = "SELECT * FROM Courses WHERE CRN = '$rcCRN'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_array($result);
			
			
		$query2 = "SELECT * FROM stu_course WHERE Course = '$rcCRN'";
		$result2 = mysqli_query($link, $query2);
		$row2 = mysqli_num_rows($result2);


					
		if($result && $result2)	
		{
			
			if ($row['Capacity'] > $row2 && $row['approval_needed'] == 0) 
			{
				$check_PRE=mysqli_query($link,"INSERT INTO `STU_COURSE`(Course, Student, Grade) VALUES ('$rcCRN','$username',NULL)");	
				if($check_PRE) //check_prerequisite trigger inside database handles it
				{

					$query3 = "SELECT CT.Time_D_H FROM stu_course SC,course_time CT WHERE SC.Student = '$username' AND SC.Course = CT.Course ";
					$result3 = mysqli_query($link, $query3);

					$query4 = "SELECT CT.Time_D_H FROM course_time CT WHERE  CT.Course = '$rcCRN' ";
					$result4 = mysqli_query($link, $query4);
					
					
					while($row_iterate = mysqli_fetch_array($result3))
					{
						while($row_iterate2 = mysqli_fetch_array($result4))
						{
							if ($row_iterate2['Time_D_H'] == $row_iterate['Time_D_H'])
							{
								echo "<script>alert('There is a conflict!');</script>";
								header("Refresh:0; url=stu-reg-with-course.html");
								exit;
							}
						}
					}


					echo "<script>alert('Student succesfully registered to the course.');</script>";
					header("Refresh:0; url=stu-reg-with-course.html");

				}
				else //Prequisite dont match -OR- already inserted -OR- not a course -OR- not a student
				{
					echo "<script>alert('Could not add the course!');</script>";
					header("Refresh:0; url=stu-reg-with-course.html");
				}
			} 
			else
			{
				if($row['approval_needed'] != 0)
				{
					echo "<script>alert('Warning! Approval needed.');</script>";
				}
				else if($row['Capacity'] < $row2)
				{
					echo "<script>alert('Warning! Capacity not enough.');</script>";
				}
				else if(!$check_PRE)
				{
					echo "<script>alert('Prequisite dont match -OR- course already exists -OR- not a course -OR- not a student.');</script>";
				}
				header("Refresh:0; url=stu-reg-with-course.html");
			}
		}
		else
		{
			echo "<script>alert('Course CRN does not exists!');</script>";
			header("Refresh:0; url=stu-reg-with-course.html");
		}
		
	}
}
else if(isset($_POST['withStuBtn']))
{
	$wcCRN=$_POST['wcCRN'];       
			
	if(empty($_POST['wcCRN'])) 
	{
		echo "<script>alert('There are empty field/s try again!');</script>";
		header("Refresh:0; url=stu-reg-with-course.html");			
	}
	else
	{
		
		$res2= mysqli_query($link,"SELECT * FROM stu_course WHERE Course = '$wcCRN' AND Student = '$username'");
		$row = mysqli_fetch_array($res2);
		if(($row['Course'] == $wcCRN) && ($row['Student'] == $username))
		{
			$res=mysqli_query($link,"DELETE FROM `stu_course`WHERE Course = '$wcCRN' AND Student = '$username'");
			echo "<script>alert('Student succesfully removed from the course.');</script>";
			header("Refresh:0; url=stu-reg-with-course.html");
		}
		else
		{
			echo "<script>alert('Student-course pair cannot found!');</script>";
			header("Refresh:0; url=stu-reg-with-course.html");
		}
	}
}
?>
