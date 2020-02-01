<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <title>BannerUS | Student</title>
    <link rel="stylesheet" href="./css/instructor_Style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
	<div class="picture">
      <img src="images\toppic_student.jpeg"  class="d-block w-100 h-100" >
      </div>

    <section id="navBar" >
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="student.html"><img style="max-width:60px; margin-top: -7px;" src="images\student.png"></a>
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
                My Page
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="stu-calendar.php">View My Schedule</a>
                <a class="dropdown-item" href="Stu-V.php">View My Courses</a>
               
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Courses
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="stu-search.php">Search Courses</a>
                <a class="dropdown-item" href="stu-reg-with-course.html">Register/Withdraw Course</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Approvals
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="stu-approval.html">Special Approval</a>
          
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

	$query = "SELECT * FROM stu_course WHERE Student = '$username'";
	$result = mysqli_query($link, $query);
	
				echo "<table class='table table-striped table-bordered table-hover'>";
						echo"<thead>";
							echo"<tr>";
								echo"<th>Course Name</th>";
								echo"<th>Grade</th>";
								echo"</tr>";
						echo"</thead>";

	while($row = mysqli_fetch_array($result))
	{
		$ccrn = $row['Course'];
		$query2 = "SELECT Name FROM courses WHERE CRN = '$ccrn'";
		$result2 = mysqli_query($link, $query2);
		while($row2 = mysqli_fetch_array($result2))
		{
		
			echo "<tr>";
			echo "<td>". $row2['Name']."</td>";
			echo "<td>". $row['Grade']."</td>";
			echo"</tr>";
		}
	}
?>
	 <div class="page-header">
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
