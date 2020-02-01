<?php
//miyav kedicik mav mav mir
$link = mysqli_connect("localhost", "root", "", "bannerus");

session_start();
$username = $_SESSION['username'];   #if no exists !


if(isset($_POST['createNewCourseBtn']))
{
	$cCRN=$_POST['cCRN'];       
	$cName=$_POST['cName'];
	$cCapacity=$_POST['cCapacity'];
	$cLevel=$_POST['cLevel'];
	$cTerm=$_POST['cTerm'];
	$cDescription=$_POST['cDescription'];

	$XX=$_POST['cDay'];
	$YY=$_POST['cTime'];

	$arr = array ("$XX $YY");
	$i = 1;

	while(isset($_POST["cDay$i"]) && isset($_POST["cTime$i"]))
	{
		$tName = $_POST["cDay$i"] . ' '. $_POST["cTime$i"];
		array_push($arr, "$tName");
		$i = $i +1;
	}

	if(count(array_unique($arr))<count($arr)) // Array has duplicates
	{	
		echo "<script>alert('You entered duplicate time!');</script>";
		header("Refresh:0; url=ins-create.html");	
	}
	else									  // Array does not have duplicates
	{	
		if(empty($_POST['cCRN']) || empty($_POST['cName']) || empty($_POST['cCapacity']) || empty($_POST['cDescription']) 
		|| $cLevel == "Select..."|| $XX == "Select Day..."|| $YY == "Select Time..." || $cTerm == "Select...")
		{
			echo "<script>alert('There are empty field/s try again!');</script>";
			header("Refresh:0; url=ins-create.html");			
		}

		else
		{
			$check_ins= mysqli_query($link,"SELECT * from instructor WHERE T_username = '$username'");
			$ins_row_cnt = mysqli_num_rows($check_ins);
			if($ins_row_cnt!=1)
			{
				echo "<script>alert('Instructor doesnt exists!');</script>";
				header("Refresh:0; url=ins-create.html");
			}


			$query = "SELECT CT.Time_D_H FROM ins_course IC,course_time CT WHERE IC.Instructor = '$username' AND IC.Course = CT.Course ";
			$result = mysqli_query($link, $query);
			
			while($row_iterate = mysqli_fetch_array($result))
			{
				foreach ($arr as $value) 
				{
					if ($value == $row_iterate['Time_D_H'])
					{
						echo "<script>alert('There is a conflict!');</script>";
						header("Refresh:0; url=ins-create.html");
						exit;
					}

				} 
			}
		
			$mysql_result= mysqli_query($link,"SELECT * from courses WHERE CRN = '$cCRN' OR Name ='$cName'");
			$row_cnt = mysqli_num_rows($mysql_result);
	
			if($row_cnt!=1)
			{
				echo "<script>alert('New course succesfully added by you.');</script>";
				$res=mysqli_query($link,"INSERT INTO `courses` (CRN,Name,Capacity,Level,Description,Term) VALUES('$cCRN','$cName','$cCapacity','$cLevel','$cDescription','$cTerm')");
				$res2=mysqli_query($link,"INSERT INTO `ins_course`(Course, Instructor) VALUES ('$cCRN', '$username')");
				

				
				foreach ($arr as $value) 
				{
					$res3=mysqli_query($link,"INSERT INTO `course_time` (Course,Time_D_H) VALUES('$cCRN','$value')");
					if(!$res3)
					{
						echo "<script>alert('Some error occured while inserting!');</script>";
						header("Refresh:0; url=ins-create.html");
					}
				} 
				header("Refresh:0; url=ins-create.html");
			}
			else
			{
				echo "<script>alert('Course that you tried to add already exist. Please try another course CRN or name.');</script>";
				header("Refresh:0; url=ins-create.html");
			}
			

		}





	}

}
?>