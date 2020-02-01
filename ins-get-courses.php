<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <title>BannerUS | Ins</title>
    <link rel="stylesheet" href="./css/instructor_Style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
      <div class="picture">
      <img src="images\toppic_ins.jpeg"  class="d-block w-100 h-100" >
      </div>
      
    <section id="navBar" >
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="instructor.html"><img style="max-width:60px; margin-top: -7px;" src="images\professor.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <!--
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                My Courses
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="ins-get-courses.php">View All Courses</a>
                <a class="dropdown-item" href="ins-create.html">Create Course</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Pending Requests
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="ins-view-approvals.php">View All Requests</a>
              </div>
            </li>
         
          </ul>
        </div>
        <form class="form-inline" action="admin-logout.php" method="post">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Sign Out</button>
        </form>
      </nav>
    </section>
	
<?php
	$link = mysqli_connect("localhost", "root", "", "BannerUS");

	session_start();
	$username = $_SESSION['username'];
	
	echo "<table class='table table-striped table-bordered table-hover' id='myTable'>";
						echo"<thead>";
							echo"<tr>";
								echo"<th>Course Name</th>";
								echo"<th>Students</th>";
								echo"<th>Grades</th>";
								echo"</tr>";
						echo"</thead>";

	$query = "SELECT * FROM ins_course WHERE Instructor = '$username'";
	$result = mysqli_query($link, $query);
	
	while($row = mysqli_fetch_array($result))
	{
		$ccrn = $row['Course'];
		$query2 = "SELECT Name FROM courses WHERE CRN = '$ccrn'";
		$result2 = mysqli_query($link, $query2);
		while($row2 = mysqli_fetch_array($result2))
		{		   
			$query3 = "SELECT * FROM stu_course WHERE Course = '$ccrn'";
			$result3 = mysqli_query($link, $query3);
			while($row3 = mysqli_fetch_array($result3))
			{
				echo "<tr name='MyTable'>";
				echo "<form action='ins-get-courses.php' method='post'>";
				echo "<td name='MyTable' name='cname' value=".$row2['Name'].">". $row2['Name']."</td>";
				echo "<td name='MyTable' name='sname' value=".$row3['Student'].">". $row3['Student']."</td>";
				echo "<td><input type='text' name='grade' value=".$row3['Grade']." class='form-control'></td>";
				echo"</tr>";
			}
		}	
	}	
	
	if(isset($_POST['saveBtn']))
	{
		$grade = $_POST['grade'];
		$cname = $_POST['cname'];
		$sname = $_POST['sname'];
		$mysql_result= mysqli_query($link,"SELECT * from courses WHERE Name = '$cname'");
		while($rw = mysqli_fetch_array($mysql_result))
		{
			$course_crn = rw['CRN'];
		}
		$query = "UPDATE stu_course SET Grade = '$grade' WHERE Course = '$course_crn' AND Student = '$sname'";
		if($query)
		{
			echo "<script>alert('Changes saved successfully.');</script>";
			//header("Refresh:0; url=ins-get-courses.php");	
		}
	}
	
?>
	<button name="saveBtn" class="btn btn-outline-success my-2 my-sm-0" type="submit">Save</button>
	

	
	
	<div class="container">
	<div class="center">
	<br>
	<ul class='nav nav-pills nav-justified'>

			</ul>
			</div>
			</div>

    <footer>
      <p>BannerUS Community University System Solutions,   Copyright &copy; 2017</p>
    </footer>

  </body>
</html>


